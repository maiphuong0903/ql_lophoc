<div class="p-4">
    <h1 class="font-bold">Thông báo</h1>
    @forelse ($notifications as $notification)
        <div class="bg-blue-50 px-3 py-3 rounded-lg mt-3 notification">
            <p class="text-[14px] font-medium">{{ $notification->content }}</p>
            <p class="text-gray-500 text-[12px]">{{ date('d/m/Y H:i', strtotime($notification->created_at)) ?? '' }}</p>
            @if ($notification->is_accept == 0)              
                <div class="flex gap-5 items-center justify-center mt-2 text-sm">
                    <button type="submit" data-class-room-id="{{ $notification->class_room_id }}" data-user-id="{{ auth()->user()->id }}" data-noti-id="{{ $notification->id }}" data-action="accept-notification" class="action-button bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-300">
                        Đồng ý
                    </button>
                    <button type="submit" data-class-room-id="{{ $notification->class_room_id }}" data-user-id="{{ auth()->user()->id }}" data-noti-id="{{ $notification->id }}" data-action="reject-notification" class="action-button bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-300">
                        Từ chối
                    </button>
                </div>
            @endif
        </div>
    @empty
        <p class="text-[14px] text-gray-500 py-5">Bạn chưa có thông báo nào</span></p>
    @endforelse
</div>
<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script>
    $(document).ready(function() {
        // ajax đồng ý hay từ chối tham gia lớp học
        $('.action-button').on('click', function() {
            let action = $(this).data('action');
            let classRoomId = $(this).data('class-room-id');
            let userId = $(this).data('user-id');
            let notiId = $(this).data('noti-id');
            // đồng ý tham gia lớp học
            if (action === 'accept-notification'){
                let acceptUrl = '{{ route('class.user.acceptJoinClass', [':id', ':userId', ':notiId']) }}';
                acceptUrl = acceptUrl.replace(':id', classRoomId).replace(':userId', userId).replace(':notiId', notiId);
                $.ajax({
                    url: acceptUrl,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
            // từ chối tham gia lớp học
            else if(action === 'reject-notification'){
                let rejectUrl = '{{ route('class.user.rejectJoinClass', [':id', ':userId', ':notiId']) }}';
                rejectUrl = rejectUrl.replace(':id', classRoomId).replace(':userId', userId).replace(':notiId', notiId);
                $.ajax({
                    url: rejectUrl,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });
    });

</script>