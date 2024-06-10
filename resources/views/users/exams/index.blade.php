@extends('layouts.class-info')

@section('title', 'WindClassRoom')

@section('content')
    @include('partial.toast-message')
    <div class="border border-1 px-5 py-5 bg-white font-medium">
        <h1>Bài kiểm tra</h1>
    </div>
    <div class="mx-5">
        {{-- search --}}
        <div class="mt-5 mb-5 grid grid-cols-7 gap-3 mx-5">
            <div class="{{ auth()->user()->role == 2 ? 'col-span-4' : 'col-span-5' }}">
                <form action="{{ route('class.exams', $classRoom->id) }}" method="GET" class="w-full">
                    <div class="relative flex justify-between items-center">
                        <input type="text" name="search" class="border border-gray-300 rounded-md focus:border-blue-50 focus:outline-none w-full cursor-pointer" placeholder="Tìm kiếm tên bài kiểm tra...">
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
                
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-80">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="{{ route('class.exams', ['id' => $classRoom->id, 'sort_by' => 'asc']) }}" class="block px-4 py-2 hover:bg-gray-100">A-Z</a>
                    </li>
                    <li>
                        <a href="{{ route('class.exams', ['id' => $classRoom->id, 'sort_by' => 'desc']) }}" class="block px-4 py-2 hover:bg-gray-100">Z-A</a>
                    </li>
                    <li>
                        <a href="{{ route('class.exams', ['id' => $classRoom->id, 'sort_by' => 'newest']) }}" class="block px-4 py-2 hover:bg-gray-100">Mới nhất</a>
                    </li>
                    <li>
                        <a href="{{ route('class.exams', ['id' => $classRoom->id, 'sort_by' => 'oldest']) }}" class="block px-4 py-2 hover:bg-gray-100">Cũ nhất</a>
                    </li>
                    </ul>
                </div>        
            </div>
        
            @if (auth()->user()->role == 2)
                <div class="col-span-1">
                    <div class="flex items-center gap-2 bg-blue-500 py-2 px-2 rounded-md text-white justify-center">
                        <a href="{{ route('class.exams.create', $classRoom->id) }}">Tạo bài kiểm tra</a>
                    </div>
                </div>
            @endif
        </div>

        {{-- Danh sách học sinh đã làm --}}
        <div class="overflow-x-auto min-h-[calc(100vh-220px)] relative mx-5">
           <table class="w-full text-sm text-left border">
               <thead class="text-xs uppercase bg-gray-100">
                   <tr>
                       <th scope="col" class="px-6 py-5">#</th>
                       <th scope="col" class="px-6 py-5">Bài kiểm tra</th>
                       <th scope="col" class="px-6 py-5">Thời gian làm bài</th>
                       <th scope="col" class="px-6 py-5">Ngày hết hạn</th>
                       @if (auth()->user()->role == 2)                 
                            <th scope="col" class="px-6 py-5">Bài đã nộp</th>
                            @else
                            <th scope="col" class="px-6 py-5 w-[150px]">Điểm</th>
                        @endif
                        <th scope="col" class="px-6 py-5 w-[150px]">Thao tác</th>
                   </tr>
               </thead>
               <tbody>
                   @forelse ($exams as $key => $exam)                    
                       <tr class="odd:bg-white even:bg-gray-50 border-b">
                            <td class="px-6 py-4">{{ ($exams->currentPage() - 1) * $exams->perPage() + $key+1 }}</td>
                            <td class="px-6 py-4">
                                @if (auth()->user()->role == 2)                  
                                    <a href="{{ route('class.exams.detailExam', ['id' => $classRoom->id, 'examId' => $exam->id]) }}" class="text-blue-600">{{ $exam->title }}</a>
                                @else
                                    <h1>{{ $exam->title }}</h1>                                   
                                @endif
                            </td>
                            <td class="px-10 py-4">{{ $exam->time }} phút</td>
                            <td class="px-6 py-4">
                                <span class="{{ strtotime($exam->expiration_date) < strtotime('today') ? 'text-red-500' : '' }}">
                                    {{ strtotime($exam->expiration_date) < strtotime('today') ? 'Đã hết hạn' : date('d/m/Y', strtotime($exam->expiration_date)) }}
                                </span>
                            </td>                                                                               
                            @if (auth()->user()->role == 2)    
                                <td class="px-10 py-4">{{ $submittedCounts[$exam->id] ?? 0 }} / {{ $totalStudents }}</td>
                                <td class="px-6 py-4 cursor-pointer">
                                    <div class="flex gap-2 items-center justify-end">
                                        @if (!$submittedCounts[$exam->id])     
                                        <a href="{{ route('class.exams.edit', ['id' => $classRoom->id, 'examId' => $exam->id]) }}">                    
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg> 
                                        </a>                                          
                                        @endif
                                        <a href="{{ route('class.exams.show', [ 'id' => $classRoom->id, 'examId' => $exam->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                                            </svg>                                                                
                                        </a>
                                        <button type="button" class="deleteExam block text-md" data-class-room-id="{{ $classRoom->id }}" data-exam-id="{{ $exam->id }}" data-modal-target="deleteModal" data-modal-toggle="deleteModal">                                                                                        
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>  
                                    </div>                                                        
                                    @include('partial.modal-delete')
                                </td>
                            @else
                                <td class="px-6 py-4">{{  $exam->userAnswerExams->first()->pivot->score ?? 'Chưa làm' }}</td>
                                <td class="px-6 py-4 cursor-pointer">
                                    @if (!$isSubmitted[$exam->id] && $exam->expiration_date > now())
                                        <a href="{{ route('class.exams.detailExam', ['id' => $classRoom->id, 'examId' => $exam->id]) }}" class="border px-4 py-1.5 rounded-md bg-blue-500 text-white hover:bg-blue-700">
                                            Làm bài
                                        </a>
                                    @endif
                                </td>
                            @endif 
                       </tr>
                   @empty
                       <tr>
                           <td colspan="6" class="px-6 py-4 text-center">Không bài kiểm tra nào</td>
                       </tr>
                   @endforelse
               </tbody>
           </table>
           
           <div class="mt-20">
               {{ $exams->links('pagination.paginate') }}
           </div>
       </div>
    </div>
@stop

<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script>
    $(document).ready(function() {
         // Mở form xóa học sinh khỏi lớp
         $(document).on('click', '.deleteExam', function(){
            $('#deleteModal').removeClass('hidden');     
            let classRoomId = $(this).data('class-room-id');  
            let examId = $(this).data('exam-id');     
            let formAction = "{{ route('class.exams.delete', [':id', ':examId']) }}";       
            formAction = formAction.replace(':id', classRoomId);
            formAction = formAction.replace(':examId', examId);      
            $('#deleteForm').attr('action', formAction);
        });

        // Đóng form xóa học sinh khỏi lớp
        $('[data-modal-toggle="deleteModal"]').click(function(){
            $('#deleteModal').addClass('hidden');
        });
    });

</script>
