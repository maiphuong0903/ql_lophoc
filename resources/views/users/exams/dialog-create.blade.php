<div id="examFormModal" class="fixed z-20 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen text-gray-950">
        <div class="bg-white w-1/3 p-6 rounded-xl shadow-lg">
            <div class="flex justify-between pb-5">
                <h1 class="font-medium">Tạo bài kiểm tra</h1>
                <button id="closeExamForm" class="text-gray-500 hover:text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

           <div class="flex gap-2 mb-10 text-center">
                <a href="{{ route('class.exams.createRandom', $classRoom->id) }}" class="w-full bg-blue-500 text-white rounded-md px-2 py-6 mt-5 hover:bg-blue-700">Tạo ngẫu nhiên bài kiểm tra</a>
                <a href="{{ route('class.exams.create', $classRoom->id) }}" class="w-full bg-blue-500 text-white rounded-md px-2 py-6 mt-5 hover:bg-blue-700">Tự tạo bài kiểm tra</a>
           </div>
        </div>
    </div>
</div>
