<header class="py-3 bg-white px-3 border-b">
    <ul class="flex flex-shrink-0 space-x-8 items-center justify-end">
        <li class="relative">
            <div class="flex flex-1 gap-3 items-center">
                <button class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none">
                    @if(auth()->user()->avatar)
                        <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="w-12 h-12 rounded-full">
                    @else
                        <img src="{{ asset('images/avatar.jpg') }}" alt="" class="object-cover w-12 h-12 rounded-full">
                    @endif 
                </button>
                <div>
                    <h1 class="text-sm font-semibold text-gray-800">{{auth()->user()->name}}</h1>
                    <p class="text-sm text-gray-800">
                        {{ auth()->user()->role == 1 ? 'Lãnh đạo' : (auth()->user()->role == 2 ? 'Giáo viên' : 'Học sinh') }}
                    </p>                        
                </div>
                <button type="button" id="user-menu-togle" class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black icon-down">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                      </svg>  

                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black hidden icon-up">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                      </svg>                                                 
                </button>
            </div>
           
            <div class="hidden" id="user-menu">
                <ul class="absolute right-0 w-52 p-2 mt-3 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-lg z-50">
                    <li class="flex">
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center w-full px-2 py-1 text-md font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                              </svg>                                                                    
                            <span>Thông tin cá nhân</span>
                        </a>
                    </li>
                    <li class="flex">
                        <a href="{{ route('password.reset') }}" class="inline-flex items-center w-full px-2 py-1 text-md font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                              </svg>                                  
                            <span>Thay đổi mật khẩu</span>
                        </a>
                    </li>
                    <li class="flex">
                        <a href="{{ route('logout') }}" class="inline-flex items-center w-full px-2 py-1 text-md font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800">
                            <svg class="w-5 h-5 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                            <span>Đăng xuất</span>
                        </a>                
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</header>
<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script>
    $(document).ready(function() {
        // Mở menu mobbilde user
        $('#mobile-menu-toggle').click(function(e) {
            $('#menu-mobile').toggleClass('hidden');
            $('#menu-mobile').addClass('top-[55px] fixed inset-y-0 ');
            $('#user-menu').addClass('hidden');
        });

        // Mở menu user
        $('#user-menu-togle').click(function(e) {
            $('#user-menu').toggleClass('hidden');
            $('.icon-down').toggleClass('hidden');
            $('.icon-up').toggleClass('hidden');
            $('#menu-mobile').addClass('hidden');
        });

        // Ẩn menu khi click ra ngoài
        $(document).on('click', function(event) {
            if (!$(event.target).closest('#user-menu-togle').length && !$(event.target).closest('#user-menu').length) {
                $('#user-menu').addClass('hidden');
                $('.icon-down').toggleClass('hidden');
                $('.icon-up').toggleClass('hidden');
            }
        });

        // mở drop thông báo
        $('#notificationIcon').on('click', function(event){
            event.stopPropagation();
            $('#notificationDropdown').toggleClass('hidden');
        });

        // ấn vào window sẽ đóng drop thông báo
        $(window).on('click', function() {
            $('#notificationDropdown').addClass('hidden');
         });

        // đóng drop thông báo
        $('#notificationDropdown').on('click', function(event){
            event.stopPropagation();
        });

        // show số lượng thông báo
        $("#notificationIcon").on("click", function() {
            // Cập nhật số lượng thông báo về 0
            var notificationCount = 0;

            // Cập nhật nội dung của thẻ <span> tương ứng
            $("#notificationCount").text(notificationCount);
        });
    });
</script>