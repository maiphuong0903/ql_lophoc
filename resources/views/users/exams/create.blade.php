@extends('layouts.class-info')

@section('title', 'WindClassRoom')

@section('content')
    <div class="bg-gray-50 min-h-[calc(100vh-65px)]">
        <div class="border border-1 px-5 py-5 bg-white font-medium w-full">
            <h1>Chọn bài kiểm tra</h1>
        </div>
        <div class="my-6 mx-20 bg-white shadow-lg">
            <div class="py-5 px-6 space-y-6">
                <form action="#">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-full">
                            <label for="product-details" class="text-sm font-medium text-gray-900 block mb-2">Chọn đề kiểm tra</label>
                            <select class="p-2.5 w-full border-gray-300 rounded-lg focus:border-blue-300">
                                <option>Đề 1</option>
                                <option>Đề 2</option>
                                <option>Đề 3</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        
            <div class="p-4 border-t border-gray-200 rounded-b flex gap-3 justify-end">
                <button class="text-white bg-gray-500 hover:bg-gray-600 font-medium rounded-lg text-md px-5 py-2 text-center" type="submit">Hủy</button>
                <button class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-md px-5 py-2 text-center" type="submit">Tạo bài</button>
            </div>      
        </div>
    </div>
@stop

