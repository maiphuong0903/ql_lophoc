@extends('layouts.class-info')

@section('title', 'Bảng Tin')

@section('content')
    <div class="grid grid-cols-4 bg-gray-100">
        <div class="col-span-3">
           <div class="border border-1 px-5 py-5 bg-white font-medium fixed top-16 w-full overflow-y-auto">
                <h1>Bảng tin</h1>
           </div>
           <div class="my-24 mx-32">
                <div class="bg-white rounded-lg shadow-sm py-5">
                    <form action="">
                        <div class="flex flex-1 items-center bg-white px-5 pb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-14 h-14">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                              </svg>
                              <input type="text" class="w-full border-none focus:border-transparent focus:ring-0" placeholder="Nhập nội dung thảo luận với lớp học...">
                        </div>
                        <hr>
                        <div class="flex justify-end">
                            <button type="submit" class="px-5 border bg-gray-100 rounded-md py-2 mt-3 mx-5">Đăng tin</button>
                        </div>     
                    </form>       
                </div>
                <div class="bg-white rounded-lg shadow-sm py-5 px-5 mt-5">
                    {{-- <img src="{{ asset('images/newsfeed.jpg') }}" class="w-[200px] h-[200px] mx-auto">
                    <h1 class="font-medium pt-5 text-[17px] text-center">Bảng tin</h1>
                    <p class="text-gray-600 text-center">Nơi trao đổi các vấn đề trong lớp học dành cho giáo viên học sinh</p> --}}

                    {{-- trường hợp có tin mới --}}
                    <div class="flex flex-1 justify-between items-center">
                        <div class="flex flex-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-14 h-14">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <div>
                                <h1 class="font-medium text-[17px]">Phượng</h1>
                                <p class="text-[13px]">Vừa xong</p>
                            </div>
                        </div>
                        <div class="relative">
                            <button id="menu-news-togle" class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                </svg>                                  
                            </button>
                            <div id="menu-news" class="hidden absolute right-0 w-48 bg-white rounded-lg shadow-xl z-10">
                                <div class="flex flex-1 items-center gap-2 px-4 pb-2 pt-6 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                      </svg>                                   
                                      <a href="#" class="block text-md">Chỉnh sửa bài viết</a>
                                </div>
                                <div class="flex flex-1  items-center gap-2 px-4 pt-2 pb-6 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                      </svg>                                  
                                    <a href="#" class="block text-md">Xóa bài viết</a>
                                </div>
                            </div>
                        </div>                          
                    </div>

                    <p class="pt-3 pb-6 text-left px-5">Nội dung bảng tin</p>
                    
                    <div class="flex justify-between px-2 pb-3 text-gray-500 text-[14px]">
                        <div class="flex justify-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                              </svg> 
                            <p>0 bình luận</p>
                        </div> 
                        <p>Ẩn bình luận</p>                        
                    </div>
                    <div>
                        <form action="">
                            <div class="flex flex-1 items-center gap-3 bg-white pb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-12 h-12">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <input type="text" class="w-full rounded-full border-gray-200 focus:border-blue-100" placeholder="Viết bình luận...">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                </svg>                                  
                            </div>
                        </form> 
                    </div>
                    <div class="flex gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-10 h-10">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <div>
                            <div class="flex gap-2">                         
                                 <h1>Mai Phượng</h1>
                                 <p class="text-gray-500">23:11</p>
                            </div>
                            <p class="text-left pt-2">Nội dung bình luận</p>
                        </div>
                    </div>
                </div>
           </div>
        </div>

        <div class="w-80 border border-1 px-5 py-5 bg-white fixed right-0 h-full overflow-y-auto">
            <h1 class="font-medium mb-5">Thông báo</h1>
            {{-- <img src="{{ asset('images/noti.png') }}" class="w-[170px] h-[130px] mx-auto mt-36">
            <h1 class="font-medium pt-5 text-[17px] text-center mt-14">Lớp học chưa có thông báo nào</h1>
            <p class="text-gray-600 text-center">Nội dung thông báo của giáo viên sẽ xuất hiện ở đây</p> --}}

            <div class="flex flex-1 gap-2 mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-10 h-10">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
               <div>
                    <p class="text-[14px] font-medium">Nội dung thông báo</p> 
                    <p class="text-gray-500 text-[12px]">09-03-2002 23:11</p>
               </div>
            </div>
           
        </div>
    </div>
@stop
<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script>
    $(document).ready(function() {
        $('#menu-news-togle').click(function(e) {
        e.stopPropagation();
        $('#menu-news').toggleClass('hidden');
        });

    $(document).click(function(e) {
      const menuNews = $('#menu-news');
      const menuNewsTogle = $('#menu-news-togle');
      if (!menuNews.is(e.target) && !menuNewsTogle.is(e.target) && menuNews.has(e.target).length === 0) {
        menuNews.addClass('hidden');
      }
    });
  });
</script>
