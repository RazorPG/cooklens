<?php

namespace App\Http\Requests\Analysis;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreAnalysisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => [
                'required',
                File::image()
                    ->max(5 * 1024),
            ],
        ];
    }
}
