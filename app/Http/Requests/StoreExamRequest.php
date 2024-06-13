<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExamRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'time' => 'required|integer|min:1',
            'expiration_date' => 'required|date|after:today',
            'questions' => 'required|min:1', 
            'questions.*' => 'exists:questions,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.string' => 'Tiêu đề phải là chuỗi.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'time.required' => 'Thời gian làm bài là bắt buộc.',
            'time.integer' => 'Thời gian làm bài phải là số nguyên.',
            'time.min' => 'Thời gian làm bài phải lớn hơn hoặc bằng 1.',
            'expiration_date.required' => 'Ngày hết hạn làm bài là bắt buộc.',
            'expiration_date.date' => 'Ngày hết hạn không hợp lệ.',
            'expiration_date.after' => 'Ngày hết hạn phải lớn hơn ngày hôm nay.',
            'questions.required' => 'Phải chọn ít nhất một câu hỏi.',
            'questions.min' => 'Phải chọn ít nhất một câu hỏi.',
            'questions.*.exists' => 'Một hoặc nhiều câu hỏi không tồn tại trong hệ thống.',
        ];
    }
}
