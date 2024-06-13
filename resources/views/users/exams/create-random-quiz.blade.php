@extends('layouts.class-info')

@section('title', 'WindClassRoom')

@section('content')
<div class="bg-gray-50 min-h-[calc(100vh-65px)]">
    <div class="border border-1 px-5 py-5 bg-white font-medium w-full">
        <h1>Tạo ngẫu nhiên bài kiểm tra</h1>
    </div>
    <form action="{{ route('class.exams.storeRandom', $classRoom->id) }}" method="POST">
        @csrf
        <div class="my-6 mx-20 bg-white shadow-lg">
            <div class="py-5 px-6 space-y-6">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-full">
                        <label for="title" class="font-medium text-gray-900 block mb-2">Tiêu đề <span class="text-red-500">*</span></label>
                        <input type="text" value="{{ old('title') }}" name="title" id="title" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-2.5">
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="time" class="text-md font-medium text-gray-900 block mb-2">Thời gian làm bài (phút) <span class="text-red-500">*</span></label>
                        <input type="number" value="{{ old('time') }}" name="time" id="time" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-2.5" placeholder="Nhập thời gian làm bài theo số phút...">
                        @error('time')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="expiration_date" class="text-md font-medium text-gray-900 block mb-2">Ngày hết hạn làm bài <span class="text-red-500">*</span></label>
                        <input type="date" value="{{ old('expiration_date') }}" name="expiration_date" id="expiration_date" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-2.5">
                        @error('expiration_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-full">
                        <label for="questions" class="text-md font-medium text-gray-900 block mb-2">Chọn số lượng câu hỏi cho từng chủ đề <span class="text-red-500">*</span></label>
                        <div class="px-3">
                            @foreach($listTopic as $topic)
                            <div class="mb-4 flex justify-between">
                                <h4 class="font-semibold">{{ $topic->name }}</h4>
                                <div class="flex flex-col items-end">
                                    <input type="number" value="{{ old('numQuestionsPerTopic.' . $topic->id) }}" id="topic_{{ $topic->id }}" name="numQuestionsPerTopic[{{ $topic->id }}]" class="w-16 p-1">
                                    @error('numQuestionsPerTopic.' . $topic->id)
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endforeach                        
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="p-4 border-t border-gray-200 rounded-b flex gap-3 justify-end">
                <a href="{{ route('class.exams', $classRoom->id) }}" class="text-white bg-gray-500 hover:bg-gray-600 font-medium rounded-lg text-md px-5 py-2 text-center">Hủy</a>
                <button class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-md px-5 py-2 text-center" type="submit">Tạo bài</button>
            </div>      
        </div>
    </form>
</div>
@endsection
