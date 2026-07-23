<?php

namespace App\Http\Controllers;

use App\Http\Requests\Analysis\StoreAnalysisRequest;
use App\Models\Analysis;
use App\Services\GeminiService;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AnalysisController extends Controller
{
    public function index(): View
    {
        $analyses = Analysis::where('user_id', auth()->id())
            ->latest()
            ->take(10)
            ->get();

        return view('analisis.index', compact('analyses'));
    }

    public function history(Request $request): View
    {
        $search = $request->input('search');
        $favorites = $request->boolean('favorites');

        $analyses = Analysis::where('user_id', auth()->id())
            ->when($favorites, fn ($q) => $q->where('is_favorite', true))
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('detected_ingredients', 'like', "%{$search}%")
                        ->orWhereHas('recommendations', fn ($r) => $r->where('recipe_name', 'like', "%{$search}%"));
                });
            })
            ->with('recommendations')
            ->latest()
            ->paginate(5);

        return view('riwayat', compact('analyses', 'search', 'favorites'));
    }

    public function show(Analysis $analysis): View
    {
        if ($analysis->user_id !== auth()->id()) {
            abort(403);
        }

        $analysis->load('recommendations');

        return view('analisis.detail', compact('analysis'));
    }

    public function destroy(Analysis $analysis): RedirectResponse
    {
        if ($analysis->user_id !== auth()->id()) {
            abort(403);
        }

        Cloudinary::uploadApi()->destroy($analysis->image_public_id);

        $analysis->delete();

        return to_route('riwayat')->with('status', 'Analisis berhasil dihapus!');
    }

    public function toggleFavorite(Analysis $analysis): RedirectResponse
    {
        if ($analysis->user_id !== auth()->id()) {
            abort(403);
        }

        $analysis->update(['is_favorite' => ! $analysis->is_favorite]);

        return back()->with('status', $analysis->is_favorite
            ? 'Analisis ditandai sebagai favorit!'
            : 'Analisis dihapus dari favorit!');
    }

    public function store(StoreAnalysisRequest $request): RedirectResponse
    {
        set_time_limit(120);

        try {
            $localPath = $request->file('image')->getRealPath();

            // Upload ke Cloudinary terlebih dahulu
            $uploaded = Cloudinary::uploadApi()->upload(
                $localPath,
                [
                    'folder' => 'cooklens/analysis/'.auth()->id(),
                ]
            );

            // Analisis gambar dengan Gemini
            $result = app(GeminiService::class)->analyzeImage($localPath);

            // Jika AI tidak mendeteksi bahan makanan
            if (empty($result['detected_ingredients'])) {
                // Hapus gambar yang sudah terlanjur di-upload ke Cloudinary
                Cloudinary::uploadApi()->destroy($uploaded['public_id']);

                return back()->with('no_ingredients', true);
            }

            $analysis = Analysis::create([
                'user_id' => auth()->id(),
                'image_path' => $uploaded['secure_url'],
                'image_public_id' => $uploaded['public_id'],
                'detected_ingredients' => $result['detected_ingredients'],
            ]);

            foreach ($result['recommendations'] as $rec) {
                $analysis->recommendations()->create([
                    'recipe_name' => $rec['recipe_name'],
                    'match_percentage' => $rec['match_percentage'],
                    'cooking_time' => $rec['cooking_time'],
                    'difficulty' => $rec['difficulty'],
                    'reason' => $rec['reason'],
                    'recipe_data' => $rec['recipe_data'],
                ]);
            }

            $analysis->load('recommendations');

            return to_route('analisis')
                ->with('status', 'Gambar berhasil dianalisis!')
                ->with('latest_analysis', $analysis);
        } catch (\Throwable $e) {
            $msg = $e->getMessage();
            $error = 'Gagal menganalisis gambar. Silakan coba lagi.';

            if (str_contains(strtolower($msg), 'limit') || str_contains(strtolower($msg), '429') || str_contains(strtolower($msg), 'quota')) {
                $error = 'Server AI sedang sibuk atau batas penggunaan harian telah tercapai. Mohon coba beberapa saat lagi.';
            } elseif (str_contains(strtolower($msg), 'timeout') || str_contains(strtolower($msg), '30 detik') || str_contains(strtolower($msg), 'curl error 28') || str_contains(strtolower($msg), 'execution time')) {
                $error = 'Proses analisis terlalu lama. Pastikan koneksi internet Anda stabil dan silakan coba lagi.';
            } else {
                // Gunakan Helper str()->limit jika perlu menampilkan sisa exception
                $error = 'Gagal menganalisis gambar: '.str($msg)->limit(80);
            }

            Log::error('Analysis failed: '.$msg);

            return back()->with('error', $error)->withInput();
        }
    }
}
