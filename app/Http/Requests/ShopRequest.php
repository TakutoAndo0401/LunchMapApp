<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
    //Validation のルール
    public function rules()
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,heic'
        ];
    }

    public function messages()
    {
        return [
            'image.required' => '画像を選択してください。',
            'image.image' => '正しい画像ファイルではありません。',
            'image.mimes' => 'jpeg,png,jpgのみです。'
        ];
    }
}
