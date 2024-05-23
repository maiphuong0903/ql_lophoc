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
                <label for="">Câu hỏi: </label>
                <textarea name="content" id="" cols="10" rows="3" class="w-full border-gray-300 rounded-md font-light focus:border-blue-50 mb-3 mt-2"></textarea>

                <p class="mb-2">Đáp án:</p>
                
                <div class="px-3">
                    <div class="flex gap-1 items-center py-2">
                        <input type="radio" name="is_correct" value="1"> <label for="">A</label> <input type="text" name="answer_content[]" id="" class="w-full ml-2">
                    </div>
                    <div class="flex gap-1 items-center py-2">
                        <input type="radio" name="is_correct" value="2"> <label for="">B</label> <input type="text" name="answer_content[]" id="" class="w-full ml-2">
                    </div>
                    <div class="flex gap-1 items-center py-2">
                        <input type="radio" name="is_correct" value="3"> <label for="">C</label> <input type="text" name="answer_content[]" id="" class="w-full ml-2">
                    </div>
                    <div class="flex gap-1 items-center py-2">
                        <input type="radio" name="is_correct" value="4"> <label for="">D</label> <input type="text" name="answer_content[]" id="" class="w-full ml-2">
                    </div>
                </div>
                
                <div class="mt-5">
                    <label for="">Chủ đề: </label>
                    <select name="topic_id" id="" class="w-full border-gray-300 rounded-md font-light focus:border-blue-50 mb-3">
                        <option value="">Chọn chủ đề</option>
                        @foreach ($topics as $topic)
                            <option value="{{ $topic->id }}">{{ $topic->name }}</option>              
                        @endforeach             
                    </select>
               </div>

                <button type="submit" class="w-full bg-blue-500 text-white rounded-md px-2 py-2 mt-5 hover:bg-blue-700">Tạo</button>
            </form>
        </div>
    </div>
</div>

