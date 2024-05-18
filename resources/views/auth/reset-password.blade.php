@extends('layouts.guest')

@section('title', 'Đổi Mật Khẩu')

@section('content')
    <h1 class="text-xl font-semibold text-center">Đổi mật khẩu</h1>
    <form class="mt-4" method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="mb-5">
            <label class="mb-2 block text-md font-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email', $request->email) }}" class="cursor-pointer block w-full rounded-md border border-gray-300 py-1 px-2 bg-gray-50" disabled/>
        </div>
        <div class="mb-5">
            <label class="mb-2 block text-md font-semibold">Mật khẩu mới</label>
            <input type="password" name="password" placeholder="Nhập mật khẩu mới" class="cursor-pointer block w-full rounded-md border border-gray-300 focus:border-blue-300 focus:outline-none focus:ring-1 focus:ring-blue-300 py-1 px-2" />
            @error('password')
                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-5">
            <label class="mb-2 block text-md font-semibold">Nhập lại mật Khẩu</label>
            <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu mới" class="cursor-pointer block w-full rounded-md border border-gray-300 focus:border-blue-300 focus:outline-none focus:ring-1 focus:ring-blue-300 py-1 px-2" />
            @error('current_password')
                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @enderror
        </div>
        <button class="mb-1.5 block w-full text-center text-white bg-blue-600 hover:bg-blue-700 px-2 py-1.5 rounded-md mt-7">Đổi mật khẩu</button>
    </form>
@stop
