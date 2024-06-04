@extends('layouts.master')

@section('title', 'WindClassRoom')

@section('content')
    <header class="bg-white border-b py-5 px-5 w-full fixed top-0">
        <nav>
            <ul class="flex flex-1 gap-3 items-center">
                <li>
                    <a href="{{ route('class.homework', $classRoom->id) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </a>
                </li>
                <li class="font-bold">{{ $homework->title }}</li>
            </ul>
        </nav>
    </header>

    <div class="grid grid-cols-3">
        <div class="col-span-2 px-10 py-6 mt-16">
            <iframe src="{{ $filePath }}" width="800" height="700"></iframe>
        </div>
        {{-- Đối với học sinh --}}
        <div class="border w-2/5 h-full py-4 px-6 fixed top-16 right-0 overflow-y-scroll"> 
            <div class="flex justify-between">
                <p class="font-medium">Hạn nộp bài tập:</p>  
                @if ($hasDeadlinePassed)
                    <p class="text-red-500">Đã hết hạn nộp bài</p>
                @else
                    <p> {{ $homework->end_date ? date('d/m/Y H:i', strtotime($homework->end_date)) : 'không có hạn nộp' }}</p>
                @endif
            </div>  
            <form action="{{ route('class.student.createAnswerHomeWork', ['homeworkId'=> $homework->id, 'studentId' => auth()->user()->id]) }}" method="POST">
                @csrf
                <div class="mt-6">
                    <p class="mb-4 font-bold">Trả lời:</p>
                    <textarea name="answer" id="editor">@if($isSubmitted){{ $homework->assignedUsers->where('id', auth()->user()->id)->first()->pivot->answer }}@endif</textarea>      
                </div>    
                <button type="submit" class="text-white font-medium rounded-lg text-md px-5 py-2 text-center w-full mt-10
                {{ $isSubmitted || $hasDeadlinePassed ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }}">Nộp Bài</button>
            </form>
        </div>        
    </div>
@stop

<script>
    document.addEventListener("DOMContentLoaded", function() {
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
        });
    });
</script>


