@extends('layouts.admin')

@section('title', 'WindClassRoom')

@section('content')
    @include('partial.toast-message')
    {{-- search --}}
    <div class="mt-5 mb-3 grid grid-cols-6 gap-6 mx-10">   
        <div class="col-span-4 flex items-center h-full">
            <form action="{{ route('admin.class') }}" method="GET" class="w-full">
                <div class="relative flex justify-between items-center">
                    <input type="text" name="search" class="border border-gray-300 rounded-md focus:border-blue-50 focus:outline-none w-full cursor-pointer" placeholder="Tìm kiếm theo tên lớp học...">
                    <button type="submit" class="text-gray-500 absolute right-0 mr-2 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg> 
                    </button>        
                </div>
            </form>
        </div>    
        <div class="col-span-2">       
            <button id="sort-dropdown" data-dropdown-toggle="dropdown" class="border border-gray-300 focus:border-blue-500 bg-white rounded-md text-md px-3 py-2 text-center inline-flex items-center w-full justify-between" type="button">Sắp xếp 
                <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>
            
            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-96">
                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="{{ route('admin.class', ['sort_by' => 'asc']) }}" class="block px-4 py-2 hover:bg-gray-100">A-Z</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.class', ['sort_by' => 'desc']) }}" class="block px-4 py-2 hover:bg-gray-100">Z-A</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.class', ['sort_by' => 'newest']) }}" class="block px-4 py-2 hover:bg-gray-100">Mới nhất</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.class', ['sort_by' => 'oldest']) }}" class="block px-4 py-2 hover:bg-gray-100">Cũ nhất</a>
                    </li>
                </ul>
            </div>        
        </div>
    </div>

    {{-- danh sách giáo viên --}}
    <div class="flex flex-col bg-white shadow-md mx-10 mt-3 min-h-[calc(100vh-190px)]">
        <h1 class="mx-auto pt-5 text-[19px] font-medium text-blue-500">DANH SÁCH LỚP HỌC</h1>
        <div class="overflow-x-auto px-10 py-5">
            <div class="inline-block min-w-full">
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light text-surface border relative">
                        <thead
                            class="border-b border-neutral-200 bg-gray-200 font-medium">
                            <tr>
                                <th scope="col" class="px-6 py-4">STT</th>
                                <th scope="col" class="px-6 py-4">Mã lớp</th>
                                <th scope="col" class="px-6 py-4">Tên lớp</th>
                                <th scope="col" class="px-6 py-4">Ảnh bìa</th>
                                <th scope="col" class="px-6 py-4">Chủ sở hữu lớp</th>
                                <th scope="col" class="px-6 py-4">Ngày tạo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($classRooms as $key => $classRoom)
                                <tr class="border-b border-neutral-200 bg-black/[0.02] odd:bg-white even:bg-gray-50">
                                    <td class="whitespace-nowrap px-8 py-4 font-medium">{{ ($classRooms->currentPage() - 1) * $classRooms->perPage() + $key+1 }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <a href="{{ route('admin.teacher.edit', $classRoom->id) }}" class="text-blue-600">{{ $classRoom->code }}</a>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $classRoom->name }}</td>
                                    <td class="whitespace-nowrap px-1 py-4">
                                        <img src="{{ $classRoom->image ?? asset('images/slide.png') }} " alt="" class="w-[100px] h-[70px] object-scale-down">
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $classRoom->author->name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ date('d-m-Y', strtotime($classRoom->created_at)) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center p-5">Không có lớp học nào</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="absolute bottom-6 right-16 w-full">
                        {{ $classRooms->links('pagination.paginate') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
