@extends('layouts.classes')

@section('title', 'Tạo lớp học')

@section('content')
    <div class="bg-white rounded-lg shadow relative m-5 lg:mx-56">
        <div class="flex items-start justify-between p-5 border-b rounded-t">
            <h3 class="text-xl font-medium">
                Tạo lớp học
            </h3>
        </div>
        <div class="px-10 pt-6 space-y-6">
            <form method="POST" action="{{ route('class.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-span-full mb-6">
                    <label for="name" class="text-md font-medium text-gray-900 block mb-2">
                        Tên lớp học<span class="text-red-500 ml-1.5">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" class="mb-2 shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-300 focus:border-blue-300 block w-full p-3" placeholder="Ví dụ: Lớp hóa học 11...">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full mb-6">
                    <label for="description" class="text-md font-medium text-gray-900 block mb-2">
                        Giới thiệu
                    </label>
                   <textarea name="description" id="" cols="10" rows="5" class="mb-2 shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-300 focus:border-blue-300 block w-full p-3">{{ old('description') }}</textarea>
                   @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-full grid grid-cols-1 space-y-2">
                    <label for="image" class="text-md font-medium text-gray-900 block mb-2">
                        Ảnh đại diện
                    </label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-60 p-10 group text-center">
                            <img id="imagePreview" class="hidden has-mask h-44 w-60 mx-auto object-scale-down rounded-lg" src="" alt="Preview Image">
                            <div class="h-full w-full text-center flex flex-col items-center justify-center" id="imageUpload">
                                <div class="flex flex-auto max-h-48 w-2/5 mx-auto -mt-10">
                                    <img class="has-mask h-36 object-center"
                                        src="https://img.freepik.com/free-vector/image-upload-concept-landing-page_52683-27130.jpg?size=338&ext=jpg"
                                        alt="freepik image">
                                </div>
                                <p class="pointer-none text-gray-500"><span class="text-md">Nhấp vào đây để chọn ảnh lớp</p>
                            </div>
                            <input type="file" class="hidden" id="fileInput" name="image">
                        </label>
                    </div>
                    @error('image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-10 py-6 border-t border-gray-200 rounded-b flex justify-end">
                    <button class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-md px-5 py-2 text-center" type="submit">Tạo lớp</button>
                </div>
            </form>
        </div>
    </div>
@stop

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('input[type="file"]').change(function(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var file = input.files[0];
                    if (file.type.includes('image')) {
                        var imageUrl = e.target.result; 
                        $('#imagePreview').attr('src', imageUrl);
                        $('#imagePreview').removeClass('hidden');
                        $('#imageUpload').addClass('hidden');
                    }else {
                        var otherFileName = file.name;
                        $('#imagePreview').addClass('hidden');
                        $('#imageUpload').removeClass('hidden');
                        $('#imageUpload').html('<p class="pointer-none text-gray-500"><span class="text-md">' + otherFileName + '</span></p>');
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>

