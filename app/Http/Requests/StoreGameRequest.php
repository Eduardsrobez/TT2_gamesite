<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class StoreGameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'game_link' => [
                'required',
                'string',
                'regex:/^(https?:\/\/)?([\w\-]+\.)+[\w\-]{2,}(\/\S*)?$/i'
            ],
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
            'cover_image' => 'nullable|image|max:2048',
        ];
    }
}

