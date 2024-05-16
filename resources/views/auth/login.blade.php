@extends('layouts.guest')

@section('title', 'Đăng Nhập')

@section('content')
    @include('partial.toast-message')
    <h1 class="text-xl font-semibold text-center">ĐĂNG NHẬP</h1>
    <form class="mt-4" method="POST" action="{{ route('login') }}">
        @csrf
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
        <div class="mb-5 flex justify-end items-center">
            <a href="{{ route('password.request') }}" class="text-sm font-semibold">Quên mật khẩu?</a>          
        </div>
        <div class="mb-3">
            <button
                class="mb-1.5 block w-full text-center text-white bg-blue-600 hover:bg-blue-700 px-2 py-1.5 rounded-md">Đăng nhập</button>
            <button
                class="flex flex-wrap justify-center w-full border border-gray-300 hover:bg-gray-100 px-2 py-1.5 rounded-md mt-3 items-center">
                <img class="w-5 mr-2" src="https://lh3.googleusercontent.com/COxitqgJr1sJnIDe8-jiKhxDx1FrYbtRHKJ9z_hELisAlapwE9LUPh6fcXIfb5vwpbMl4xl9H9TRFPc5NOO8Sb3VSgIBrfRYvW6cUA">
                <span class="font-medium text-sm">Đăng nhập với Google</span>
            </button>
        </div>
    </form>
    <div class="text-center">
        <span class="text-[13px] text-gray-400 font-semibold">Chưa có tài khoản?</span>
        <a href="{{ route('register') }}" class="text-[13px] font-semibold text-blue-500">Đăng ký ngay</a>
    </div>
@stop

