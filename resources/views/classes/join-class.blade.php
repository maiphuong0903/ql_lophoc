@extends('layouts.master')

@section('title', 'WindClassRoom')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-blue-100">
        <div class="bg-white shadow-md rounded-lg px-8 py-16 w-1/3">
            <h2 class="text-gray-700 font-medium text-2xl mb-4 text-center">Tham gia lớp bằng mã lớp</h2>
            <p class="text-gray-500 text-center mb-14">Mã lớp gồm 5 ký tự, được giáo viên lớp đó cung cấp</p>

            <form action="{{ route('class.joinClassRoom.store') }}" method="POST" class="flex flex-col items-center">
                @csrf
                <input type="text" name="code" class="rounded-md border border-gray-300 px-2 py-3 mb-4 text-sm w-40 text-center">
                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md cursor-pointer w-full">Tham gia lớp</button>
            </form>

            <div class="mt-4 text-gray-800 text-center">
                <a href="{{ route('class') }}">Quay lại danh sách lớp</a>
            </div>
        </div>
    </div>
@stop
