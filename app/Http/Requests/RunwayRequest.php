<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RunwayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
//            'imageUrl' => 'nullable|url|regex:/ai\.ews\.ge/|required_without_all:runwayUpload',
            'imageUrl' => 'nullable|url|regex:/imageai\.test/|required_without_all:runwayUpload',
            'runwayUpload' => 'nullable|mimes:jpeg,png,jpg|required_without_all:imageUrl',
            'prompt' => 'required|string',
            'duration' => 'nullable|integer|in:5,10',
            'ratio' => 'nullable|string|in:1280:768,768:1280',
        ];
    }


}
