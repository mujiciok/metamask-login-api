<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMetadataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'image' => 'required|url',
            'description' => 'nullable|string',
            'background_color' => 'nullable|string|size:6',
            'external_url' => 'nullable|url',
            'animation_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',

            'attributes' => 'nullable|array',
            'attributes.*' => 'required|array',
            'attributes.*.trait_type' => 'nullable|string',
            'attributes.*.value' => 'required|string',
            'attributes.*.display_type' => 'nullable|string',
        ];
    }
}
