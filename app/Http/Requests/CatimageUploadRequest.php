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
            'text' => 'string|max:255',
            'map_lat' => 'required|numeric',
            'map_lng' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルは必須項目です',
            'image.required' => '画像をアップロードしてください',
            'image.image' => '画像ファイルをアップロードしてください',
            'image.mimes' => 'jpeg、png、jpg、gif、svgのいずれかの形式の画像をアップロードしてください',
            'image.max' => '画像サイズは2MB以下のもの、または2MB以下になるようにトリミングをお願いいたします',
            'text.max' => '内容は255文字以下でお願いいたします',
            'map_lat.required' => '地図上で撮影場所をクリックしてください',
        ];
    }
}
