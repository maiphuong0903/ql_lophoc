@extends('layouts.class-info')

@section('title', 'Members')

@section('content')
    <div class="border border-1 px-5 py-5 bg-white font-medium fixed top-16 w-full overflow-y-auto z-10">
        <h1>Bài kiểm tra</h1>
    </div>
    <div class="mt-20 mx-5">
        {{-- search --}}
        <div class="mt-5 mb-5 grid grid-cols-7 gap-3 items-center mx-5">
            <div class="col-span-4 relative flex justify-between items-center">
                <input type="text" class="border border-gray-300 rounded-md focus:border-blue-50 focus:outline-none w-full cursor-pointer" placeholder="Tìm kiếm...">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500 absolute right-0 mr-2 cursor-pointer">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>         
            </div>    
           
            <div class="col-span-2">       
                <button id="sort-dropdown" data-dropdown-toggle="dropdown" class="border border-gray-300 focus:border-blue-500 bg-white rounded-md text-md px-3 py-2 text-center inline-flex items-center w-full justify-between" type="button">Sắp xếp 
                    <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-80">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">A-Z</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Z-A</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Mới nhất</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Cũ nhất</a>
                    </li>
                    </ul>
                </div>        
            </div>
        
            <div class="col-span-1 flex items-center gap-2 bg-blue-500 py-2 px-2 rounded-md text-white justify-center">         
                <button id="openExamForm">Tạo bài kiểm tra</button>
                @include('users.exams.dialog-create')
            </div>
        </div>

        {{-- Danh sách học sinh đã làm --}}
        <div class="hover:bg-gray-100 py-3 px-5">
            <h1 class="text-gray-950 font-medium">Tiêu đề bài kiểm tra</h1>
            <div class="flex flex-1 justify-between items-center px-2cursor-pointer ">
                <h1 class="text-gray-950 text-[15px]">Tên file bài tập.jpg</h1>          
                <div class="flex gap-5 items-center">
                    <p class="text-[14px] font-medium">0/1 Đã làm</p>
                    <div class="relative">
                        <button id="" class="flex items-center menu-file-toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                            </svg>                                  
                        </button>
                        <div id="" class="menu-file hidden absolute right-0 w-48 bg-white rounded-lg shadow-2xl z-10">
                            <div class="flex flex-1 items-center gap-2 px-4 py-2 hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>                                                                 
                                <a href="#" class="block text-md">Xem thông tin</a>
                            </div>
                            <div class="flex flex-1 items-center gap-2 px-4 py-2 hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9 13.5 3 3m0 0 3-3m-3 3v-6m1.06-4.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                                </svg>                                                              
                                <a href="#" class="block text-md">Tải về</a>
                            </div>
                            <div class="flex flex-1 items-center gap-2 px-4 py-2 hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                </svg>                                                                                          
                                <a href="#" class="block text-md">Xóa bài kiểm tra</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script>
    $(document).ready(function() {
        $('#openExamForm').on('click', function() {
            $('#examFormModal').removeClass('hidden');
            $('#overlay').removeClass('hidden');
        });

        $('#closeExamForm').on('click', function() {
            $('#examFormModal').addClass('hidden');
            $('#overlay').addClass('hidden');
        });

        $('#removeFile').click(function(event) {
            event.preventDefault();
            $('#fileInput').val(''); 
            $('.file-name').text(''); 
            $('.show_file').addClass('hidden'); 
        });

        $('.menu-file-toggle').click(function() {
            $('.menu-file').toggleClass('hidden');
        });
    });

</script>
