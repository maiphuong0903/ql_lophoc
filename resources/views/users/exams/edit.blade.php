@extends('layouts.class-info')

@section('title', 'WindClassRoom')

@section('content')
<div class="bg-gray-50 min-h-[calc(100vh-65px)]">
    <div class="border border-1 px-5 py-5 bg-white font-medium w-full">
        <h1>Cập nhật bài kiểm tra</h1>
    </div>
    <form action="{{ route('class.exams.update', ['id' => $classRoom->id, 'examId' => $exam->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="my-6 mx-20 bg-white shadow-lg">
            <div class="py-5 px-6 space-y-6">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-full">
                        <label for="title" class="font-medium text-gray-900 block mb-2">Tiêu đề</label>
                        <input type="text" name="title" id="title" value="{{ $exam->title }}" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-2.5">
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="time" class="text-md font-medium text-gray-900 block mb-2">Thời gian làm bài (phút)</label>
                        <input type="text" name="time" id="time" value="{{ $exam->time }}" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-2.5" placeholder="Nhập thời gian làm bài theo số phút...">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="expiration_date" class="text-md font-medium text-gray-900 block mb-2">Ngày hết hạn làm bài</label>
                        <input type="date" name="expiration_date" value="{{ $exam->expiration_date }}" id="expiration_date" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-2.5">
                    </div>
                    <div class="col-span-full">
                        <label for="questions" class="text-md font-medium text-gray-900 block mb-2">Chọn câu hỏi</label>
                        <div class="px-3">
                            @foreach($listTopic as $topic)
                            <div class="mb-4">
                                <h4 class="font-semibold">{{ $topic->name }}</h4>
                                @foreach($topic->questions as $question)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="questions[]" value="{{ $question->id }}" id="question_{{ $question->id }}" {{ in_array($question->id, $exam->questions->pluck('id')->toArray()) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="question_{{ $question->id }}">
                                            {{ $question->content }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach                        
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="p-4 border-t border-gray-200 rounded-b flex gap-3 justify-end">
                <a href="{{ route('class.exams', $classRoom->id) }}" class="text-white bg-gray-500 hover:bg-gray-600 font-medium rounded-lg text-md px-5 py-2 text-center">Hủy</a>
                <button class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-md px-5 py-2 text-center" type="submit">Cập nhật</button>
            </div>      
        </div>
    </form>
</div>
@endsection
