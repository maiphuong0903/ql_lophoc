<?php

namespace App\Http\Requests;

use App\Models\Topic;
use Illuminate\Foundation\Http\FormRequest;

class StoreExamRandomRequest extends FormRequest
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
            'numQuestionsPerTopic' => 'required',
            'numQuestionsPerTopic.*' => 'required|integer|min:1',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $numQuestionsPerTopic = $this->input('numQuestionsPerTopic');

            foreach ($numQuestionsPerTopic as $topicId => $numQuestions) {
                $maxQuestions = Topic::findOrFail($topicId)->questions()->count();
                if ($numQuestions > $maxQuestions) {
                    $validator->errors()->add('numQuestionsPerTopic.' . $topicId, "Số câu hỏi cho chủ đề {$topicId} không thể lớn hơn {$maxQuestions}.");
                }
            }
        });
    }
    
    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'time.required' => 'Thời gian làm bài là bắt buộc.',
            'time.integer' => 'Thời gian làm bài phải là số nguyên.',
            'time.min' => 'Thời gian làm bài phải lớn hơn 0.',
            'expiration_date.required' => 'Ngày hết hạn là bắt buộc.',
            'expiration_date.date' => 'Ngày hết hạn không hợp lệ.',
            'expiration_date.after' => 'Ngày hết hạn phải lớn hơn ngày hôm nay.',
            'numQuestionsPerTopic.required' => 'Bạn phải chọn số lượng câu hỏi cho từng chủ đề.',
            'numQuestionsPerTopic.*.required' => 'Số lượng câu hỏi cho mỗi chủ đề là bắt buộc.',
            'numQuestionsPerTopic.*.integer' => 'Số lượng câu hỏi phải là số nguyên.',
            'numQuestionsPerTopic.*.min' => 'Số lượng câu hỏi phải lớn hơn 0.',
        ];
    }
}
