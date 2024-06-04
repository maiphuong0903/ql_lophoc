@extends('layouts.admin')

@section('title', 'WindClassRoom')

@section('content')
    @include('partial.toast-message')
    {{-- search --}}
    <div class="mt-5 mb-3 grid grid-cols-6 gap-6 mx-10">   
        <div class="col-span-4 flex items-center h-full">
            <form action="{{ route('admin.teacher') }}" method="GET" class="w-full">
                <div class="relative flex justify-between items-center">
                    <input type="text" name="search" class="border border-gray-300 rounded-md focus:border-blue-50 focus:outline-none w-full cursor-pointer" placeholder="Tìm kiếm theo tên giáo viên...">
                    <button type="submit" class="text-gray-500 absolute right-0 mr-2 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg> 
                    </button>        
                </div>
            </form>
        </div>    
        <div class="col-span-1">       
            <button id="sort-dropdown" data-dropdown-toggle="dropdown" class="border border-gray-300 focus:border-blue-500 bg-white rounded-md text-md px-3 py-2 text-center inline-flex items-center w-full justify-between" type="button">Sắp xếp 
                <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>
            
            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="{{ route('admin.teacher', ['sort_by' => 'asc']) }}" class="block px-4 py-2 hover:bg-gray-100">A-Z</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.teacher', ['sort_by' => 'desc']) }}" class="block px-4 py-2 hover:bg-gray-100">Z-A</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.teacher', ['sort_by' => 'newest']) }}" class="block px-4 py-2 hover:bg-gray-100">Mới nhất</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.teacher', ['sort_by' => 'oldest']) }}" class="block px-4 py-2 hover:bg-gray-100">Cũ nhất</a>
                    </li>
                </ul>
            </div>        
        </div>
        <div class="col-span-1">
            <div class="flex items-center gap-2 bg-blue-500 py-2 rounded-md text-white justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>          
                <a href="{{ route('admin.teacher.create') }}">Thêm giáo viên</a>
            </div>
        </div>
    </div>

    {{-- danh sách giáo viên --}}
    <div class="flex flex-col bg-white shadow-md mx-10 mt-3 min-h-[calc(100vh-190px)]">
        <h1 class="mx-auto pt-5 text-[19px] font-medium text-blue-500">DANH SÁCH GIÁO VIÊN</h1>
        <div class="overflow-x-auto px-10 py-5">
            <div class="inline-block min-w-full">
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light text-surface border relative">
                        <thead
                            class="border-b border-neutral-200 bg-gray-200 font-medium">
                            <tr>
                                <th scope="col" class="px-6 py-4">STT</th>
                                <th scope="col" class="px-6 py-4">Họ và tên</th>
                                <th scope="col" class="px-6 py-4">Email</th>
                                <th scope="col" class="px-6 py-4">Giới tính</th>
                                <th scope="col" class="px-6 py-4">Ngày sinh</th>
                                <th scope="col" class="px-6 py-4">Số điện thoại</th>
                                <th scope="col" class="px-6 py-4">Ngày tạo</th>
                                <th scope="col" class="px-6 py-4 w-[120px]">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($teachers as $key => $teacher)
                                <tr class="border-b border-neutral-200 bg-black/[0.02] odd:bg-white even:bg-gray-50">
                                    <td class="whitespace-nowrap px-8 py-4 font-medium">{{ ($teachers->currentPage() - 1) * $teachers->perPage() + $key+1 }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <a href="{{ route('admin.teacher.edit', $teacher->id) }}" class="text-blue-600">{{ $teacher->name }}</a>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $teacher->email }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ isset($teacher->gender) ? ($teacher->gender == 1 ? 'Nữ' : 'Nam') : '' }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $teacher->birthday ? date('d-m-Y', strtotime($teacher->birthday)) : '' }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $teacher->phone ?? '' }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ date('d-m-Y', strtotime($teacher->created_at)) }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex gap-3">
                                            <a href="{{ route('admin.teacher.edit', $teacher->id) }}"> 
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.teacher.delete', $teacher->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg> 
                                                </button>
                                            </form>                                                                                                                         
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center p-5">Không có giáo viên nào</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="absolute bottom-6 right-16 w-full">
                        {{ $teachers->links('pagination.paginate') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
