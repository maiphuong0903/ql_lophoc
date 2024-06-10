@extends('layouts.class-info')

@section('title', 'WindClassRoom')

@section('content')
    <div class="border border-1 px-5 py-5 bg-white font-medium fixed top-16 w-full overflow-y-auto z-10">
        <h1>Bảng điểm</h1>
    </div>
    <div class="mt-20 mx-5">
        {{-- search --}}
        <div class="my-5 grid grid-cols-11 gap-6 items-center">
            <div class="col-span-8 relative flex justify-between bg-white items-center">
                <form action="{{ route('class.score-table', $classRoom->id) }}" method="GET" class="w-full">
                    <div class="relative flex justify-between items-center">
                        <input type="text" name="search" class="border border-gray-300 rounded-md focus:border-blue-50 focus:outline-none w-full cursor-pointer" placeholder="Tìm kiếm theo họ và tên...">
                        <button type="submit" class="text-gray-500 absolute right-0 mr-2 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>          
                    </div>
                </form>         
            </div>    
           
            <div class="col-span-2">       
                <button id="sort-dropdown" data-dropdown-toggle="dropdown" class="border border-gray-300 focus:border-blue-500 bg-white rounded-md text-md px-3 py-2 text-center inline-flex items-center w-full justify-between" type="button">Sắp xếp theo tên
                    <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="{{ route('class.score-table', ['id' => $classRoom->id, 'sort_by' => 'asc']) }}" class="block px-4 py-2 hover:bg-gray-100">A-Z</a>
                        </li>
                        <li>
                            <a href="{{ route('class.score-table', ['id' => $classRoom->id, 'sort_by' => 'desc']) }}" class="block px-4 py-2 hover:bg-gray-100">Z-A</a>
                        </li>
                    </ul>
                </div>        
            </div>
        
            <a href="{{ route('score-table.printExcel', $classRoom->id) }}" class="col-span-1 border border-gray-300 flex justify-center py-2 px-4 rounded-lg bg-white cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-black text-center">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                </svg>
            </a>
        </div>

        {{-- Danh sách học sinh đã làm --}}
        <div class="overflow-x-auto min-h-[calc(100vh-220px)] relative">
            <table class="w-full text-sm text-left border">
                <thead class="text-xs uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-5">Số thứ tự</th>
                        <th scope="col" class="px-6 py-5">Họ và tên</th>
                        @foreach ($homeworks as $homework)
                            <th scope="col" class="px-6 py-5">{{ $homework->title }}</th>
                        @endforeach
                        @foreach ($exams as $exam)
                            <th scope="col" class="px-6 py-5">{{ $exam->title }}</th>
                        @endforeach
                        <th scope="col" class="px-6 py-5 w-[180px]">Điểm trung bình</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $key => $student)
                        <tr class="odd:bg-white even:bg-gray-50 border-b hover:bg-blue-100">
                            <td class="px-12 py-4">{{ ($students->currentPage() - 1) * $students->perPage() + $key+1 }}</td>
                            <td class="px-6 py-4">{{ $student->name }}</td>
                            @foreach ($homeworks as $homework)
                                <td class="px-6 py-4">{{ $student->answerHomeworks->where('id', $homework->id)->first()->pivot->score ?? 'Chờ chấm' }}</td>
                            @endforeach
                            @foreach ($exams as $exam)
                                <td class="px-6 py-4">{{ $student->answerExams->where('id', $exam->id)->first()->pivot->score ?? 'Chờ chấm' }}</td>
                            @endforeach
                            <td class="px-16 py-4">{{ $averageScore }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ 2 + count($homeworks) + count($exams) }}" class="text-center py-4">Chưa có điểm học sinh nào</td>
                        </tr>
                    @endforelse   
                </tbody>
            </table>
            <div class="mt-20">
                {{ $students->links('pagination.paginate') }}
            </div>
        </div>
    </div>
@stop
