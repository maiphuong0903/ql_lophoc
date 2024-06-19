<div id="questionFormModal" class="fixed z-20 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen text-gray-950">
        <div class="bg-white w-1/2 p-6 rounded-xl shadow-lg">
            <div class="flex justify-between pb-5">
                <h1 class="font-medium">Tạo câu hỏi</h1>
                <button id="closeQuestionForm" class="text-gray-500 hover:text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('class.questions.store', $classRoom->id) }}" method="POST">
                @csrf
                <label for="">Câu hỏi: <span class="text-red-500">*</span></label>
                <textarea name="content" id="" cols="10" rows="3" class="w-full border-gray-300 rounded-md font-light focus:border-blue-50 mt-2">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <p class="mb-2 mt-3">Đáp án: <span class="text-red-500">*</span></p>            
                <div id="answers-container">
                    @foreach(old('answer_content', ['']) as $index => $answer)
                    <div class="flex gap-1 items-center py-2 answer">
                        <input type="radio" name="is_correct" value="{{ $index + 1 }}" {{ old('is_correct') == $index + 1 ? 'checked' : '' }}> 
                        <label for="">{{ chr(65 + $index) }}</label> 
                        <input type="text" name="answer_content[]" value="{{ $answer }}" class="w-full ml-2 border-gray-300 rounded-md font-light focus:border-blue-50">
                        <input type="hidden" name="answer_index[]" value="{{ chr(65 + $index) }}">
                        <button type="button" class="remove-answer ml-2 text-red-500 hover:text-red-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    @endforeach
                </div>
                
                <div id="answers-container">
                    @if ($errors->has('answer_content'))
                        @foreach ($errors->get('answer_content') as $error)
                            <p class="text-red-500 text-xs mt-1">{{ $error }}</p>
                        @endforeach
                    @endif

                    @if ($errors->has('answer_content.*'))
                        @foreach ($errors->get('answer_content.*') as $error)
                            <p class="text-red-500 text-xs mt-1">{{ $error[0] }}</p>
                        @endforeach
                    @endif

                    @error('is_correct')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="button" id="add-answer" class="mt-3 bg-gray-200 p-2 rounded-md">Thêm đáp án</button>

                <div class="mt-5">
                    <label for="">Chủ đề: <span class="text-red-500">*</span></label>
                    <select name="topic_id" id="" class="w-full border-gray-300 rounded-md font-light focus:border-blue-50 mb-3">
                        <option value="">Chọn chủ đề</option>
                        @foreach ($topics as $topic)
                            <option value="{{ $topic->id }}" {{ old('topic_id') == $topic->id ? 'selected' : '' }}>{{ $topic->name }}</option>              
                        @endforeach             
                    </select>
                    @error('topic_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
               </div>

                <button type="submit" class="w-full bg-blue-500 text-white rounded-md px-2 py-2 mt-5 hover:bg-blue-700">Tạo</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let answerCount = 1;
        function updateAnswerIndexes() {
            $('#answers-container .answer').each(function(index) {
                const newIndex = index + 1;
                $(this).find('label').text(String.fromCharCode(64 + newIndex));
                $(this).find('input[type="radio"]').val(newIndex);
                $(this).find('input[name="answer_index[]"]').val(String.fromCharCode(64 + newIndex));
            });
        }

        $('#add-answer').click(function() {
            const answerDiv = $('<div>', { class: 'flex gap-1 items-center py-2 answer' });
            const newIndex = $('#answers-container .answer').length + 1;
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

@if ($errors->any())
    <script>
        $(document).ready(function() {
            $('#questionFormModal').removeClass('hidden');
            $('#overlay').removeClass('hidden');
        }); 
    </script>
@endif