@extends('layouts.class-info')

@section('title', 'WindClassRoom')

@section('content')
    @include('partial.toast-message')
    <div class="border border-1 px-5 py-5 bg-white font-medium fixed top-16 w-full overflow-y-auto z-10 flex gap-3 items-center mt-2">
        <h1>Câu hỏi</h1>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
        </svg>       
        <p>Thông tin câu hỏi</p>   
    </div>
    <div class="max-w-screen-lg mx-auto mt-24 mb-10 border px-10 py-5">
        <form action="{{ route('class.questions.update', ['id' => $classRoom->id, 'questionId' => $question->id]) }}" method="POST">
            @csrf
            @method('PUT')
            
            <label for="content">Câu hỏi {{ $question->id }}: <span class="text-red-500">*</span></label>
            <textarea name="content" id="content" cols="30" rows="3" class="w-full border-gray-300 rounded-md font-light focus:border-blue-50 mb-3 mt-2">{{ $question->content }}</textarea>
    
            <p class="mb-2">Đáp án: <span class="text-red-500">*</span></p>
            <div id="answers-container">
                @foreach ($answers as $index => $answer)
                    <div class="flex gap-1 items-center py-2 answer">
                        <input type="radio" name="is_correct" value="{{ $index }}" {{ $answer->is_correct ? 'checked' : '' }}> 
                        <label>{{ $answer->answer_index }}</label> 
                        <input type="text" name="answer_content[]" value="{{ $answer->answer_content }}" class="w-full ml-2 border-gray-300 rounded-md font-light focus:border-blue-50">
                        <input type="hidden" name="answer_index[]" value="{{ $answer->answer_index }}">
                        <button type="button" class="remove-answer ml-2 text-red-500 hover:text-red-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>
    
            <button type="button" id="add-answer" class="mt-3 bg-gray-200 p-2 rounded-md">Thêm đáp án</button>
    
            <div class="mt-5">
                <label for="topic_id">Chủ đề: <span class="text-red-500">*</span></label>
                <select name="topic_id" id="topic_id" class="w-full border-gray-300 rounded-md font-light focus:border-blue-50 mb-3">
                    <option value="">Chọn chủ đề</option>
                    @foreach ($topics as $topic)
                        <option value="{{ $topic->id }}" {{ $topic->id == $question->topic_id ? 'selected' : '' }}>{{ $topic->name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="border-gray-200 rounded-b flex gap-3 justify-end">
                <a href="{{ route('class.questions', $classRoom->id) }}" class="text-white bg-gray-500 hover:bg-gray-600 font-medium rounded-lg text-md px-5 py-2 text-center" type="submit">Hủy</a>
                <button class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-md px-5 py-2 text-center" type="submit">Cập nhật</button>
            </div>  
        </form>
    </div>
@stop

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function updateAnswerIndexes() {
            $('#answers-container .answer').each(function(index) {
                const currentIndex = $(this).find('label').text();
                const newIndex = String.fromCharCode(64 + index + 1);
                $(this).find('label').text(newIndex);
                $(this).find('input[name="answer_index[]"]').val(newIndex);
            });
        }

        $('#add-answer').click(function() {
            const answerDiv = $('<div>', { class: 'flex gap-1 items-center py-2 answer' });
            const newIndex = $('#answers-container .answer').length;
            const radioButton = $('<input>', { type: 'radio', name: 'is_correct', value: newIndex });
            const label = $('<label>').text(String.fromCharCode(64 + newIndex)); 
            const textField = $('<input>', { type: 'text', name: 'answer_content[]', class: 'w-full ml-2 border-gray-300 rounded-md font-light focus:border-blue-50' });
            const answerIndexField = $('<input>', { type: 'hidden', name: 'answer_index[]', value: String.fromCharCode(64 + newIndex) }); 
            const removeButton = $('<button>', { type: 'button', class: 'remove-answer ml-2 text-red-500 hover:text-red-700' }).html(`
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            `);

            // Thêm các phần tử vào div mới
            answerDiv.append(radioButton, label, textField, answerIndexField, removeButton); 

            // Thêm div mới vào container
            $('#answers-container').append(answerDiv);

            // Cập nhật lại các chỉ số đáp án
            updateAnswerIndexes();
        });

        // Gắn sự kiện xóa cho các câu trả lời
        $('#answers-container').on('click', '.remove-answer', function() {
            $(this).closest('.answer').remove();
            // Cập nhật lại các chỉ số đáp án
            updateAnswerIndexes();
        });
    });
</script>
