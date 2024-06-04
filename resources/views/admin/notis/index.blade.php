@extends('layouts.admin')

@section('title', 'WindClassRoom')

@section('content')
    @include('partial.toast-message')
    {{-- danh sách thông báo --}}
    <div class="flex flex-col bg-white shadow-md mx-10 mt-6 min-h-[calc(100vh-130px)]">
        <h1 class="mx-auto pt-5 pb-3 text-[19px] font-medium text-blue-500">DANH SÁCH THÔNG BÁO</h1>
        <hr>
        <div class="overflow-x-auto px-10 py-5">
            <div class="inline-block min-w-full">
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light text-surface border relative">
                        <thead class="border-b border-neutral-200 bg-gray-200 font-medium">
                            <tr>
                                <th scope="col" class="px-10 py-4">Thông báo</th>
                                <th scope="col" class="px-6 py-4">Người tạo</th>
                                <th scope="col" class="px-6 py-4">Ngày tạo</th>
                                <th scope="col" class="px-6 py-4 w-[120px]">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($notis as $key => $noti)
                                <tr class="border-b border-neutral-200 bg-black/[0.02] odd:bg-white even:bg-gray-50">
                                    <td class="px-6 py-4 notification-icon" data-notification-id="{{ $noti->id }}" data-is-accept="{{ $noti->is_accept }}">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4" data-icon="down">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                            </svg>
                                            <span class="title {{ $noti->is_accept ? 'font-normal' : 'font-semibold' }}">{{ $noti->title }}</span>
                                        </div>
                                        <ul class="list-disc px-6 py-2">
                                            <li class="ml-4 text-gray-900 notification-content hidden">{{ $noti->content }}</li>
                                        </ul>
                                    </td>
                                    <td class="px-6 py-4 notification-content">{{ $noti->author->name }}</td>
                                    <td class="px-6 py-4">{{ date('d-m-Y', strtotime($noti->created_at)) }}</td>
                                    <td class="px-10 py-4">
                                        <form action="{{ route('admin.noti.delete', $noti->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center p-5">Không có thông báo nào</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="absolute bottom-6 right-16 w-full">
                        {{ $notis->links('pagination.paginate') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // mở thông báo
        $('.notification-icon').click(function() {
            const content = $(this).find('.notification-content');
            const icon = $(this).find('svg');
            const title = $(this).find('.title');
            let isAccept = $(this).data('is-accept');

            content.toggleClass('hidden');

            // Lấy trạng thái hiện tại của icon
            const currentIcon = icon.attr('data-icon');

            // Thay đổi giá trị của icon
            if (currentIcon === 'up') {
                icon.attr('data-icon', 'down');
                icon.find('path').attr('d', 'm19.5 8.25-7.5 7.5-7.5-7.5');
            } else {
                icon.attr('data-icon', 'up');
                icon.find('path').attr('d', 'm4.5 15.75 7.5-7.5 7.5 7.5');
            }

            // Cập nhật trạng thái thông báo nếu chưa được đọc
            if (!isAccept) {
                let notificationId = $(this).data('notification-id');
                $.ajax({
                    url: '{{ route('admin.noti.update-status-noti', ':notiId') }}'.replace(':notiId', notificationId),
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: (function(titleElement, notificationElement) {
                        return function(response) {
                            if (response.success) {
                                toastr.success('Thông báo đã được đọc', '', {"timeOut": 2000});
                                // Chuyển đổi màu của title
                                titleElement.removeClass('font-semibold').addClass('font-normal');
                                // Cập nhật is_accept sau khi thông báo đã được đọc
                                notificationElement.data('is-accept', 1);
                            }
                        }
                    })(title, $(this)),
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                // Nếu đã đọc, đảm bảo title luôn nhạt
                title.addClass('font-normal').removeClass('font-semibold');
            }
        });
    });
</script>

