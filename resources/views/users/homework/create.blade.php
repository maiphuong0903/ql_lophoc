@extends('layouts.class-info')

@section('title', 'Members')

@section('content')
    @include('partial.toast-message')
    <div class="bg-gray-50 min-h-[calc(100vh-65px)]">
        <div class="border border-1 px-5 py-5 bg-white font-medium w-full">
            <h1>Tạo bài tập</h1>
        </div>
        <form action="{{ route('class.homework.store', $classRoom->id) }}" method="POST">
            @csrf
            <input type="hidden" name="class_room_id" value="{{ $classRoom->id }}">
            <div class="my-6 mx-20 bg-white shadow-lg">
                <div class="py-5 px-6 space-y-6">
                    <form action="#">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="name" class="font-medium text-gray-900 block mb-2">Tiêu đề</label>
                                <input type="text" name="title" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-2.5">
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="topic_id" class="font-medium text-gray-900 block mb-2">Chủ đề</label>
                                <select class="p-2.5 w-full border-gray-300 rounded-lg focus:border-blue-300">
                                    <option value="">Không có chủ đề</option>
                                    @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}">{{ $topic->name }}</option>              
                                    @endforeach 
                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="brand" class="text-sm font-medium text-gray-900 block mb-2">Thời gian bắt đầu</label>
                                <input type="date" name="created_date" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-2.5">
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="price" class="text-sm font-medium text-gray-900 block mb-2">Thời gian kết thúc</label>
                                <input type="date" name="end_date" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-2.5">
                            </div>

                            <div class="col-span-full grid grid-cols-1 space-y-2">
                                <label for="homework_file">Homework File (PDF only):</label>
                                <input type="file" id="homework_file" name="homework_file">
                            </div>                                                          

                            <div class="col-span-full">
                                <label for="product-details" class="text-sm font-medium text-gray-900 block mb-2">Hướng dẫn làm bài</label>
                                <textarea name="description" rows="3" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-4"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            
                <div class="p-4 border-t border-gray-200 rounded-b flex gap-3 justify-end">
                    <button class="text-white bg-gray-500 hover:bg-gray-600 font-medium rounded-lg text-md px-5 py-2 text-center" type="submit">Hủy</button>
                    <button class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-md px-5 py-2 text-center" type="submit">Đăng bài</button>
                </div>      
            </div>
        </form>
    </div>
@stop

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // $(document).ready(function() {
    //     $('#fileInput').change(function(){
    //     var fileName = $(this).val().split('\\').pop(); 
    //     $('#fileLabel').text(fileName);
    // });
    // });
</script>

