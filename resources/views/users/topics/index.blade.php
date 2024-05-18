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
        <div class="flex justify-between items-center hover:bg-gray-100 cursor-pointer">
            <li class="py-1.5 px-7">Chủ đề 1</li>
            <div class="relative">
                <button id="menu-topic-toggle" class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                    </svg>                                  
                </button>
                <div id="menu-topic" class="hidden absolute right-0 w-48 bg-white rounded-lg shadow-xl z-10">
                    <div class="flex flex-1 items-center gap-2 px-4 py-2 hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>                                                                                       
                        <a href="#" class="block text-md">Đổi tên</a>
                    </div>
                    <div class="flex flex-1 items-center gap-2 px-4 py-2 hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>                                                                                          
                        <a href="#" class="block text-md">Xóa chủ đề</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script>
    $(document).ready(function() {
        $('#openTopicForm').on('click', function() {
            $('#topicFormModal').removeClass('hidden');
            $('#overlay').removeClass('hidden');
        });

        $('#closeTopicForm').on('click', function() {
            $('#topicFormModal').addClass('hidden');
            $('#overlay').addClass('hidden');
        });

        $('#menu-topic-toggle').click(function() {
            $('#menu-topic').toggleClass('hidden');
        });
    });

</script>