@extends('layouts.admin')

@section('title', 'WindClassRoom')

@section('content')
    @include('partial.toast-message')
    <div class="bg-gray-50 min-h-[calc(100vh-65px)]">
        <div class="border border-1 px-5 py-5 bg-white font-medium w-full">
            <h1>Thông tin giáo viên</h1>
        </div>
        <form action="{{ route('admin.teacher.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="class_room_id" value="">
            <div class="my-6 mx-20 bg-white shadow-lg">
                <div class="py-5 px-6 space-y-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-full">
                            <label for="name" class="font-medium text-gray-900 block mb-2">Họ và tên</label>
                            <input type="text" name="name" value="{{ $teacher->name }}" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-2.5">
                        </div>
                       
                        <div class="col-span-6 sm:col-span-3">
                            <label for="email" class="text-sm font-medium text-gray-900 block mb-2">Email</label>
                            <input type="text" name="email"  value="{{ $teacher->email }}" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-2.5">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="phone" class="text-sm font-medium text-gray-900 block mb-2">Số điện thoại</label>
                            <input type="text" name="phone"  value="{{ $teacher->phone }}" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-2.5">
                        </div>  
                        <div class="col-span-6 sm:col-span-3">
                            <label for="birthday" class="text-sm font-medium text-gray-900 block mb-2">Ngày sinh</label>
                            <input type="date" name="birthday"  value="{{ $teacher->birthday }}" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-2.5">
                        </div> 
                        <div class="col-span-6 sm:col-span-3">
                            <label for="gender" class="text-sm font-medium text-gray-900 block mb-2">Giới tính</label>
                            <div class="border border-gray-300 p-2.5 rounded-md">
                                <input type="radio" name="gender" id="male" value="0" class="mr-2.5" {{ isset($teacher->gender) && $teacher->gender == 0 ? 'checked' : '' }}> 
                                <label for="male" class="mr-4">Nam</label>
                                <input type="radio" name="gender" id="female" value="1" class="mr-2.5" {{ isset($teacher->gender) && $teacher->gender == 1 ? 'checked' : '' }}>
                                <label for="female">Nữ</label>
                            </div>
                        </div>                                
                        <div class="col-span-full">
                            <label for="address" class="text-sm font-medium text-gray-900 block mb-2">Địa chỉ</label>
                            <textarea name="address" rows="2" class="border border-gray-300 text-gray-900 rounded-md focus:border-blue-300 w-full p-4">{{ $teacher->address }}</textarea>
                        </div>
                    </div>
                </div>
            
                <div class="p-4 border-t border-gray-200 rounded-b flex gap-3 justify-end">
                    <a href="{{ route('admin.teacher') }}" class="text-white bg-gray-500 hover:bg-gray-600 font-medium rounded-lg text-md px-5 py-2 text-center" type="submit">Hủy</a>
                    <button class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-lg text-md px-5 py-2 text-center" type="submit">Cập nhật</button>
                </div>      
            </div>
        </form>
    </div>
@stop
