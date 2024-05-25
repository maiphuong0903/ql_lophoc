@extends('layouts.class-info')

@section('title', 'Members')

@section('content')
    @include('partial.toast-message')
    <div class="border border-1 px-5 py-5 bg-white font-medium">
        <h1>Tài liệu (0)</h1>
    </div>
    <div class="grid grid-cols-5">   
       @include('users.topics.index')
        <div class="col-span-4">
            {{-- search --}}
            <div class="mt-5 mb-5 grid grid-cols-7 gap-3 mx-5">
                <div class="col-span-4">
                    <form action="{{ route('class.document', $classRoom->id) }}" method="GET" class="w-full">
                        <div class="relative flex justify-between items-center">
                            <input type="text" name="search" class="border border-gray-300 rounded-md focus:border-blue-50 focus:outline-none w-full cursor-pointer" placeholder="Tìm kiếm theo tiêu đề...">
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
                            <a href="{{ route('class.document', ['id' => $classRoom->id, 'sort_by' => 'asc']) }}" class="block px-4 py-2 hover:bg-gray-100">A-Z</a>
                        </li>
                        <li>
                            <a href="{{ route('class.document', ['id' => $classRoom->id, 'sort_by' => 'desc']) }}" class="block px-4 py-2 hover:bg-gray-100">Z-A</a>
                        </li>
                        <li>
                            <a href="{{ route('class.document', ['id' => $classRoom->id, 'sort_by' => 'newest']) }}" class="block px-4 py-2 hover:bg-gray-100">Mới nhất</a>
                        </li>
                        <li>
                            <a href="{{ route('class.document', ['id' => $classRoom->id, 'sort_by' => 'oldest']) }}" class="block px-4 py-2 hover:bg-gray-100">Cũ nhất</a>
                        </li>
                        </ul>
                    </div>        
                </div>
            
                <div class="col-span-1">         
                    <div class="flex items-center gap-2 bg-blue-500 py-2 px-2 rounded-md text-white justify-center">
                        <button id="openFileForm">Tạo tài liệu</button>
                        @include('users.files.create')
                    </div>
                </div>
            </div>

            {{-- danh sách tài liệu --}}
            @forelse ($documents as $document)
            <p class="font-semibold mx-5 ">{{ $document->title }}</p>
            <div class="hover:bg-gray-100">
                <div class="flex flex-1 justify-between items-center px-2cursor-pointer py-3 px-5">
                    <a href="{{ route('class.document.show', ['id' => $classRoom->id, 'documentId' => $document->id]) }}" class="text-gray-950 cursor-pointer hover:underline hover:text-blue-500">{{ $document->document_url }}</a>          
                    <div class="flex gap-5 items-center">
                        <p class="text-[14px]">Ngày tạo: {{ date('d/m/Y H:i', strtotime($document->created_at)) ?? '' }}</p>
                        <div class="relative">
                            <button class="flex items-center menu-file-toggle">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                </svg>                                  
                            </button>
                            <div class="menu-file hidden absolute right-0 w-48 bg-white rounded-lg shadow-2xl z-10">
                                <div class="flex flex-1 items-center gap-2 px-4 py-3 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                    </svg> 
                                    <button type="button" class="deleteFile block text-md" data-document-id="{{ $document->id }}" data-modal-target="deleteModal" data-modal-toggle="deleteModal">Xóa tài liệu</button>                                                                                         
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <p class="text-center ">Chưa có tài liệu nào</p>
            @endforelse
        </div>
    </div>
@stop
<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script>
    $(document).ready(function() {
    // Mở form tạo tài liệu
    $('#openFileForm').on('click', function() {
        $('#fileFormModal').removeClass('hidden');
        $('#overlay').removeClass('hidden');
    });

    // Đóng form tạo tài liệu
    $('#closeFileForm').on('click', function() {
        $('#fileFormModal').addClass('hidden');
        $('#overlay').addClass('hidden');
    });

    // Xóa file đã chọn
    $('#removeFile').click(function(event) {
        event.preventDefault();
        $('#fileInput').val(''); 
        $('.file-name').text(''); 
        $('.show_file').addClass('hidden'); 
    });

    // Hiển thị menu khi click vào icon của file
    $('.menu-file-toggle').click(function() {
        var $menu = $(this).siblings('.menu-file');
        $('.menu-file').not($menu).addClass('hidden'); 
        $menu.toggleClass('hidden'); 
    });

    // Mở form xóa tài liệu
    $(document).on('click', '.deleteFile', function(){
        $('.menu-file').addClass('hidden');
        $('#deleteModal').removeClass('hidden');
        let documentId = $(this).data('document-id');      
        let formAction = "{{ route('class.document.destroy', ':documentId') }}".replace(':documentId', documentId);          
        $('#deleteForm').attr('action', formAction);
    });

    // Đóng form xóa tài liệu
    $('[data-modal-toggle="deleteModal"]').click(function(){
        $('#deleteModal').addClass('hidden');
    });

    // Ẩn menu khi click ra ngoài
    $(document).on('click', function(event) {
        if (!$(event.target).closest('.menu-file-toggle').length && !$(event.target).closest('.menu-file').length) {
            $('.menu-file').addClass('hidden');
        }
    });
});


</script>
