@extends('layouts.class-info')

@section('title', 'Members')

@section('content')
    @include('partial.toast-message')
    <div class="bg-gray-50 min-h-[calc(100vh-65px)]">
        <div class="border border-1 px-5 py-5 bg-white font-medium w-full">
            <h1>Chỉnh sửa bài tập</h1>
        </div>
        <form action="{{ route('class.homework.update', ['id' => $classRoom->id, 'homeworkId' => $homework->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="class_room_id" value="{{ $classRoom->id }}">
            <div class="my-6 mx-20 bg-white shadow-lg">
                <div class="py-5 px-6 space-y-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="name" class="font-medium text-gray-900 block mb-2">Tiêu đề</label>
                            <input type="text" name="title" value="{{ $homework->title }}" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-2.5">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="topic_id" class="font-medium text-gray-900 block mb-2">Chủ đề</label>
                            <select class="p-2.5 w-full border-gray-300 rounded-lg focus:border-blue-300">
                                <option value="">Không có chủ đề</option>
                                @foreach ($topics as $topic)
                                    <option value="{{ $topic->id }}" {{ $topic->id == $homework->topic_id ? 'selected' : '' }}>{{ $topic->name }}</option>              
                                @endforeach 
                            </select>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="brand" class="text-sm font-medium text-gray-900 block mb-2">Thời gian bắt đầu</label>
                            <input type="date" name="created_date" value="{{ $homework->created_date }}" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-2.5">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="price" class="text-sm font-medium text-gray-900 block mb-2">Thời gian kết thúc</label>
                            <input type="date" name="end_date" value="{{ $homework->end_date }}" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-2.5">
                        </div>

                        <div class="col-span-full grid grid-cols-1 space-y-2">
                            <label for="">Đính kèm file: </label>
                            <div class="flex justify-between pb-2">
                                <span class="file-name">{{ $homework->homework_file }}</span>
                                <button id="removeFile" class="text-gray-500 hover:text-red-500 hidden show_file">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center justify-center w-full">
                                <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-32 p-10 group text-center">
                                    <div class="h-full w-full text-center flex flex-col items-center justify-center">
                                        <div class="border px-3 py-3 bg-gray-200 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                            </svg>
                                        </div>
                                        <p class="pointer-none text-[15px] mt-1.5"><span class="text-md">
                                                Tải lên
                                        </p>
                                    </div>
                                    <input type="file" id="fileInput" class="hidden" name="homework_file">
                                </label>
                            </div>
                        </div>  

                        <div class="col-span-full">
                            <label for="product-details" class="text-sm font-medium text-gray-900 block mb-2">Hướng dẫn làm bài</label>
                            <textarea name="description" rows="3" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-4">{{ $homework->description }}</textarea>
                        </div>
                    </div>
                </div>
            
                <div class="p-4 border-t border-gray-200 rounded-b flex gap-3 justify-end">
                    <a href="{{ route('class.homework', $classRoom->id) }}" class="text-white bg-gray-500 hover:bg-gray-600 font-medium rounded-lg text-md px-5 py-2 text-center">Hủy</a>
                    <button class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-md px-5 py-2 text-center" type="submit">Cập nhật</button>
                </div>      
            </div>
        </form>
    </div>
@stop

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        //show file thay đổi
        $('#fileInput').change(function() {
            const fileName = $(this).prop('files')[0].name;
            $('.file-name').text(fileName);
            $('.show_file').removeClass('hidden');
        });

         // Xóa file đã chọn
         $('#removeFile').click(function(event) {
            event.preventDefault();
            $('#fileInput').val(''); 
            $('.file-name').text(''); 
            $('.show_file').addClass('hidden'); 
        });

        let filePreview = $('#filePreview');
        let classRoomImage = "{{ $classRoom->image }}";
        if (classRoomImage.trim() !== '') {
            filePreview.attr('src', classRoomImage).removeClass('hidden');
            $('#fileUpload').addClass('hidden');
        } else {
            $('#fileUpload').removeClass('hidden');
            $('#filePreview').addClass('hidden');
        }

        $('input[type="file"]').change(function(event) {
            let input = event.target;
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    filePreview.attr('src', e.target.result).removeClass('hidden');
                    $('#fileUpload').addClass('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        });

    });
</script>

