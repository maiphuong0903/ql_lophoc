<div class="mt-5 mb-10 grid grid-cols-8 gap-6">   
    <div class="col-span-5 flex items-center h-full">
        <form action="{{ route('class') }}" method="GET" class="w-full">
            <div class="relative flex justify-between items-center">
                <input type="text" name="search" class="border border-gray-300 rounded-md focus:border-blue-50 focus:outline-none w-full cursor-pointer" placeholder="Tìm kiếm theo tên lớp hoặc mã lớp...">
                <button type="submit" class="text-gray-500 absolute right-0 mr-2 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg> 
                </button>        
            </div>
        </form>
    </div>    
    <div class="col-span-2">       
        <button id="sort-dropdown" data-dropdown-toggle="dropdown" class="border border-gray-300 focus:border-blue-500 bg-white rounded-md text-md px-3 py-2 text-center inline-flex items-center w-full justify-between" type="button">Sắp xếp 
            <svg class="w-2.5 h-2.5 ms-52" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
        </button>
        
        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-80">
            <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                <li>
                    <a href="{{ route('class', ['sort_by' => 'asc']) }}" class="block px-4 py-2 hover:bg-gray-100">A-Z</a>
                </li>
                <li>
                    <a href="{{ route('class', ['sort_by' => 'desc']) }}" class="block px-4 py-2 hover:bg-gray-100">Z-A</a>
                </li>
                <li>
                    <a href="{{ route('class', ['sort_by' => 'newest']) }}" class="block px-4 py-2 hover:bg-gray-100">Mới nhất</a>
                </li>
                <li>
                    <a href="{{ route('class', ['sort_by' => 'oldest']) }}" class="block px-4 py-2 hover:bg-gray-100">Cũ nhất</a>
                </li>
            </ul>
        </div>        
    </div>
   
    @if (auth()->user()->role == 2)
        <div class="col-span-1">
            <div class="flex items-center gap-2 bg-blue-500 py-2 rounded-md text-white justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>          
                <a href="{{ route('class.create') }}">Tạo lớp học</a>
            </div>
        </div>
    @endif

    @if (auth()->user()->role == 3)
        <div class="col-span-1">
            <div class="flex items-center gap-2 bg-blue-500 py-2 rounded-md text-white justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>          
                <a href="{{ route('class.joinClassRoom') }}">Tìm lớp học</a>
            </div>
        </div>
    @endif

</div>