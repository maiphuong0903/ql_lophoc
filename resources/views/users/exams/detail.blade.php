@extends('layouts.master')

@section('title', 'Members')

@section('content')
    <header class="bg-white border-b py-5 px-5 w-full fixed top-0">
        <nav>
            <ul class="flex flex-1 gap-3 items-center">
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </li>
                <li>Tên bài tập</li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                    </svg>
                </li>
                <li>Tên học sinh</li>
            </ul>
        </nav>
    </header>

    <div class="grid grid-cols-3">
        <div class="col-span-2 px-10 py-6 mt-16">
            <h1 class="text-3xl font-bold">Nội dung file</h1>
        </div>
        <div class="border-l w-1/4 h-full p-6 fixed top-16 right-0 overflow-y-scroll">
            <button class="text-white bg-blue-600 font-medium rounded-lg text-md px-5 py-2 text-center w-full">Kết quả</button>
            <div>
                <div class="my-6 border border-gray-300 rounded-xl">
                    <div class="bg-blue-700 rounded-t-xl text-center">
                        <p class="text-white text-2xl font-bold py-6">10/10</p>
                    </div>
                    <div class="px-3 py-4 text-sm ">
                        <div class="flex justify-between mb-2">
                            <p>Thời gian</p>
                            <span class="font-medium">5 giờ 32 phút</span>
                        </div>
                        <div class="flex justify-between mb-5">
                            <p>Nộp lúc</p>
                            <span class="font-medium">11 tháng 5 lúc 19:45</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <div class="flex gap-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-2.5 h-2.5 text-green-500">
                                    <path fill="currentColor"
                                        d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm3.354 8.354L11 15.707l-2.354-2.353a.5.5 0 1 0-.707.707l3 3a.5.5 0 0 0 .707 0l5-5a.5.5 0 1 0-.707-.707z" />
                                </svg>
                                <p>Số câu đúng</p>
                            </div>
                            <span class="font-medium">6/6</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <div class="flex gap-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-2.5 h-2.5 text-red-500">
                                    <path fill="currentColor"
                                        d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm3.354 8.354L11 15.707l-2.354-2.353a.5.5 0 1 0-.707.707l3 3a.5.5 0 0 0 .707 0l5-5a.5.5 0 1 0-.707-.707z" />
                                </svg>
                                <p>Số câu sai</p>
                            </div>
                            <span class="font-medium">0/6</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <div class="flex gap-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-2.5 h-2.5 text-gray-400">
                                    <path fill="currentColor"
                                        d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm3.354 8.354L11 15.707l-2.354-2.353a.5.5 0 1 0-.707.707l3 3a.5.5 0 0 0 .707 0l5-5a.5.5 0 1 0-.707-.707z" />
                                </svg>
                                <p>Chưa làm</p>
                            </div>
                            <span class="font-medium">0/6</span>
                        </div>
                    </div>
                </div>
    
                <div>
                    <h1 class="font-medium text-gray-900 mb-5">Phiếu làm bài</h1>
                    <div class="container mx-auto">
                        <table class="table-auto w-full text-sm text-center">
                            <thead>
                                <tr class="text-center bg-gray-200">
                                    <th class="py-2 px-3"></th>
                                    <th class="py-2 px-3 font-medium">Câu</th>
                                    <th class="py-2 px-3 font-medium">Chọn</th>
                                    <th class="py-2 px-3 font-medium">Đáp án đúng</th>
                                    <th class="py-2 px-3 font-medium">Điểm</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-2 px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-2.5 h-2.5 text-green-500">
                                            <path fill="currentColor"
                                                d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm3.354 8.354L11 15.707l-2.354-2.353a.5.5 0 1 0-.707.707l3 3a.5.5 0 0 0 .707 0l5-5a.5.5 0 1 0-.707-.707z" />
                                        </svg>
                                    </td>
                                    <td class="py-2 px-3">1</td>
                                    <td class="py-2 px-3">A</td>
                                    <td class="py-2 px-3">A</td>
                                    <td class="py-2 px-3">(1.67)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
