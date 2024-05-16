<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang Chủ</title>
    @vite('resources/css/app.css')
</head>

<body>
    <header class="fixed w-full">
        <nav class="bg-white shadow-sm border-gray-200 py-4 z-40">
            <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
                <a href="#" class="flex items-center self-center text-xl font-semibold whitespace-nowrap">Landwind</a>
                <div class="flex items-center md:order-2">
                    <div class="col-span-3">
                        <ul class="flex flex-1 gap-3 justify-end px-3">
                            <li class="bg-[#f6f6f7] px-3 py-2 rounded-md font-medium hover:bg-gray-200">
                                <a href="{{ route('login') }}">Đăng nhập</a>
                            </li>
                            <li class="bg-[#167cef] px-4 py-2 rounded-md text-white hover:bg-blue-600 hidden md:block">
                                <a href="{{ route('register') }}">Đăng ký</a>
                            </li>
                        </ul>
                    </div>
                    <button id="mobile-menu-toggle" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                        <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="mobile-menu">
                    <ul class="flex flex-col mt-4 font-medium md:flex-row md:space-x-8 md:mt-0">
                        <li>
                            <a href="#" id="home-link" class="block py-2 pl-3 pr-4 rounded-md text-gray-700 border-b focus:text-blue-500 border-gray-100 hover:bg-[#167cef] md:hover:bg-transparent md:border-0 md:hover:text-blue-500 md:p-0">Trang chủ</a>
                        </li>
                        <li>
                            <a href="#" id="feature-link" class="block py-2 pl-3 pr-4 rounded-md text-gray-700 border-b focus:text-blue-500 border-gray-100 hover:bg-[#167cef] md:hover:bg-transparent md:border-0 md:hover:text-blue-500 md:p-0">Tính năng</a>
                        </li>
                        <li>
                            <a href="#" id="contact-link" class="block py-2 pl-3 pr-4 rounded-md text-gray-700 border-b focus:text-blue-500 border-gray-100 hover:bg-[#167cef] md:hover:bg-transparent md:border-0 md:hover:text-blue-500 md:p-0">Liên hệ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    {{-- home --}}
    <section id="home">
        <div class="grid lg:max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:pt-28 lg:pb-6 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-6 xl:col-span-7 mx-auto">
                <h1 class="text-[#1d88e5] text-[20px] lg:text-[20px]">PhuongClassroom</h1>
                <p class="max-w-2xl mb-3 text-2xl font-extrabold leading-none tracking-tight md:text-5xl lg:text-4xl">Một cách hiệu quả để quản lý lớp học</p>
                <p class="max-w-2xl mb-3 font-light text-gray-700 md:text-lg lg:text-xl">Ứng dụng quản lý lớp học PhuongClassroom kết nối học sinh và giáo viên một cách dễ dàng chỉ cần Internet, áp dụng từ quy mô lớp học đến toàn hệ thống trường học.</p>
                <button class="bg-[#167cef] px-10 py-3 rounded-2xl text-white text-[22px] mt-3 mb-6 font-medium hover:bg-blue-600">Tham gia ngay</button>
             
                <div class="flex flex-1 gap-2 items-center bg-[#f1f1f6] xl:px-4 xl:py-3 px-2 py-2 rounded-2xl font-medium xl:w-2/3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-700"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" /></svg>
                    <p>Cung cấp tài liệu học tập cho học viên</p>
                </div>

                <div class="md:flex flex-1 gap-4 xl:py-3 mt-2 xl:mt-1 font-medium">
                    <div class="flex flex-1 gap-2 items-center bg-[#f1f1f6] xl:px-4 xl:py-3 px-2 py-2 rounded-2xl mb-2 xl:mb-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-orange-600"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" /></svg>
                        <p>Thi trực tuyến</p>
                    </div>

                    <div class="flex flex-1 gap-2 items-center bg-[#f1f1f6] xl:px-4 xl:py-3 px-2 py-2 rounded-2xl mb-2 xl:mb-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-500"><path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" /></svg>
                        <p>Giao bài tập</p>
                    </div>

                    <div class="flex flex-1 gap-2 items-center bg-[#f1f1f6] xl:px-4 xl:py-3 px-2 py-2 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-500"> <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" /></svg>
                        <p>Quản lý điểm</p>
                    </div>
                </div>

                <div class="md:flex flex-1 gap-2 mt-2 xl:mt-1 font-medium">
                    <div class="flex flex-1 gap-2 items-center bg-[#f1f1f6] xl:px-4 xl:py-3 px-2 py-2 rounded-2xl mb-2 xl:mb-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-yellow-700"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" /></svg>
                        <p>Tổ chức lớp học trực tuyến</p>
                    </div>
                    <div class="flex flex-1 gap-2 items-center bg-[#f1f1f6] xl:px-4 xl:py-3 px-2 py-2 rounded-2xl mb-2 xl:mb-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-purple-500"> <path stroke-linecap="round" stroke-linejoin="round" d="M16.712 4.33a9.027 9.027 0 0 1 1.652 1.306c.51.51.944 1.064 1.306 1.652M16.712 4.33l-3.448 4.138m3.448-4.138a9.014 9.014 0 0 0-9.424 0M19.67 7.288l-4.138 3.448m4.138-3.448a9.014 9.014 0 0 1 0 9.424m-4.138-5.976a3.736 3.736 0 0 0-.88-1.388 3.737 3.737 0 0 0-1.388-.88m2.268 2.268a3.765 3.765 0 0 1 0 2.528m-2.268-4.796a3.765 3.765 0 0 0-2.528 0m4.796 4.796c-.181.506-.475.982-.88 1.388a3.736 3.736 0 0 1-1.388.88m2.268-2.268 4.138 3.448m0 0a9.027 9.027 0 0 1-1.306 1.652c-.51.51-1.064.944-1.652 1.306m0 0-3.448-4.138m3.448 4.138a9.014 9.014 0 0 1-9.424 0m5.976-4.138a3.765 3.765 0 0 1-2.528 0m0 0a3.736 3.736 0 0 1-1.388-.88 3.737 3.737 0 0 1-.88-1.388m2.268 2.268L7.288 19.67m0 0a9.024 9.024 0 0 1-1.652-1.306 9.027 9.027 0 0 1-1.306-1.652m0 0 4.138-3.448M4.33 16.712a9.014 9.014 0 0 1 0-9.424m4.138 5.976a3.765 3.765 0 0 1 0-2.528m0 0c.181-.506.475-.982.88-1.388a3.736 3.736 0 0 1 1.388-.88m-2.268 2.268L4.33 7.288m6.406 1.18L7.288 4.33m0 0a9.024 9.024 0 0 0-1.652 1.306A9.025 9.025 0 0 0 4.33 7.288" /></svg>
                        <p>Tạo nhiệm vụ học tập</p>
                    </div>
                </div>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-6 xl:col-span-5 lg:flex">
                <img src="{{ asset('images/slide.png') }}" alt="slide image">
            </div>
        </div>
    </section>

    <div class="bg-gray-50">
        {{-- tính năng --}}
        <section class="md:pb-32 mt-16 lg:mt-6 pb-28 pt-16" id="feature">   
            <div class="justify-center text-center flex flex-wrap">
                <div class="w-full px-7 md:px-24 lg:px-20 2xl:w-8/12">
                    <h2 class="font-semibold text-3xl md:text-4xl">Tính Năng Nổi Bật</h2>
                    <p class="text-md md:text-lg leading-relaxed mt-4 mb-4">Cung cấp cho giáo viên và học sinh một môi trường dạy học trực tuyến và quản lý học sinh, điểm của từng học sinh một cách dễ dàng và chính xác.</p>
                </div>
            </div>
        </section>
    
        <section class="max-w-screen-xl mx-auto">
            <div class="container mx-auto">
                <div class="justify-center flex flex-wrap">
                    <div class="w-full lg:w-12/12 px-4 -mt-24">
                        <div class="flex flex-wrap">
                            <div class="w-full md:w-4/12 px-4 py-4">
                                <h5 class="text-xl font-semibold pb-4 text-center">Quản lý lớp học</h5>
                                <div
                                    class="hover:-mt-4 flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg ease-linear transition-all duration-150">
                                    <img alt="..." class="align-middle border-none max-w-full h-auto rounded-lg"
                                        src="https://www.creative-tim.com/learning-lab/tailwind-starter-kit/img/login.jpg">
                                </div>
                            </div>
                            <div class="w-full md:w-4/12 px-4 py-4">
                                <h5 class="text-xl font-semibold pb-4 text-center">Quản lý học sinh</h5>
                                <div
                                    class="hover:-mt-4 flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg ease-linear transition-all duration-150">
                                    <img alt="..." class="align-middle border-none max-w-full h-auto rounded-lg"
                                        src="https://www.creative-tim.com/learning-lab/tailwind-starter-kit/img/profile.jpg">
                                </div>
                            </div>
                            <div class="w-full md:w-4/12 px-4 py-4">
                                <h5 class="text-xl font-semibold pb-4 text-center">Kiểm soát bảng điểm</h5>
                                <div
                                    class="hover:-mt-4 flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg ease-linear transition-all duration-150">
                                    <img alt="..." class="align-middle border-none max-w-full h-auto rounded-lg"
                                        src="https://www.creative-tim.com/learning-lab/tailwind-starter-kit/img/landing.jpg">
                                </div>
                            </div>
                            <div class="w-full md:w-4/12 px-4 py-4">
                                <h5 class="text-xl font-semibold pb-4 text-center">Kết nối lớp học</h5>
                                <div
                                    class="hover:-mt-4 flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg ease-linear transition-all duration-150">
                                    <img alt="..." class="align-middle border-none max-w-full h-auto rounded-lg"
                                        src="https://www.creative-tim.com/learning-lab/tailwind-starter-kit/img/login.jpg">
                                </div>
                            </div>
                            <div class="w-full md:w-4/12 px-4 py-4">
                                <h5 class="text-xl font-semibold pb-4 text-center">Quản lý tài liệu, bài tập</h5>
                                <div
                                    class="hover:-mt-4 flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg ease-linear transition-all duration-150">
                                    <img alt="..." class="align-middle border-none max-w-full h-auto rounded-lg"
                                        src="https://www.creative-tim.com/learning-lab/tailwind-starter-kit/img/profile.jpg">
                                </div>
                            </div>
                            <div class="w-full md:w-4/12 px-4 py-4">
                                <h5 class="text-xl font-semibold pb-4 text-center">Tạo bài kiểm tra dễ dàng</h5>
                                <div
                                    class="hover:-mt-4 flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg ease-linear transition-all duration-150">
                                    <img alt="..." class="align-middle border-none max-w-full h-auto rounded-lg"
                                        src="https://www.creative-tim.com/learning-lab/tailwind-starter-kit/img/landing.jpg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
        {{-- liên hệ --}}
        <section class="mt-16 lg:mt-20" id="contact">   
            <div class="justify-center text-center flex flex-wrap">
                <div class="w-full px-7 md:px-24 lg:px-20 2xl:w-8/12">
                    <h2 class="font-semibold text-3xl md:text-4xl">Liên hệ với chúng tôi</h2>
                    <p class="text-md md:text-lg leading-relaxed mt-4 mb-4"> Chúng tôi rất vui được giúp đỡ bạn, với bất kỳ câu hỏi hay phàn nàn nào bạn gửi tới. Chúng tôi hứa sẽ trả lời bạn trong thời gian sớm nhất có thể. Xin cảm ơn bạn rất nhiều!</p>
                </div>
            </div>
        </section>
        
        <section class="max-w-screen-md mx-auto my-5 mt-10 px-10 md:px-20 lg:px-12">
            <form>
                <div class="grid gap-3 md:gap-6 md:mb-6 mb-3 md:grid-cols-2">
                    <div class="flex flex-1">
                        <input type="text" id="name" class="border border-gray-200 text-gray-900 text-md rounded-md w-full px-3 py-2.5 focus:border-blue-300 focus:outline-none" placeholder="Tên" />
                        <span class="text-red-500 ml-1.5">*</span>
                    </div>
                    <div class="flex flex-1">
                        <input type="text" id="last_name" class="border border-gray-200 text-gray-900 text-md rounded-md w-full px-3 py-2.5 focus:border-blue-300 focus:outline-none" placeholder="Email" />
                        <span class="text-red-500 ml-1.5">*</span>
                    </div>
                </div>
                <div class="mb-6 flex flex-1">
                    <textarea name="" id="" cols="50" rows="5" class="px-3 py-2 border border-gray-200 w-full focus:border-blue-300 focus:outline-none" placeholder="Viết vài điều..."></textarea>
                    <span class="text-red-500 ml-1.5">*</span>
                </div>       
                <div class="text-center">
                    <button type="submit" class="text-white bg-blue-500 hover:bg-blue-600 font-medium rounded-xl text-md w-full sm:w-auto px-14 py-2 text-center">Gửi đi</button>
                </div>
            </form>
        </section>

        {{-- footer --}}
        <footer class="mt-20 pt-20 pb-6 bg-[#1f2734] text-white">
            <div class="container mx-auto px-4 max-w-screen-xl">
                <div class="flex flex-wrap text-left lg:text-left">
                    <div class="w-full lg:w-6/12 px-4 mb-10 lg:mb-0">
                        <h4 class="text-3xl fonat-semibold mb-3">PhuongClassroom!</h4>
                        <h5 class="text-lg mt-0 mb-3">
                            Số 3 Đ. Cầu Giấy, Láng Thượng, Cầu Giấy, Hà Nội, Việt Nam
                        </h5>
                        <div class="flex flex-1 gap-3 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"> <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>
                            <p>Số điện thoại: 0359359737</p>
                        </div>
                        <div class="flex flex-1 gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"> <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                            <p>Email: maithiphuong@gmail.com</p>
                        </div>
                    </div>
                    <div class="w-full lg:w-6/12 px-4">
                        <div class="flex flex-wrap items-top mb-6">
                            <div class="w-full lg:w-4/12 px-4 ml-auto mb-3 lg:mb-0">
                                <span class="block text-sm font-semibold mb-2">VỀ WEBSITE</span>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="" class="font-semibold block pb-2 text-sm hover:text-blue-400">Trang chủ</a>
                                       
                                    </li>
                                    <li>
                                        <a href="" class="font-semibold block pb-2 text-sm hover:text-blue-400">Tính năng</a>
                                    </li>
                                    <li>
                                        <a href="" class="font-semibold block pb-2 text-sm hover:text-blue-400">Liên hệ</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="w-full lg:w-4/12 px-4">
                                <span class="block text-sm font-semibold mb-2">HỖ TRỢ NGƯỜI DÙNG</span>

                                <ul class="list-unstyled">
                                    <li>
                                        <a href="" class="font-semibold block pb-2 text-sm hover:text-blue-400">Bộ phận hỗ trợ</a>
                                    </li>
                                    <li>
                                        <a href="" class="font-semibold block pb-2 text-sm hover:text-blue-400">Điều khoản sử dụng</a>
                                    </li>
                                    <li>
                                        <a href="" class="font-semibold block pb-2 text-sm hover:text-blue-400">Chính sách bảo mât</a>
                                    </li>
                                    <li>
                                        <a href="" class="font-semibold block pb-2 text-sm hover:text-blue-400">Chính sách thanh toán</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-6 border-blueGray-300">
                <div class="flex flex-wrap items-center md:justify-between justify-center">
                    <div class="w-full px-4 mx-auto text-center">
                        <p class="text-center text-md font-semibold py-1">Copyright © Bản quyền thuộc PhuongClass 2024. Phát triển bởi Mai Phượng</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#mobile-menu-toggle').click(function(e) {
            $('#mobile-menu').toggleClass('hidden');
        });

        $('#feature-link').click(function(e) {
            var contentSection = $('#feature');
                $('html, body').animate({
                    scrollTop: contentSection.offset().top
                }, 1000); 
        });

        $('#home-link').click(function(e) {
            var contentSection = $('#home');
                $('html, body').animate({
                    scrollTop: contentSection.offset().top
                }, 1000); 
        });

        
        $('#contact-link').click(function(e) {
            var contentSection = $('#contact');
                $('html, body').animate({
                    scrollTop: contentSection.offset().top
                }, 1000); 
        });
        
    })
</script>

