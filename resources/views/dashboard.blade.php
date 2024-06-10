@extends('layouts.admin')

@section('title', 'WindClassRoom')

@section('content')
    <div class="mx-10 py-7">
        {{-- thống kê --}}
        <div class="grid gap-6 mb-8 grid-cols-3">

            <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>                                            
                </div>
                <div>
                    <p class="mb-2 text-md font-medium text-gray-600">
                        Giáo viên
                    </p>
                    <p class="text-lg font-semibold text-gray-700">
                        {{ $teachers }}
                    </p>
                </div>
            </div>
  
            <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>                                            
                </div>
                <div>
                    <p class="mb-2 text-md font-medium text-gray-600">
                        Lớp học
                    </p>
                    <p class="text-lg font-semibold text-gray-700">
                        {{ $classrooms }}
                    </p>
                </div>
            </div>

            <div class="flex items-center p-4 bg-white rounded-lg shadow-md">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>                                                  
                </div>
                <div>
                    <p class="mb-2 text-md font-medium text-gray-600">
                        Học sinh
                    </p>
                    <p class="text-lg font-semibold text-gray-700">
                        {{ $students }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
