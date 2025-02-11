<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TranslationStoreRequest extends FormRequest
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
            'word' => 'required|string|max:191',
            'translation' => 'required|string|max:191',
            'locale' => 'required|string|exists:locales,code',
            'tag' => 'nullable|string|exists:tags,name'
        ];
    }
}
