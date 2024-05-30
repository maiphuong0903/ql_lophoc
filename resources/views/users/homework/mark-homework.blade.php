@extends('layouts.master')

@section('title', 'Members')

@section('content')
    @include('partial.toast-message')
    <header class="bg-white border-b py-5 px-5 w-full fixed top-0">
        <nav>
            <ul class="flex flex-1 gap-3 items-center">
                <li>
                    <a href="{{ route('class.homework.info', ['id' => $classRoom->id, 'homeworkId' => $homework->id ]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </a>
                </li>
                <li class="font-bold">{{ $homework->title }}</li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                    </svg>
                </li>
                <li>{{ $student->name }}</li>
            </ul>
        </nav>
    </header>

    <div>
        <div class="px-10 py-8 mt-28 mb-10 bg-blue-50 border rounded-lg shadow-md mx-16 mr-[28rem] min-h-[calc(100vh-170px)]">
            <p>{!! $homework->assignedUsers->first()->pivot->answer !!}</p>
        </div>
        {{-- Đối với trang teacher --}}
        <div class="border-l w-1/4 h-full p-6 fixed top-16 right-0 overflow-y-scroll">
            @if ($homework->isGradedByTeacher($student->id))
                <button class="text-white bg-blue-600 font-medium rounded-lg text-md px-5 py-2 text-center w-full">Kết quả chấm điểm</button>
                <div>
                    <div class="mt-6 border rounded-xl">
                        <div class="flex gap-3 justify-center items-center py-6 bg-blue-700 rounded-t-xl text-white">
                            <h1 class="text-2xl" id="currentScore">{{ $homework->assignedUsers->first()->pivot->score }}</h1>
                            <button type="button" data-class-room-id="{{ $classRoom->id }}" data-home-work-id="{{ $homework->id }}" data-student-id="{{ $student->id }}" class="openEditScoreForm block text-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>                      
                            </button>
                            @include('users.homework.edit-score-homework')
                        </div>
                    
                        <div class="my-6 flex justify-between px-4">
                            <p>Nộp bài lúc</p>
                            <span class="font-medium text-[15px]">{{ \Carbon\Carbon::parse($homework->assignedUsers->first()->pivot->created_at)->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                    <div class="mt-6 border rounded-xl">
                        <div class="flex gap-3 justify-between items-center py-3 bg-gray-200 rounded-t-xl px-3">
                            <h1 class="font-medium">Lời phê của giáo viên</h1>
                            <button type="button" data-class-room-id="{{ $classRoom->id }}" data-home-work-id="{{ $homework->id }}" data-student-id="{{ $student->id }}" class="openEditCommentForm block text-md">
                                Chỉnh sửa                    
                            </button> 
                            @include('users.homework.edit-comment-homework')              
                        </div>
                        <p class="px-3 py-3 h-48" id="currentComment">{{ $homework->assignedUsers->first()->pivot->comment }}</p>
                    </div>
                </div>          
            @else
                <button class="text-white bg-blue-600 font-medium rounded-lg text-md px-5 py-2 text-center w-full">Đáp án của học sinh</button>
                <div>
                    <form action="{{ route('class.homework.markHomework', ['id' => $classRoom->id, 'homeworkId' => $homework->id, 'studentId' => $student->id]) }}" method="POST">
                        @csrf          
                        <div class="mb-10 flex justify-between mt-3">
                            <p>Nộp bài lúc</p>
                            <span class="font-medium text-[15px]">{{ \Carbon\Carbon::parse($homework->assignedUsers->first()->pivot->created_at)->format('d/m/Y H:i') }}</span>
                        </div>
            
                        <p class="font-medium">Điểm</p>
                        <input type="text" name="score" id="score" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-3 mt-2">
            
                        <p class="font-medium mt-7 mb-2">Lời phê</p>
                        <textarea name="comment" rows="8" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-4"></textarea>
            
                        <button type="submit" class="text-white bg-blue-500 hover:bg-blue-800 font-medium rounded-lg text-md px-5 py-4 text-center w-full mt-5">Chấm điểm</button>
                    </form>
                </div>        
            @endif
            
        </div>

    </div>
@stop

<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
        });
    });

    $(document).ready(function() {
        // Mở form sửa điểm
        $('.openEditScoreForm').on('click', function() {
            let score = document.getElementById('currentScore').innerText;
            $('#editScoreFormModal').removeClass('hidden');

            let classRoomId = $(this).data('class-room-id');
            let homeWorkId = $(this).data('home-work-id');
            let studentId = $(this).data('student-id');

            let formAction = "{{ route('class.homework.editScoreHomework', [':id', ':homeworkId', ':studentId']) }}";     
            formAction = formAction.replace(':id', classRoomId);
            formAction = formAction.replace(':homeworkId', homeWorkId);   
            formAction = formAction.replace(':studentId', studentId);  
     
            $('#scoreForm').attr('action', formAction);

            $('#scoreInput').val(score);
        });

        // Đóng form sửa điểm
        $('#closeEditScoreForm').on('click', function() {
            $('#editScoreFormModal').addClass('hidden');
            $('#overlay').addClass('hidden');
        });

        // Mở form sửa lời phê
        $('.openEditCommentForm').on('click', function() {
            let comment = $('#currentComment').text().trim();
            $('#editCommentFormModal').removeClass('hidden');

            let classRoomId = $(this).data('class-room-id');
            let homeWorkId = $(this).data('home-work-id');
            let studentId = $(this).data('student-id');

            let formAction = "{{ route('class.homework.editCommentHomework', [':id', ':homeworkId', ':studentId']) }}";     
            formAction = formAction.replace(':id', classRoomId);
            formAction = formAction.replace(':homeworkId', homeWorkId);   
            formAction = formAction.replace(':studentId', studentId);  
     
            $('#commentForm').attr('action', formAction);

            $('#commentInput').val(comment);
        });

        // Đóng form sửa lời phê
        $('#closeEditCommentForm').on('click', function() {
            $('#editCommentFormModal').addClass('hidden');
            $('#overlay').addClass('hidden');
        });
    });
</script>


