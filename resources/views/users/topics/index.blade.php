<div class="col-span-1 bg-white h-full overflow-y-auto min-h-[calc(100vh-130px)] border-r">
    <div class="flex flex-1 justify-between border-b px-5 py-5 items-center">
        <h1 class="font-medium">Chủ đề</h1>
        <button id="openTopicForm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
            </svg>                  
        </button>
        @include('users.topics.create')
    </div>
    <div class="text-gray-900 pt-3">
        <p class="py-2 px-5 hover:bg-gray-100 cursor-pointer font-medium">Tất cả tài liệu</p>
        @forelse ($topics as $topic)
            <div class="flex justify-between items-center hover:bg-gray-100 topic-item">
                <li class="py-1.5 px-7 cursor-pointer">{{ $topic->name }}</li>
                <div class="relative">
                    <button class="menu-topic-toggle flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                        </svg>                                  
                    </button>
                    @include('users.topics.edit')
                    @include('partial.modal-delete')
                    <div class="menu-topic hidden absolute right-0 w-48 bg-white rounded-lg shadow-xl z-10">
                        <div class="flex flex-1 items-center gap-2 px-4 py-2 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>                                                                     
                            <button type="button" data-topic-id="{{ $topic->id }}" data-topic-name="{{ $topic->name }}" class="openEditTopicForm block text-md">Đổi tên</button>
                        </div>
                        <div class="flex flex-1 items-center gap-2 px-4 py-2 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                            </svg>                                                                                        
                            <button type="button" class="deleteTopic block text-md" data-topic-id="{{ $topic->id }}" data-modal-target="deleteModal" data-modal-toggle="deleteModal">Xóa chủ đề</button>
                        </div>
                    </div>
                </div>
            </div>           
        @empty
            <p class="text-gray-500 px-5">Chưa có chủ đề nào</p>
        @endforelse
    </div>
</div> 

<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script>
    $(document).ready(function() {
        // Mở form tạo chủ đề
        $('#openTopicForm').on('click', function() {
            $('#topicFormModal').removeClass('hidden');
            $('#overlay').removeClass('hidden');
        });

        // close topic form create
        $('#closeTopicForm').on('click', function() {
            $('#topicFormModal').addClass('hidden');
            $('#overlay').addClass('hidden');
        });

        // Mở form sửa chủ đề
        $('.openEditTopicForm').on('click', function() {
            $('#editTopicFormModal').removeClass('hidden');
            $('#overlay').removeClass('hidden');
            $(this).closest('.menu-topic').toggleClass('hidden');

            let topicId = $(this).data('topic-id');
            let topicName = $(this).data('topic-name');

            let formAction = "{{ route('class.topic.update', ':topicId') }}".replace(':topicId', topicId);          
            $('#topicForm').attr('action', formAction);

            $('#topicContentInput').val(topicName);
        });

        // Đóng form sửa chủ đề
        $('#closeEditTopicForm').on('click', function() {
            $('#editTopicFormModal').addClass('hidden');
            $('#overlay').addClass('hidden');
            $('.menu-topic').addClass('hidden');
        });

        // Hiển thị menu chủ đề
        $('.menu-topic-toggle').on('click', function() {
            var $menu = $(this).siblings('.menu-topic');
            $('.menu-topic').not($menu).addClass('hidden'); 
            $menu.toggleClass('hidden');
        });

        // Mở form xóa chủ đề
        $(document).on('click', '.deleteTopic', function(){
            $('.menu-topic').addClass('hidden');
            $('#deleteModal').removeClass('hidden');
            let topicId = $(this).data('topic-id');      
            let formAction = "{{ route('class.topic.destroy', ':topicId') }}".replace(':topicId', topicId);          
            $('#deleteForm').attr('action', formAction);
        });

        // Đóng form xóa chủ đề
        $('[data-modal-toggle="deleteModal"]').click(function(){
            $('#deleteModal').addClass('hidden');
        });

        // Ẩn menu khi click ra ngoài
        $(window).on('click', function(event) {
            if (!$(event.target).closest('.menu-topic-toggle').length && !$(event.target).closest('.menu-topic').length) {
                $('.menu-topic').addClass('hidden');
            }
        });
    });
</script>
