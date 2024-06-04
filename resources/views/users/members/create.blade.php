<div id="memberFormModal" class="fixed z-20 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen text-gray-950">
        <div class="bg-white w-1/3 p-6 rounded-xl shadow-lg">
            <div class="flex justify-between">
                <h1>Thêm học sinh vào lớp</h1>
                <button id="closeMemberForm" class="text-gray-500 hover:text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <p class="font-light text-[14px] py-5 text-left">Học sinh được giáo viên thêm vào lớp sẽ không cần chờ phê duyệt</p>

            <form action="{{ route('class.student.addStudent', $classRoom->id) }}" method="post">
                @csrf
                <input type="text" name="email" class="w-full border-gray-300 rounded-md font-light focus:border-blue-50" placeholder="Nhập email đăng nhập của học sinh...">
                <button type="submit" class="w-full bg-blue-500 text-white rounded-md px-2 py-2 mt-5 hover:bg-blue-700">Thêm học sinh</button>
            </form>
        </div>
    </div>
</div>