@extends('layouts.classes')

@section('title', 'Danh sách lớp học')

@section('content')
    @include('partial.toast-message')
    @include('partial.search') 
    <div class="grid grid-cols-4 gap-8">
        @foreach ($classRoom as $class)  
            <a href="{{ route('class.newsfeed', $class->id) }}" class="block">    
                <div class="border border-blue-500 px-4 py-3 flex bg-white rounded-md justify-between">
                    <div class="flex gap-5">
                        <img src="{{ $class->image ?? asset('images/slide.png') }} " alt="" class="w-[120px] h-[100px] object-scale-down">
                        <div class="flex flex-col justify-between">
                            <div>
                                <h1 class="text-[15px] font-medium">{{ $class->name }}</h1>
                                <p class="text-blue-400 text-[14px]">Mã lớp: {{ $class->code }}</p>
                            </div>
                            <p class="text-gray-500 text-[14px]">Số học sinh: {{ $class->users_count }}</p>
                        </div>                  
                    </div>
                </div>
            </a>
        @endforeach
    </div> 
@stop

<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script>
    $(document).ready(function() {
        $('#menu_class_togle').click(function(e) {
            $('#menu_class').toggleClass('hidden');
        });
    });
</script>
