@extends('layouts.guest')

@section('title', 'Quên Mật Khẩu')

@section('content')
    <h1 class="text-xl font-semibold text-center">QUÊN MẬT KHẨU</h1>
    @if (session('success'))
        <div class="text-green-500 font-semibold mt-3 text-sm text-center">
            {{ session('success') }}
        </div>
    @endif
    <form class="mt-4" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-5">
            <label class="mb-2 block text-md font-semibold">Email</label>
            <input type="text" name="email" value="{{ old('email') }}" placeholder="Nhập email lấy lại mật khẩu" class="cursor-pointer block w-full rounded-md border border-gray-300 focus:border-blue-300 focus:outline-none focus:ring-1 focus:ring-blue-300 py-1 px-2" />
            @error('email')
                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @enderror
        </div>
        <button class="mb-1.5 block w-full text-center text-white bg-blue-600 hover:bg-blue-700 px-2 py-1.5 rounded-md mt-7">Xác nhận</button>
    </form>
    <div class="text-center">
        <span class="text-[13px] text-gray-400 font-semibold">Đã có tài khoản?</span>
        <a href="{{ route('login') }}" class="text-[13px] font-semibold text-blue-500">Đăng nhập ngay</a>
    </div>
@stop
