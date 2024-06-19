<!-- Modal -->
<div id="fileFormModal" class="fixed z-20 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen text-gray-950">
        <div class="bg-white w-1/3 p-6 rounded-xl shadow-lg">
            <div class="flex justify-between pb-5">
                <h1 class="font-medium">Tạo tài liệu</h1>
                <button id="closeFileForm" class="text-gray-500 hover:text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('class.document.store', $classRoom->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="title">Tiêu đề: <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" class="w-full border-gray-300 rounded-md font-light focus:border-blue-50" placeholder="Tiêu đề..." value="{{ old('title') }}">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <span class="mb-3"></span>
                <label for="topic_id">Chủ đề:</label>
                <select name="topic_id" id="topic_id" class="w-full border-gray-300 rounded-md font-light focus:border-blue-50 mb-3">
                    <option value="">Không có chủ đề</option>
                    @foreach ($topics as $topic)
                        <option value="{{ $topic->id }}" {{ old('topic_id') == $topic->id ? 'selected' : '' }}>{{ $topic->name }}</option>
                    @endforeach
                </select>

                <label for="description">Mô tả:</label>
                <textarea name="description" id="description" cols="10" rows="3" class="w-full border-gray-300 rounded-md font-light focus:border-blue-50 mb-3">{{ old('description') }}</textarea>

                <label for="document_url">Đính kèm file: <span class="text-red-500">*</span></label>
                <div class="flex justify-between pb-2">
                    <span class="file-name"></span>
                    <button id="removeFile" class="text-gray-500 hover:text-red-500 hidden show_file">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-32 p-10 group text-center">
                        <div class="h-full w-full text-center flex flex-col items-center justify-center">
                            <div class="border px-3 py-3 bg-gray-200 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                </svg>
                            </div>
                            <p class="pointer-none text-[15px] mt-1.5"><span class="text-md">
                                    Tải lên
                            </p>
                        </div>
                        <input type="file" id="fileInput" class="hidden" name="document_url">
                    </label>
                </div>
                @error('document_url')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <button type="submit" class="w-full bg-blue-500 text-white rounded-md px-2 py-2 mt-5 hover:bg-blue-700">Tạo</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#fileInput').change(function() {
            const fileName = $(this).prop('files')[0].name;
            $('.file-name').text(fileName);
            $('.show_file').removeClass('hidden');
        });
    });
</script>
@if ($errors->any())
    <script>
        $(document).ready(function() {
            $('#fileFormModal').removeClass('hidden');
            $('#overlay').removeClass('hidden');
        }); 
    </script>
@endif
