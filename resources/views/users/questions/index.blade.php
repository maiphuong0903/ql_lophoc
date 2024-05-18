@extends('layouts.class-info')

@section('title', 'Members')

@section('content')
    <div class="border border-1 px-5 py-5 bg-white font-medium fixed top-16 w-full overflow-y-auto z-10">
        <h1>Bài tập</h1>
    </div>
    <div class="mt-16 grid grid-cols-5">   
       @include('users.topics.index')
        <div class="col-span-4">
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
                    
                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-72">
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
                    <button id="openQuestionForm">Tạo câu hỏi</button>
                    @include('users.questions.create')
                </div>
            </div>
            <div class="bg-gray-100 py-3 px-5 mb-3 flex gap-3 items-center justify-between">
               <div class="flex gap-3 items-center">
                    <input type="checkbox">
                    <p>Chọn tất cả</p>
               </div>
               <button type="submit" class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-md text-md px-7 py-2 text-center">Tạo bài kiểm tra</button>
            </div>
            {{-- danh sách câu hỏi --}}
            <div class="hover:bg-gray-100 py-3 px-5">
                <div class="flex flex-1 justify-between items-center px-2cursor-pointer ">
                    <div class="flex gap-2 items-center">
                        <input type="checkbox">
                        <h1 class="text-gray-950 text-[15px] font-medium">Nội dung câu hỏi</h1>  
                    </div>        
                    <div class="flex gap-5 items-center">
                        <div class="relative">
                            <button id="" class="flex items-center menu-file-toggle">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                </svg>                                  
                            </button>
                            <div id="" class="menu-file hidden absolute right-0 w-48 bg-white rounded-lg shadow-2xl z-10">
                                <div class="flex flex-1 items-center gap-2 px-4 py-2 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>                                                                                                   
                                    <a href="#" class="block text-md">Chỉnh sửa câu hỏi</a>
                                </div>
                                <div class="flex flex-1 items-center gap-2 px-4 py-2 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                    </svg>                                                                                          
                                    <a href="#" class="block text-md">Xóa câu hỏi</a>
                                </div>
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
        $('#openQuestionForm').on('click', function() {
            $('#questionFormModal').removeClass('hidden');
            $('#overlay').removeClass('hidden');
        });

        $('#closeQuestionForm').on('click', function() {
            $('#questionFormModal').addClass('hidden');
            $('#overlay').addClass('hidden');
        });

        $('.menu-file-toggle').click(function() {
            $('.menu-file').toggleClass('hidden');
        });
    });

</script>
