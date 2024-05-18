<div id="contactFormModal" class="fixed z-20 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen text-gray-950">
        <div class="bg-white w-1/3 p-6 rounded-xl shadow-lg">
            <div class="flex justify-between">
                <h1>Thêm giáo viên đồng hành</h1>
                <button id="closeContactForm" class="text-gray-500 hover:text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <p class="font-light text-[14px] py-5 text-left">Giáo viên đồng hành sẽ có tất cả quyền của giáo viên sở hữu lớp học ngoại trừ cài đặt lớp học, chỉnh sửa vai trò lớp học và xóa lớp học.</p>

            <form action="" method="post">
                <input type="text" class="w-full border-gray-300 rounded-md font-light focus:border-blue-50 mb-5" placeholder="Nhập email đăng nhập của giáo viên...">
                <div class="text-left">           
                    <label for="" class="text-gray-500">Nội dung vai trò</label>
                    <input type="text" class="w-full border-gray-300 rounded-md font-light focus:border-blue-50 mt-2" placeholder="Ví dụ: Dạy toán...">
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white rounded-md px-2 py-2 mt-5 hover:bg-blue-700">Mời</button>
            </form>
        </div>
    </div>
</div>