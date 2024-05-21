<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassRoomRequest extends FormRequest
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
            'name' => 'required|max:255',
            'description' => 'nullable|max:1000',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên lớp',
            'name.max' => 'Tên lớp tối đa 255 ký tự',
            'description.max' => 'Mô tả lớp tối đa 1000 ký tự',
            'image.image' => 'Chỉ được chọn ảnh',
            'image.max' => 'Kích thước ảnh không vượt quá 2048 KB',  
            'image.mimes' => 'Sai định dạng ảnh',
        ];
    }
}
