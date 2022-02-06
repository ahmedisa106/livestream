
@if(session('errors'))
    <script>
        toastr['error']('{{session('errors')->first()}}','error')
    </script>
@endif
@if(session('success'))
    <script>
        toastr['success']('{{session('success')}}','success')
    </script>
@endif
