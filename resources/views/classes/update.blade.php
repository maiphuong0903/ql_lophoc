@extends('layouts.classes')

@section('title', 'Sửa thông tin lớp học')


@section('content')
    <div class="bg-white rounded-lg shadow relative m-10 lg:mx-80">
        <div class="flex items-start justify-between p-5 border-b rounded-t">
            <h3 class="text-xl font-medium">
                Sửa thông tin lớp học
            </h3>
        </div>

        <div class="px-10 py-6 space-y-6">
            <form action="">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-full">
                        <label for="name" class="text-md font-medium text-gray-900 block mb-2">
                            Tên lớp học<span class="text-red-500 ml-1.5">*</span>
                        </label>
                        <input type="text" name="name" class="shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-300 focus:border-blue-300 block w-full p-3" placeholder="Ví dụ: Lớp hóa học 11...">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="name" class="text-md font-medium text-gray-900 block mb-2">
                            Môn học<span class="text-red-500 ml-1.5">*</span>
                        </label>
                        <select id="subject"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-300 block w-full p-3">
                            <option selected>Chọn môn học</option>
                            <option value="toan">Toán</option>
                            <option value="hoa">Hóa</option>
                            <option value="daiso">Đại số</option>
                            <option value="giaitich">Giải tích</option>
                            <option value="khac">Khác</option>
                        </select>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="name" class="text-md font-medium text-gray-900 block mb-2">
                            Khối lớp<span class="text-red-500 ml-1.5">*</span>
                        </label>
                        <select id="class"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-300 focus:border-blue-300 block w-full p-3">
                            <option selected>Chọn khối lớp học</option>
                            <option value="6">Khối 6</option>
                            <option value="7">Khối 7</option>
                            <option value="8">Khối 8</option>
                            <option value="9">Khối 9</option>
                            <option value="khac">Khác</option>
                        </select>
                    </div>
                    <div class="col-span-full grid grid-cols-1 space-y-2">
                        <label class="text-md font-medium text-gray-900 mb-2">Ảnh bìa lớp</label>
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-60 p-10 group text-center">
                                <div class="h-full w-full text-center flex flex-col items-center justify-center">
                                    <div class="flex flex-auto max-h-48 w-2/5 mx-auto -mt-10">
                                        <img class="has-mask h-36 object-center"
                                            src="https://img.freepik.com/free-vector/image-upload-concept-landing-page_52683-27130.jpg?size=338&ext=jpg"
                                            alt="freepik image">
                                    </div>
                                    <p class="pointer-none text-gray-500 "><span class="text-md">Kéo và thả</span> hình ảnh vào đây <br /> hoặc 
                                        <a href="" id="" class="text-blue-600 hover:underline">Chọn một ảnh</a> từ máy tính của bạn
                                    </p>
                                </div>
                                <input type="file" class="hidden">
                            </label>
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>

        <div class="p-6 border-t border-gray-200 rounded-b flex gap-5 justify-end">
            <button class="text-white bg-red-500 hover:bg-red-600 font-medium rounded-lg text-md px-5 py-2 text-center" type="submit">Xóa lớp học</button>
            <button class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-md px-5 py-2 text-center" type="submit">Lưu lại</button>
        </div>
    </div>
@stop
