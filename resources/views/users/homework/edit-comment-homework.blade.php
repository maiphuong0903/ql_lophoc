<div id="editCommentFormModal" class="fixed z-20 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen text-gray-950">
        <div class="bg-white w-1/3 p-6 rounded-xl shadow-lg">
            <div class="flex justify-between">
                <h1>Cập nhật lời phê</h1>
                <button id="closeEditCommentForm" class="text-gray-500 hover:text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <p class="font-light text-[14px] py-5 text-left">Giáo viên có thể cập nhật lại lời phê cho học sinh ở đây</p>

            <form id="commentForm" method="POST">
                @csrf
                @method('PUT')
                <input type="text" id="commentInput" name="comment" class="w-full border-gray-300 rounded-md font-light focus:border-blue-50">
                <button type="submit" class="w-full bg-blue-500 text-white rounded-md px-2 py-2 mt-5 hover:bg-blue-700">Cập nhật</button>
            </form>
        </div>
    </div>
</div>