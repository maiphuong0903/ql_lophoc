<section>
    <header>
        <h2 class="text-xl font-medium text-gray-900">Thông tin tài khoản</h2>
        <p class="mt-1 text-sm text-gray-600">Cập nhật thông tin hồ sơ và địa chỉ email của tài khoản của bạn.</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="col-span-full grid grid-cols-1 space-y-2">
            <div class="flex items-center justify-center w-full">
                <label>
                    <img id="imagePreview" class="hidden w-24 h-24 rounded-full object-cover cursor-pointer" src="" alt="Preview Image">
                    @if(auth()->user()->avatar)
                        <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="w-24 h-24 rounded-full cursor-pointer" id="avatarImg">
                    @else
                        <img src="{{ asset('images/avatar.jpg') }}" alt="" class="object-cover w-24 h-24 rounded-full cursor-pointer" id="avatarImg">
                    @endif 
                    <input type="file" class="hidden" id="fileInput" name="avatar">
                </label>
            </div>
        </div>

        <div>
            <label for="name">Tên tài khoản</label>
            <input name="name" value="{{ old('name', $user->name) }}" type="text" class="my-2 shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-300 focus:border-blue-300 block w-full p-3">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="email">Email</label>
            <input name="email" value="{{ old('email', $user->email) }}" type="text" class="my-2 shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-300 focus:border-blue-300 block w-full p-3">
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="phone">Số điện thoại</label>
            <input name="phone" value="{{ old('phone', $user->phone) }}" type="text" class="my-2 shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-300 focus:border-blue-300 block w-full p-3" placeholder="Bổ sung số điện thoại ở đây....">
            @error('phone')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="birthday">Ngày sinh</label>
            <input name="birthday" value="{{ old('birthday', $user->birthday) }}" type="date" class="my-2 shadow-sm border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-300 focus:border-blue-300 block w-full p-3">
            @error('birthday')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('CẬP NHẬT THÔNG TIN') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Lưu thành công') }}</p>
            @endif
        </div>
    </form>

</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('input[type="file"]').change(function(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var file = input.files[0];
                    if (file.type.includes('image')) {
                        var imageUrl = e.target.result; 
                        $('#imagePreview').attr('src', imageUrl);
                        $('#imagePreview').removeClass('hidden');
                        $('#avatarImg').addClass('hidden');
                    }else {
                        var otherFileName = file.name;
                        $('#imagePreview').addClass('hidden');
                        $('#imageUpload').removeClass('hidden');
                        $('#avatarImg').html('<p class="pointer-none text-gray-500"><span class="text-md">' + otherFileName + '</span></p>');
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>