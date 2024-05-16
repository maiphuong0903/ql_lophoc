@extends('layouts.guest')

@section('title', 'Đăng Ký')


@section('content')
    <h1 class="text-xl font-semibold text-center">ĐĂNG KÝ</h1>
    <form class="mt-4" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label class="mb-2 block text-md font-semibold">Họ và Tên</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Họ và tên" class="cursor-pointer block w-full rounded-md border border-gray-300 focus:border-blue-300 focus:outline-none focus:ring-1 focus:ring-blue-300 py-1 px-2" />
            @error('name')
                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="mb-2 block text-md font-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="email@gmail.com" class="cursor-pointer block w-full rounded-md border border-gray-300 focus:border-blue-300 focus:outline-none focus:ring-1 focus:ring-blue-300 py-1 px-2" />
            @error('email')
                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="mb-2 block text-md font-semibold">Mật Khẩu</label>
            <input type="password" name="password" placeholder="******" class="cursor-pointer block w-full rounded-md border border-gray-300 focus:border-blue-300 focus:outline-none focus:ring-1 focus:ring-blue-300 py-1 px-2" />
            @error('password')
                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-7">
            <label class="mb-2 block text-md font-semibold">Vai trò</label>
            <select name="role" id="" class="cursor-pointer block w-full rounded-md border border-gray-300 focus:border-blue-300 focus:outline-none focus:ring-1 focus:ring-blue-300 py-1 px-2">
                <option value="">Chọn vai trò</option>
                <option value="2" {{ old('role') == '2' ? 'selected' : '' }}>Giáo viên</option>
                <option value="3" {{ old('role') == '3' ? 'selected' : '' }}>Học sinh</option>
                <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Lãnh đạo</option>
            </select>
            @error('role')
                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <button
                class="mb-1.5 block w-full text-center text-white bg-blue-600 hover:bg-blue-700 px-2 py-1.5 rounded-md">Đăng ký</button>
            <button
                class="flex flex-wrap justify-center w-full border border-gray-300 hover:bg-gray-100 px-2 py-1.5 rounded-md mt-3 items-center">
                <img class="w-5 mr-2" src="https://lh3.googleusercontent.com/COxitqgJr1sJnIDe8-jiKhxDx1FrYbtRHKJ9z_hELisAlapwE9LUPh6fcXIfb5vwpbMl4xl9H9TRFPc5NOO8Sb3VSgIBrfRYvW6cUA">
                <span class="font-medium text-sm">Đăng nhập với Google</span>
            </button>
        </div>
    </form>
    <div class="text-center">
        <span class="text-[13px] text-gray-400 font-semibold">Đã có tài khoản?</span>
        <a href="{{ route('login') }}" class="text-[13px] font-semibold text-blue-500">Đăng nhập ngay</a>
    </div>
@stop
