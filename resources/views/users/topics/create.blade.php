<div id="topicFormModal" class="fixed z-20 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen text-gray-950">
        <div class="bg-white w-1/4 p-6 rounded-xl shadow-lg">
            <div class="flex justify-between pb-5">
                <h1>Tạo chủ đề</h1>
                <button id="closeTopicForm" class="text-gray-500 hover:text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('class.topic.store', $classRoom->id) }}" method="post">
                @csrf
                <input type="hidden" name="class_room_id" value="{{ $classRoom->id }}">
                <input type="text" name="name" class="w-full border-gray-300 rounded-md font-light focus:border-blue-50" placeholder="Nhập chủ đề...">
                <button type="submit" class="w-full bg-blue-500 text-white rounded-md px-2 py-2 mt-5 hover:bg-blue-700">Tạo</button>
            </form>
        </div>
    </div>
</div>