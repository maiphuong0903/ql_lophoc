<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
            'content' => 'required',
            'answer_content' => 'required|min:2', 
            'answer_content.*' => 'required',
            'is_correct' => 'required',
            'topic_id' => 'required', 
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Vui lòng nhập nội dung câu hỏi.',
            'answer_content.required' => 'Vui lòng nhập ít nhất hai câu trả lời.',
            'answer_content.min' => 'Phải có ít nhất hai câu trả lời.',
            'answer_content.*.required' => 'Vui lòng nhập nội dung cho câu trả lời.',
            'is_correct.required' => 'Vui lòng chọn câu trả lời đúng.',
            'topic_id.required' => 'Vui lòng chọn chủ đề cho câu hỏi.',
        ];
    }
}
