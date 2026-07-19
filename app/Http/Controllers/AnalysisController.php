<?php

namespace App\Http\Controllers;

use App\Http\Requests\Analysis\StoreAnalysisRequest;
use App\Models\Analysis;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AnalysisController extends Controller
{
    public function index(): View
    {
        $analyses = Analysis::where('user_id', auth()->id())
            ->latest()
            ->take(10)
            ->get();

        return view('analisis', compact('analyses'));
    }

    public function store(StoreAnalysisRequest $request): RedirectResponse
    {
        try {
            $uploaded = Cloudinary::uploadApi()->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'cooklens/analysis/'.auth()->id(),
                ]
            );

            Analysis::create([
                'user_id' => auth()->id(),
                'image_path' => $uploaded['secure_url'],
                'image_public_id' => $uploaded['public_id'],
                'detected_ingredients' => [],
            ]);

            return to_route('analisis')->with('status', 'Gambar berhasil diunggah!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengunggah gambar: '.$e->getMessage())->withInput();
        }
    }
}
