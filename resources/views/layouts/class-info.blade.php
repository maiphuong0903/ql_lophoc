<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', '@Master Layout'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .active {
            background-color: #ebf8ff; /* Blue background */
            color: #2b6cb0; /* Dark blue text */
            font-weight: bold;
        }
    </style>
</head>
<body>
    <body>
        <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-10 hidden"></div>
        <div class="flex flex-col min-h-screen">
            <div class="fixed top-0 left-0 w-full">
                @include('partial.header')
            </div>
            <div class="flex flex-1">
                <div class="bg-white fixed top-16 left-0 h-full overflow-y-auto">
                    @include('partial.menu')
                </div>
                <div class="flex-1 ml-60 mt-16">
                    @yield('content')
                </div>
            </div>
        </div>     
    </body>
        
</body>
</html>
