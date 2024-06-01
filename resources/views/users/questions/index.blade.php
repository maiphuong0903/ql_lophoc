@extends('layouts.class-info')

@section('title', 'Members')

@section('content')
    @include('partial.toast-message')
    <div class="border border-1 px-5 py-5 bg-white font-medium">
        <h1>Bài tập</h1>
    </div>
    <div class="grid grid-cols-5">
        @include('users.topics.index')
        <div class="col-span-4">

            {{-- search --}}
            <div class="mt-5 mb-5 grid grid-cols-7 gap-3 mx-5">
                <div class="col-span-4">
                    <form action="{{ route('class.questions', $classRoom->id) }}" method="GET" class="w-full">
                        <div class="relative flex justify-between items-center">
                            <input type="text" name="search"
                                class="border border-gray-300 rounded-md focus:border-blue-50 focus:outline-none w-full cursor-pointer"
                                placeholder="Tìm kiếm theo tiêu đề...">
                            <button type="submit" class="text-gray-500 absolute right-0 mr-2 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-span-2">
                    <button id="sort-dropdown" data-dropdown-toggle="dropdown"
                        class="border border-gray-300 focus:border-blue-500 bg-white rounded-md text-md px-3 py-2 text-center inline-flex items-center w-full justify-between"
                        type="button">Sắp xếp
                        <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>

                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-72">
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="{{ route('class.questions', ['id' => $classRoom->id, 'sort_by' => 'asc']) }}"
                                    class="block px-4 py-2 hover:bg-gray-100">A-Z</a>
                            </li>
                            <li>
                                <a href="{{ route('class.questions', ['id' => $classRoom->id, 'sort_by' => 'desc']) }}"
                                    class="block px-4 py-2 hover:bg-gray-100">Z-A</a>
                            </li>
                            <li>
                                <a href="{{ route('class.questions', ['id' => $classRoom->id, 'sort_by' => 'newest']) }}"
                                    class="block px-4 py-2 hover:bg-gray-100">Mới nhất</a>
                            </li>
                            <li>
                                <a href="{{ route('class.questions', ['id' => $classRoom->id, 'sort_by' => 'oldest']) }}"
                                    class="block px-4 py-2 hover:bg-gray-100">Cũ nhất</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-span-1">
                    <div class="flex items-center gap-2 bg-blue-500 py-2 px-2 rounded-md text-white justify-center">
                        <button id="openQuestionForm">Tạo câu hỏi</button>
                        @include('users.questions.create')
                    </div>
                </div>
            </div>

            {{-- checkbox --}}
            {{-- <form action="{{ route('class.exams.store', $classRoom->id) }}" method="POST">
                @csrf
                <div class="bg-gray-100 py-3 px-5 mb-3 flex gap-3 items-center justify-between">
                    <div class="flex gap-3 items-center">
                        <input type="checkbox">
                        <p>Chọn tất cả</p>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-md text-md px-7 py-2 text-center">Tạo
                        bài kiểm tra</button>
                </div> --}}


                {{-- danh sách câu hỏi --}}
                @forelse ($questions as $key => $question)
                    <div class="hover:bg-gray-100 py-3 px-5">
                        <div class="flex flex-1 justify-between items-center px-2cursor-pointer ">
                            <div class="flex gap-2 items-center">
                                <p>Câu {{ $key + 1 }}: </p>
                                <h1 class="text-gray-950 text-[15px] font-medium">{{ $question->content }}</h1>
                            </div>
                            <div class="flex gap-5 items-center">
                                <div class="relative">
                                    <button type="button" class="flex items-center menu-question-toggle">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                        </svg>
                                    </button>
                                    <div
                                        class="menu-question hidden absolute right-0 w-48 bg-white rounded-lg shadow-2xl z-10">
                                        <div class="flex flex-1 items-center gap-2 px-4 py-2 hover:bg-gray-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>

                                            <button type="button" data-question-id="{{ $question->id }}"
                                                data-question-content="{{ $question->content }}"
                                                data-question-topic-id="{{ $question->topic_id }}"
                                                @foreach ($question->answers as $index => $answer)
                                                    data-answer-{{ $index + 1 }}="{{ $answer->answer_content }}"
                                                    data-is-correct-{{ $index + 1 }}="{{ $answer->is_correct }}" @endforeach
                                                class="openEditQuestionForm block text-md">
                                                Thông tin câu hỏi
                                            </button>
                                        </div>
                                        <div class="flex flex-1 items-center gap-2 px-4 py-2 hover:bg-gray-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                            </svg>
                                            <button type="button" class="deleteQuestion block text-md"
                                                data-question-id="{{ $question->id }}" data-modal-target="deleteModal"
                                                data-modal-toggle="deleteModal">Xóa câu hỏi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @include('users.questions.edit')
        @empty
            <p class="text-center mt-5">Không có câu hỏi nào</p>
            @endforelse
        </div>
    </div>
