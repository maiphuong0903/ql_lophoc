@if (session('status'))
<script>
    $(document).ready(function() {
        toastr.warning('{{ session('status') }}', '', {
            "timeOut": 2000
        });
    });
</script>
@endif

@if (session('success'))
<script>
    $(document).ready(function() {
        toastr.success('{{ session('success') }}', '', {
            "timeOut": 2000
        });
    });
</script>
@endif

@if (session('error'))
<script>
    $(document).ready(function() {
        toastr.error('{{ session('error') }}', '', {
            "timeOut": 2000
        });
    });
</script>
@endif

