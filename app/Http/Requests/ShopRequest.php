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
    //ValidationRules
    public function rules()
    {
        return [
            'image' => 'required|file|image|max:4096|mimes:image/jpeg,image/png,image/jpg,image/heic,image/bmp',
        ];
    }
    public function messages()
    {
        return [
            'image.required' => '画像を選択してください。',
            'image.image' => 'アップロードできるのは画像だけです。',
            'image.max' => '4MBまでアップロードできます。',
            'image.mimes' => 'アップロードできるのはjpeg,pngだけです。',
        ];
    }
}
