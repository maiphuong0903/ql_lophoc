@extends('layouts.class-info')

@section('title', 'WindClassRoom')

@section('content')
    <div class="bg-gray-50 min-h-[calc(100vh-65px)]">
        <div class="border border-1 px-5 py-5 bg-white font-medium w-full">
            <h1>Tạo bài kiểm tra</h1>
        </div>
        <form action="">      
            <div class="my-6 mx-20 bg-white shadow-lg">
                <div class="py-5 px-6 space-y-6">
                    <form action="#">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="name" class="font-medium text-gray-900 block mb-2">Tiêu đề</label>
                                <input type="text" name="name" id="name" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-2.5">
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="topic" class="font-medium text-gray-900 block mb-2">Loại</label>
                                <select class="p-2.5 w-full border-gray-300 rounded-lg focus:border-blue-300">
                                    <option>Lấy điểm</option>
                                    <option>Không lấy điểm</option>
                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="brand" class="text-sm font-medium text-gray-900 block mb-2">Thời gian bắt đầu</label>
                                <input type="date" name="name" id="name" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-2.5">
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="price" class="text-sm font-medium text-gray-900 block mb-2">Thời gian kết thúc</label>
                                <input type="date" name="name" id="name" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-2.5">
                            </div>
                            <div class="col-span-full">
                                <label for="product-details" class="text-sm font-medium text-gray-900 block mb-2">Chọn câu hỏi</label>
                                <input type="checkbox" name="selected_questions[]" value="">
                            </div>
                            <div class="col-span-full">
                                <label for="product-details" class="text-sm font-medium text-gray-900 block mb-2">Hướng dẫn làm bài</label>
                                <textarea id="product-details" rows="3" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-4"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            
                <div class="p-4 border-t border-gray-200 rounded-b flex gap-3 justify-end">
                    <a class="text-white bg-gray-500 hover:bg-gray-600 font-medium rounded-lg text-md px-5 py-2 text-center">Hủy</a>
                    <button class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-md px-5 py-2 text-center" type="submit">Tạo bài</button>
                </div>      
            </div>
        </form>
    </div>
@stop

