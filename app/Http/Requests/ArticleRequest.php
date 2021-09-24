<?php

namespace App\Http\Requests;

use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:60'],
            'description' => ['required', 'string', 'max:255'],
            'filenames' => 'max:10000',
            'filenames.*' => 'mimes:png,jpg,jpeg,gif',
            'price' => ['required', 'numeric'],
            'category' => ['required'],
        ];
    }
}
