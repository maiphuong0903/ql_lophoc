<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', '@Master Layout'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .active {
            background-color: #ebf8ff; 
            color: #2b6cb0; 
            font-weight: bold;
        }
    </style>
</head>
<div class="hidden w-60 overflow-y-auto bg-white md:block flex-shrink-0 pt-1.5 border mt-2 relative min-h-[calc(100vh-20px)]" id="menu-mobile">
    <div class="px-4 py-3">
        <h1 class="font-medium text-[18px] text-blue-500">{{ $classRoom->name }}</h1>
        <p class="text-[15px] mt-1">Mã lớp: {{ $classRoom->code }}</p>
    </div>
    <hr class="mx-4">
    <div class="relative">
        <p class="px-4 pt-2 text-sm">Danh mục</p>
        <ul id="menu">
            <li class="px-4 py-1 {{ Request::is('class/*/newsfeed') ? 'active' : ''}}">
                <a href="{{ route('class.newsfeed', $classRoom->id) }}" class="inline-flex items-center w-full text-md text-gray-700 font-semibold transition-colors duration-150 px-2 py-2 hover:bg-gray-100 hover:rounded-xl ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                    </svg>                                                                                    
                    <span class="ml-4">Bảng tin</span>
                </a>
            </li>
            <li class="px-4 py-1 {{ Request::is('class/*/student') ? 'active' : ''}}">
                <a href="{{ route('class.student', $classRoom->id) }}" class="inline-flex items-center w-full text-md text-gray-700 font-semibold transition-colors duration-150 px-2 py-2 hover:bg-gray-100 hover:rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>                                                                
                    <span class="ml-4">Thành viên</span>
                </a>
            </li>
            @if(auth()->user()->role == 2)
                <li class="px-4 py-1 {{ Request::is('class/*/teacher') ? 'active' : ''}}">
                    <a href="{{ route('class.class-role', $classRoom->id) }}" class="inline-flex items-center w-full text-md text-gray-700 font-semibold transition-colors duration-150 px-2 py-2 hover:bg-gray-100 hover:rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>                                                                
                        <span class="ml-4">Vai trò lớp</span>
                    </a>
                </li>
            @endif
            <li class="px-4 py-1 {{ Request::is('class/*/document') ? 'active' : ''}}">
                <a href="{{ route('class.document', $classRoom->id) }}" class="inline-flex items-center w-full text-md text-gray-700 font-semibold transition-colors duration-150 px-2 py-2 hover:bg-gray-100 hover:rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13.5H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                    </svg>                                                                                      
                    <span class="ml-4">Tài liệu</span>
                </a>
            </li>
            <li class="px-4 py-1 {{ Request::is('class/*/homework') ? 'active' : ''}}">
                <a href="{{ route('class.homework', $classRoom->id) }}" class="inline-flex items-center w-full text-md text-gray-700 font-semibold transition-colors duration-150 px-2 py-2 hover:bg-gray-100 hover:rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                    </svg>                                                               
                    <span class="ml-4">Bài tập</span>
                </a>
            </li>
            @if(auth()->user()->role == 2)
                <li class="px-4 py-1 {{ Request::is('class/*/questions') ? 'active' : ''}}">
                    <a href="{{ route('class.questions', $classRoom->id) }}" class="inline-flex items-center w-full text-md text-gray-700 font-semibold transition-colors duration-150 px-2 py-2 hover:bg-gray-100 hover:rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                            <circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 1.65-1.35 3-3 3s-3-1.35-3-3"></path><line x1="12" y1="17" x2="12" y2="17"></line>
                        </svg>                                                                                    
                        <span class="ml-4">Bộ câu hỏi</span>
                    </a>
                </li>
            @endif
            <li class="px-4 py-1 {{ Request::is('class/*/exams') ? 'active' : ''}}">
                <a href="{{ route('class.exams', $classRoom->id) }}" class="inline-flex items-center w-full text-md text-gray-700 font-semibold transition-colors duration-150 px-2 py-2 hover:bg-gray-100 hover:rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                      </svg>                                                               
                    <span class="ml-4">Bài kiểm tra</span>
                </a>
            </li>
            @if(auth()->user()->role == 2)
                <li class="px-4 py-1 {{ Request::is('class/*/score-table') ? 'active' : ''}}">
                    <a href="{{ route('class.score-table', $classRoom->id) }}" class="inline-flex items-center w-full text-md text-gray-700 font-semibold transition-colors duration-150 px-2 py-2 hover:bg-gray-100 hover:rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                        </svg>                                                               
                        <span class="ml-4">Bảng điểm</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
    <div class="absolute bottom-14 w-full">
        <hr>
        <div class="px-4 py-3">
            @if(auth()->user()->role == 2 && auth()->user()->id == $classRoom->created_by)
                <a href="{{ route('class.edit', $classRoom->id) }}" class="inline-flex items-center w-full text-md text-gray-700 font-semibold transition-colors duration-150 px-2 py-2 hover:bg-gray-100 hover:rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>                                                        
                    <span class="ml-4">Cài đặt lớp học</span>
                </a>
            @else
                <button type="button" data-class-room-id="{{ $classRoom->id }}" data-student-id="{{ auth()->user()->id }}" class="leaveClass inline-flex items-center w-full text-md text-gray-700 font-bold transition-colors duration-150 px-2 py-2 hover:bg-gray-100 hover:rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>                                                       
                    <span class="ml-4">Rời khỏi lớp</span>
                </button>
               
            @endif
        </div>
    </div>
</div> 
@include('classes.leave-class')
<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script>
    $(document).ready(function() {
        // Mở form rời khỏi lớp
        $(document).on('click', '.leaveClass', function(){
            $('#leaveClassModal').removeClass('hidden');
            let classRoomId = $(this).data('class-room-id');     
            let studentId = $(this).data('student-id');

            let formAction = "{{ route('class.student.leaveClass', [':classId', ':studentId']) }}";     
            formAction = formAction.replace(':classId', classRoomId);
            formAction = formAction.replace(':studentId', studentId);    
            $('#leaveForm').attr('action', formAction);
        });

        // Đóng form rời khỏi lớp
        $('[data-modal-toggle="deleteModal"]').click(function(){
            $('#leaveClassModal').addClass('hidden');
        });
    });
</script>