@extends('layouts.class-info')

@section('title', 'WindClassRoom')

@section('content')
    <div class="border border-1 px-5 py-5 bg-white font-medium fixed top-16 w-full overflow-y-auto z-10">
        <h1>Bài tập</h1>
    </div>
    <div class="mt-20 mx-5">
        <div class="mt-5 mb-5 flex gap-3 items-center">
            <div class="relative flex justify-between items-center w-1/2">
                <form action="{{ route('class.homework.info', ['id' => $classRoom->id, 'homeworkId' => $homework->id]) }}" method="GET" class="w-full">
                    <div class="relative flex justify-between items-center">
                        <input type="text" name="search" class="border border-gray-300 rounded-md focus:border-blue-50 focus:outline-none w-full cursor-pointer" placeholder="Tìm kiếm tên học sinh...">
                        <button type="submit" class="text-gray-500 absolute right-0 mr-2 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>          
                    </div>
                </form>          
            </div> 

            <div class="flex items-center gap-2 bg-blue-500 py-2 px-4 text-white rounded-md justify-center">         
                <a href="{{ route('class.homework.info', ['id' => $classRoom->id, 'homeworkId' => $homework->id, 'status-assignment' => 'all']) }}">Tất cả</a>
            </div>

            <div class="flex items-center gap-2 bg-gray-200 py-2 px-4 rounded-md justify-center">         
                <a href="{{ route('class.homework.info', ['id' => $classRoom->id, 'homeworkId' => $homework->id, 'status-assignment' => 'notScore']) }}">Đã chấm</a>
            </div>

            <div class="flex items-center gap-2 bg-gray-200 py-2 px-4 rounded-md justify-center">         
                <a href="{{ route('class.homework.info', ['id' => $classRoom->id, 'homeworkId' => $homework->id, 'status-assignment' => 'markscore']) }}">Chưa chấm</a>
            </div>  
           
            <a href="{{ route('homework.printExcel', ['id' => $classRoom->id, 'homeworkId' => $homework->id]) }}" class="border border-gray-300 flex justify-center py-2 px-4 rounded-lg bg-white cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-black text-center">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                </svg>
            </a>
        </div>

        <div class="overflow-x-auto min-h-[calc(100vh-220px)] relative">
             {{-- Đối với bài tập dạng file --}}
            <table class="w-full text-sm text-left border">
                <thead class="text-xs uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-5">#</th>
                        <th scope="col" class="px-6 py-5">Họ và tên</th>
                        <th scope="col" class="px-6 py-5">Điểm</th>
                        <th scope="col" class="px-6 py-5">Ngày nộp</th>
                        <th scope="col" class="px-6 py-5 w-[150px]">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($assignedUsers as $key => $user)                    
                        <tr class="odd:bg-white even:bg-gray-50 border-b">
                            <td class="px-6 py-4">{{ ($assignedUsers->currentPage() - 1) * $assignedUsers->perPage() + $key+1 }}</td>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->pivot->score ?? 'Chờ chấm'}}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($user->pivot->created_at)->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('class.homework.detailAnswerHomeWork', ['id' => $classRoom->id, 'homeworkId' => $homework->id, 'studentId' => $user->id ]) }}" class="border px-3 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-700">{{ $user->pivot->score ? 'Chi tiết bài' : 'Chấm bài' }}</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center">Không có học sinh nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="mt-20">
                {{ $assignedUsers->links('pagination.paginate') }}
            </div>
        </div>
    </div>
@stop
