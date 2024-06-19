<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
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
            'title' => 'required|max:255',
            'document_url' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'title.max' => 'Tiêu đề không được vượt quá :max ký tự.',
            'document_url.required' => 'Vui lòng chọn file tài liệu.',
            'document_url.file' => 'File tải lên không hợp lệ.',
            'document_url.mimes' => 'File phải có định dạng pdf, jpg, jpeg, png.',
            'document_url.max' => 'Dung lượng tối đa cho phép là :max KB.',
        ];
    }
}
