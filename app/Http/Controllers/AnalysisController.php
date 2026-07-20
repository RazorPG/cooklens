<?php

namespace App\Http\Controllers;

use App\Http\Requests\Analysis\StoreAnalysisRequest;
use App\Models\Analysis;
use App\Services\GeminiService;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $analyses = Analysis::where('user_id', auth()->id())
            ->latest()
            ->paginate(5);

        return view('riwayat', compact('analyses'));
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

    public function store(StoreAnalysisRequest $request): RedirectResponse
    {
        try {
            $localPath = $request->file('image')->getRealPath();

            $result = app(GeminiService::class)->analyzeImage($localPath);

            $uploaded = Cloudinary::uploadApi()->upload(
                $localPath,
                [
                    'folder' => 'cooklens/analysis/' . auth()->id(),
                ]
            );

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
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menganalisis gambar: ' . $e->getMessage())->withInput();
        }
    }
}
