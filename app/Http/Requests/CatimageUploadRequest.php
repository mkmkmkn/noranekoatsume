<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatimageUploadRequest extends FormRequest
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
            'title' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'text' => 'required|string|max:255',
            'map_lat' => 'required|numeric',
            'map_lng' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => ':attributeを入力してください',
            'image.required' => ':attributeをアップロードしてください',
            'image.image' => ':attributeファイルをアップロードしてください',
            'image.mimes' => 'jpeg、png、jpg、gif、svgのいずれかの形式の:attributeをアップロードしてください',
            'image.max' => ':attributeサイズは2MB以下のもの、または2MB以下になるようにトリミングをお願いいたします',
            'text.required' => ':attributeを入力してください',
            'text.max' => ':attributeは255文字以下でお願いいたします',
            'map_lat.required' => '地図上で撮影場所をクリックしてください',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'image' => '画像',
            'text' => 'コメント',
        ];
    }
}
