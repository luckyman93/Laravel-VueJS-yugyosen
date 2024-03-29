<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'news_title' => 'required|string|max:256',
            'news_content' => 'required|string|max:1024',
        ];
    }


    public function attributes()
    {
        return [
            'news_title' => 'ニュースタイトル',
            'news_content' => 'ニュースコンテンツ',
        ];
    }
}
