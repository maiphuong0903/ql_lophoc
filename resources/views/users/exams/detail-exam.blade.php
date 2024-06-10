@extends('layouts.class-info')

@section('title', 'WindClassRoom')

@section('content')
    <header class="bg-white border-b p-5 w-full mt-2">
        <nav>
            <ul class="flex flex-1 gap-3 items-center">
                <li class="font-bold">
                    <a href="{{ route('class.exams', $classRoom->id) }}">Bài kiểm tra</a>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                    </svg>
                </li>
                <li>{{ $exam->title }}</li>
            </ul>
        </nav>
    </header>

    {{--  nội dung bài kiểm tra --}}
    <div class="max-w-screen-lg mx-auto my-3 p-6">
        @include('users.exams.content-exam')
    </div>    
@endsection
