<div id="leaveClassModal" tabindex="-1" aria-hidden="true" class="fixed z-50 inset-0 overflow-y-auto flex justify-center items-center bg-gray-500 bg-opacity-50 hidden">
    <form method="POST" id="leaveForm" class="bg-white rounded-lg">
        @csrf
        @method('DELETE')
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 text-center">                       
                <p class="mb-3 text-gray-900 font-medium text-[18px]">Bạn có chắc chắn muốn rời khỏi lớp?</p>
                <p class="mb-7 text-gray-500">Sau khi rời khỏi lớp tất cả các tin đăng và bài tập của bạn sẽ bị xóa hết khi tham gia lớp lần tới</p>
                <div class="flex justify-center items-center space-x-4">
                    <button data-modal-toggle="deleteModal" type="button" class="py-2 px-3 text-sm font-medium text-white bg-gray-500 hover:bg-gray-700 rounded-lg border border-gray-200 focus:ring-4 focus:outline-none focus:ring-primary-300 focus:z-10">
                        Hủy
                    </button>
                    <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300">
                        Xác nhận
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