@stop
<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script>
    $(document).ready(function() {
        // Mở form tạo câu hỏi
        $('#openQuestionForm').on('click', function() {
            $('#questionFormModal').removeClass('hidden');
            $('#overlay').removeClass('hidden');
        });

        // Đóng form tạo câu hỏi
        $('#closeQuestionForm').on('click', function() {
            $('#questionFormModal').addClass('hidden');
            $('#overlay').addClass('hidden');
        });

        // Hiển thị menu khi click vào icon của question
        $('.menu-question-toggle').click(function() {
            var $menu = $(this).siblings('.menu-question');
            $('.menu-question').not($menu).addClass('hidden');
            $menu.toggleClass('hidden');
        });

        // Ẩn menu khi click ra ngoài
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.menu-question-toggle').length && !$(event.target).closest(
                    '.menu-question').length) {
                $('.menu-question').addClass('hidden');
            }
        });

        // Mở form xóa câu hỏi
        $(document).on('click', '.deleteQuestion', function() {
            $('.menu-question').addClass('hidden');
            $('#deleteModal').removeClass('hidden');
            let questionId = $(this).data('question-id');
            let formAction = "{{ route('class.questions.destroy', ':questionId') }}".replace(':questionId', questionId);
            $('#deleteForm').attr('action', formAction);
        });

        // Đóng form xóa câu hỏi
        $('[data-modal-toggle="deleteModal"]').click(function() {
            $('#deleteModal').addClass('hidden');
        });

        // Mở form sửa câu hỏi
        $('.openEditQuestionForm').on('click', function() {
            $('#editQuestionFormModal').removeClass('hidden');
            $('#overlay').removeClass('hidden');
            $(this).closest('.menu-question').toggleClass('hidden');

            let questionId = $(this).data('question-id');
            let questionContent = $(this).data('question-content');
            let questionTopic = $(this).data('question-topic-id');

            let answers = [];
            let correctAnswers = [];
            
            for (let i = 1; i <= 4; i++) {
                let answer = $(this).data('answer-' + i);
                let isCorrect = $(this).data('is-correct-' + i);
                if (answer !== undefined) {
                    answers.push(answer);
                    correctAnswers.push(isCorrect);
                }
            }

            let formAction = "{{ route('class.questions.update', ':questionId') }}".replace(':questionId', questionId);
            $('#questionForm').attr('action', formAction);

            $('#questionContent').val(questionContent);
            $('#questionTopic').val(questionTopic); 
           
            answers.forEach((answer, index) => {                       
                $(`input[name='answers_content[]']`).eq(index).val(answer);
                if (correctAnswers[index]) {
                    $(`input[name='is_correct'][value='${index + 1}']`).prop('checked', true);
                }
            });
        });

        // Đóng form sửa câu hỏi
        $('#closeEditQuestionForm').on('click', function() {
            $('#editQuestionFormModal').addClass('hidden');
            $('#overlay').addClass('hidden');
            $('.menu-question').addClass('hidden');
        });
    });
</script>
