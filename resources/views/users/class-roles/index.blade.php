@extends('layouts.class-info')

@section('title', 'Members')

@section('content')
    @include('partial.toast-message')
    <div class="border-y px-5 py-5 bg-white font-medium">
        <h1>Vai trò lớp</h1>
    </div>
    <div class="mt-10 mx-8 mr-80">
        <div class="mt-5 mb-7 grid grid-cols-11 gap-3 ">
            <div class="col-span-8">
                <form action="{{ route('class.class-role', $classRoom->id) }}" method="GET" class="w-full">
                    <div class="relative flex justify-between items-center">
                        <input type="text" name="search" value="{{ session('search.code') }}" class="border border-gray-300 rounded-md focus:border-blue-50 focus:outline-none w-full cursor-pointer" placeholder="Tìm kiếm theo tên giáo viên...">
                        <button type="submit" class="text-gray-500 absolute right-0 mr-2 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg> 
                        </button>          
                    </div>
                </form>
            </div>

            <div class="col-span-1">
                <a href="{{ route('class-role.printExcel', $classRoom->id) }}" class="border border-gray-300 flex justify-center py-2 rounded-lg bg-white cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-black text-center">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                    </svg>
                </a>
            </div>

            <div class="col-span-2">
                <div class="flex items-center gap-2 bg-blue-500 py-2 px-2 rounded-md text-white justify-center">
                    <button id="openAddTeacherForm">Thêm giáo viên</button>
                    @include('users.class-roles.create')
                </div>  
            </div>
        </div>

        <div class="overflow-x-auto bg-white min-h-[calc(100vh-220px)] relative">
            <table class="w-full text-sm text-left border-x">
                <thead class="text-xs uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-5">Số thứ tự</th>
                        <th scope="col" class="px-6 py-5">Họ và tên</th>
                        <th scope="col" class="px-6 py-5">Vai trò</th>
                        <th scope="col" class="px-6 py-5">Tài liệu</th>
                        <th scope="col" class="px-6 py-5">Bài tập</th>
                        <th scope="col" class="px-6 py-5">Bài kiểm tra</th>
                        <th scope="col" class="px-6 py-5 w-[120px]">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $key => $teacher)                      
                        <tr class="odd:bg-white even:bg-gray-50 border-b hover:bg-blue-100">
                            <td class="px-12 py-4">{{ ($teachers->currentPage() - 1) * $teachers->perPage() + $key+1 }}</td>
                            <td class="px-6 py-4">{{ $teacher->name }}</td>
                            <td class="px-6 py-4">  
                                @foreach($teacher->classRooms as $classRoom)
                                    {{ $classRoom->pivot->content_role }}
                                @endforeach
                            </td>
                            <td class="px-6 py-4">0/0</td>
                            <td class="px-6 py-4">0/0</td>
                            <td class="px-6 py-4">0/0</td>
                            <td class="px-10 py-4 cursor-pointer">
                                @if($teacher->id !== $classRoom->created_by)
                                    <button type="button" class="deleteTeacher block text-md" data-class-room-id="{{ $classRoom->id }}" data-teacher-id="{{ $teacher->id }}" data-modal-target="deleteModal" data-modal-toggle="deleteModal">                                                                                        
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>        
                                @endif
                                @include('partial.modal-delete')                     
                            </td>
                        </tr>            
                    @endforeach
                </tbody>
            </table>
            <div class="mt-20">
                {{ $teachers->links('pagination.paginate') }}
            </div>
        </div>
    </div>

    <div class="w-72 border border-1 px-5 py-5 bg-white fixed right-0 top-32 h-full overflow-y-auto">
        <h1 class="text-[15px] font-medium">Lời mời quản trị: 0</h1>
        <p class="text-[14px] text-gray-500 py-5">Không có lời mời nào. Bạn có thể gửi lời mời bằng cách ấn <span class="font-medium text-blue-500"><a href="">Thêm giáo viên</a></span></p>
    </div>
@stop
<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script>
    $(document).ready(function() {
        // Mở form thêm giáo viên
        $('#openAddTeacherForm').on('click', function() {
            $('#addTeacherFormModal').removeClass('hidden');
            $('#overlay').removeClass('hidden');
        });

        // Đóng form thêm giáo viên
        $('#closeAddTeacherForm').on('click', function() {
            $('#addTeacherFormModal').addClass('hidden');
            $('#overlay').addClass('hidden');
        });

        // Mở form xóa giáo viên khỏi lớp
        $(document).on('click', '.deleteTeacher', function(){
            $('#deleteModal').removeClass('hidden');
            let teacherId = $(this).data('teacher-id'); 
            let classRoomId = $(this).data('class-room-id');  
            let formAction = "{{ route('class.class-role.deleteTeacher', [':id', ':teacherId']) }}";     
            formAction = formAction.replace(':id', classRoomId);
            formAction = formAction.replace(':teacherId', teacherId);    
            $('#deleteForm').attr('action', formAction);
        });

        // Đóng form xóa giáo viên khỏi lớp
        $('[data-modal-toggle="deleteModal"]').click(function(){
            $('#deleteModal').addClass('hidden');
        });

    });

</script>
