<?php

namespace App\Services;

use Gemini\Data\Blob;
use Gemini\Data\GenerationConfig;
use Gemini\Enums\MimeType;
use Gemini\Enums\ResponseMimeType;
use Gemini\Laravel\Facades\Gemini;
use RuntimeException;

class GeminiService
{
    public function analyzeImage(string $localPath): array
    {
        $mimeType = mime_content_type($localPath);
        $base64 = base64_encode(file_get_contents($localPath));

        $response = Gemini::generativeModel('models/gemini-3.5-flash')
            ->withGenerationConfig(new GenerationConfig(
                temperature: 0.0,
                responseMimeType: ResponseMimeType::APPLICATION_JSON,
            ))
            ->generateContent([
                'Analisis gambar makanan ini. Identifikasi bahan-bahan yang terlihat dan berikan rekomendasi resep (minimal 1, maksimal 3) yang bisa dibuat dari bahan-bahan tersebut. Gunakan bahasa Indonesia. Jika gambar tidak mengandung bahan makanan sama sekali (misalnya gambar benda mati, orang, atau pemandangan), kembalikan "detected_ingredients" dengan array kosong [] dan "recommendations" dengan array kosong [].

Kembalikan JSON dengan format:
{
  "detected_ingredients": ["bahan1", "bahan2", ...],
  "recommendations": [
    {
      "recipe_name": "Nama Resep",
      "match_percentage": 85,
      "cooking_time": 30,
      "difficulty": "Mudah",
      "reason": "Alasan singkat mengapa resep ini cocok",
      "recipe_data": {
        "ingredients": ["bahan1", "bahan2"],
        "steps": ["langkah1", "langkah2"]
      }
    }
  ]
}

Keterangan:
- match_percentage: angka 0-100
- cooking_time: waktu memasak dalam menit
- difficulty: "Mudah", "Sedang", atau "Sulit"
- recipe_data.ingredients: daftar bahan yang dibutuhkan untuk resep
- recipe_data.steps: langkah-langkah memasak',
                new Blob(
                    mimeType: MimeType::from($mimeType),
                    data: $base64,
                ),
            ]);

        $result = $response->json(associative: true);

        if (! isset($result['detected_ingredients'], $result['recommendations'])) {
            throw new RuntimeException('Respon Gemini tidak memiliki format yang diharapkan.');
        }

        return $result;
    }
}
