<div id="questionFormModal" class="fixed z-20 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen text-gray-950">
        <div class="bg-white w-1/3 p-6 rounded-xl shadow-lg">
            <div class="flex justify-between pb-5">
                <h1 class="font-medium">Tạo câu hỏi</h1>
                <button id="closeQuestionForm" class="text-gray-500 hover:text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="" method="GET">
                <label for="">Câu hỏi: </label>
                <textarea name="" id="" cols="10" rows="3" class="w-full border-gray-300 rounded-md font-light focus:border-blue-50 mb-3 mt-2"></textarea>
                <p class="mb-2">Đáp án:</p>
                <div class="flex gap-3 justify-between items-center">
                    <div class="flex gap-1 items-center">
                        <input type="radio"> <label for="">A</label>
                    </div>
                    <div class="flex gap-1 items-center">
                        <input type="radio"> <label for="">B</label>
                    </div>
                    <div class="flex gap-1 items-center">
                        <input type="radio"> <label for="">C</label>
                    </div>
                    <div class="flex gap-1 items-center">
                        <input type="radio"> <label for="">D</label>
                    </div>
                </div>
                               
                <button type="submit" class="w-full bg-blue-500 text-white rounded-md px-2 py-2 mt-5 hover:bg-blue-700">Tạo</button>
            </form>
        </div>
    </div>
</div>

