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

            <form action="" method="GET">
                <label for="">Tiêu đề: </label>
                <input type="text" class="w-full border-gray-300 rounded-md font-light focus:border-blue-50 mb-3" placeholder="Tiêu đề...">
                <label for="">Mô tả: </label>
                <textarea name="" id="" cols="10" rows="5" class="w-full border-gray-300 rounded-md font-light focus:border-blue-50 mb-3"></textarea>
                <label for="">Đính kèm file: </label>
                <div class="flex justify-between pb-5">
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
                        <input type="file" id="fileInput" class="hidden">
                    </label>
                </div>
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
