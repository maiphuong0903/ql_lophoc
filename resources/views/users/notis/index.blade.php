<h1 class="font-bold mb-5">Thông báo</h1>
@if (auth()->user()->role == 2)   
    <div class="flex items-center gap-2 bg-blue-500 py-2 rounded-md text-white justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>    
        <button type="button" id="openCreateNotiForm" class="block text-md">Tạo thông báo</button>
        @include('users.notis.create')
    </div>
@endif
<div class="mt-6">
    @forelse ($notis as $noti)
        <div class="bg-blue-50 px-3 py-3 rounded-lg mt-3 ">
            <div class="flex flex-1 gap-2 justify-between">
                <p class="text-[14px] font-medium">{{ $noti->content }}</p>
                @if (auth()->user()->role == 2)  
                    <button type="button" class="deleteNoti" data-class-room-id="{{ $classRoom->id }}" data-noti-id="{{ $noti->id }}" data-modal-target="deleteModal" data-modal-toggle="deleteModal">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>              
                    </button>
                @endif
                @include('partial.modal-delete') 
            </div>
            <p class="text-gray-500 text-[12px]">{{ date('d/m/Y H:i', strtotime($noti->created_at)) ?? '' }}</p>
        </div>
    @empty
        <img src="{{ asset('images/noti.png') }}" class="w-[170px] h-[130px] mx-auto mt-36">
        <h1 class="font-medium pt-5 text-[17px] text-center mt-14">Lớp học chưa có thông báo nào</h1>
        <p class="text-gray-600 text-center">Nội dung thông báo của giáo viên sẽ xuất hiện ở đây</p>
    @endforelse
</div>


<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script>
    $(document).ready(function() {
        // Mở form tạo thông báo
        $('#openCreateNotiForm').on('click', function() {
            $('#notiFormModal').removeClass('hidden');
            $('#overlay').removeClass('hidden');
        });

        // Đóng form tạo thông báo
        $('#closeCreateNotiForm').on('click', function() {
            $('#notiFormModal').addClass('hidden');
            $('#overlay').addClass('hidden');
        });

        // Mở form xóa thông báo
        $(document).on('click', '.deleteNoti', function() {
            $('#deleteModal').removeClass('hidden');
            let classRoomId = $(this).data('class-room-id');
            let notiId = $(this).data('noti-id');
            console.log(classRoomId);
            let formAction = "{{ route('class.noti.destroy', [':classId', ':notiId']) }}"; 

            formAction = formAction.replace(':classId', classRoomId);
            formAction = formAction.replace(':notiId', notiId);     

            $('#deleteForm').attr('action', formAction);
        });

        // Đóng form xóa thông báo
        $('[data-modal-toggle="deleteModal"]').click(function() {
            $('#deleteModal').addClass('hidden');
        });
    });
</script>
