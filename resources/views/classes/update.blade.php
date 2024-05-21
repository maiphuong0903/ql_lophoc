@extends('layouts.classes')

@section('title', 'Sửa thông tin lớp học')

@section('content')
    @include('partial.toast-message')
    <div class="bg-white rounded-lg shadow relative m-10 lg:mx-80">
        <div class="flex items-start justify-between p-5 border-b rounded-t">
            <h3 class="text-xl font-medium">
                Thông tin lớp học
            </h3>
        </div>

        <div class="px-10 pt-6 pb-3 space-y-6">
            <form action="{{ route('class.update', $classRoom->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-full">
                        <label for="name" class="text-md font-medium text-gray-900 block mb-2">
                            Tên lớp học<span class="text-red-500 ml-1.5">*</span>
                        </label>
                        <input type="text" name="name" value="{{ $classRoom->name }}" class="shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-300 focus:border-blue-300 block w-full p-3" placeholder="Ví dụ: Lớp hóa học 11...">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-full">
                        <label for="description" class="text-md font-medium text-gray-900 block mb-2">
                            Giới thiệu
                        </label>
                       <textarea name="description" id="" cols="10" rows="5" class="shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-300 focus:border-blue-300 block w-full p-3">{{ $classRoom->description }}</textarea>
                       @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-full grid grid-cols-1 space-y-2">
                        <label class="text-md font-medium text-gray-900 mb-2">Ảnh bìa lớp</label>
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-60 p-10 group text-center">
                                <img id="imagePreview" class="has-mask h-44 w-60 mx-auto object-scale-down rounded-lg" src="{{ $classRoom->image }}" alt="Preview Image">                        
                                <div class="h-full w-full text-center flex flex-col items-center justify-center" id="imageUpload">
                                    <div class="flex flex-auto max-h-48 w-2/5 mx-auto -mt-10">
                                        <img class="has-mask h-36 object-center"
                                            src="https://img.freepik.com/free-vector/image-upload-concept-landing-page_52683-27130.jpg?size=338&ext=jpg"
                                            alt="freepik image">
                                    </div>
                                    <p class="pointer-none text-gray-500"><span class="text-md">Nhấp vào đây để chọn ảnh lớp</p>
                                </div>
                                <input type="file" class="hidden" name="image">
                            </label>
                            @error('image')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>             
                </div>
                <div class="p-6 border-t border-gray-200 rounded-b flex gap-3 justify-end">
                    <a href="{{ route('class.newsfeed', $classRoom->id) }}" class="text-white bg-gray-500 hover:bg-gray-600 font-medium rounded-lg text-md px-5 py-2 text-center">Hủy</a>
                    <button type="button" class="text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-md px-5 py-2 text-center" id="deleteButton" data-modal-target="deleteModal" data-modal-toggle="deleteModal" data-class-id="{{ $classRoom->id }}">Xóa lớp học</button>
                    <button type="submit" class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-md px-5 py-2 text-center">Lưu lại</button>
                </div>
            </form>
        </div>

        {{-- Modal --}}
        @include('partial.modal-delete')
    </div>
@stop

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let imagePreview = $('#imagePreview');
        let classRoomImage = "{{ $classRoom->image }}";
        if (classRoomImage.trim() !== '') {
            imagePreview.attr('src', classRoomImage).removeClass('hidden');
            $('#imageUpload').addClass('hidden');
        } else {
            $('#imageUpload').removeClass('hidden');
            $('#imagePreview').addClass('hidden');
        }

        $('input[type="file"]').change(function(event) {
            let input = event.target;
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.attr('src', e.target.result).removeClass('hidden');
                    $('#imageUpload').addClass('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        });

        $('#deleteButton').click(function(){
            $('#deleteModal').toggleClass('hidden');
            let classId = $(this).data('class-id');         
            let formAction = "{{ route('class.destroy', ':classId') }}".replace(':classId', classId);          
            $('#deleteForm').attr('action', formAction);
        });

        $('[data-modal-toggle="deleteModal"]').click(function(){
            $('#deleteModal').toggleClass('hidden');
        });
    });
</script>