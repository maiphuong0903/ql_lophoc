<header class="py-3 bg-white px-3 border">
    <div class="flex items-center h-full px-6 mx-auto text-blue-500 justify-between">
        <div class="md:flex gap-3 items-center hidden lg:pl-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
              
            <a class="text-lg font-bold text-gray-800" id="name-project" href="#">Windmill</a>
        </div>

        <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple" naria-label="Menu" id="mobile-menu-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
              </svg>              
        </button>
        
        <ul class="flex flex-shrink-0 space-x-8 items-center">
            <li class="relative hidden md:block">
                <a href="{{ route('class') }}" class="relative align-middle rounded-md flex flex-1 gap-2 items-center border border-blue-400 px-2 py-1.5 text-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                      </svg>                               
                    <span class="text-blue-400">Lớp học</span>            
                </a>
            </li>

            <li class="relative">
                <button class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>                           
                    <span aria-hidden="true" class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full"></span>
                </button>
            </li>
            
            <li class="relative">
                <div class="flex flex-1 gap-3 items-center">
                    <button class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none">
                        <img src="{{ asset('images/avatar.jpg') }}" alt="" class="object-cover w-10 h-10 rounded-full">
                    </button>
                    <div>
                        <h1 class="text-sm font-semibold text-gray-800">{{auth()->user()->name}}</h1>
                        <p class="text-sm text-gray-800">
                            {{ auth()->user()->role == 1 ? 'Admin' : (auth()->user()->role == 2 ? 'Giáo viên' : 'Học sinh') }}
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
                    <ul class="absolute right-0 w-52 p-2 mt-3 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md">
                        <li class="flex">
                            <a class="inline-flex items-center w-full px-2 py-1 text-md font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800" href="#">
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
    </div>
</header>
<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script>
    $(document).ready(function() {
        $('#mobile-menu-toggle').click(function(e) {
            $('#menu-mobile').toggleClass('hidden');
            $('#menu-mobile').addClass('top-[55px] fixed inset-y-0 ');
            $('#user-menu').addClass('hidden');
        });

        $('#user-menu-togle').click(function(e) {
            $('#user-menu').toggleClass('hidden');
            $('.icon-down').toggleClass('hidden');
            $('.icon-up').toggleClass('hidden');
            $('#menu-mobile').addClass('hidden');
        });
    });
</script>