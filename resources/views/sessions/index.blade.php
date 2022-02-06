@extends('layouts.master')
@section('content')

    <div class="col-xl-12 mb-30">

       <div class="mb-5">
           <button data-ajax-popup="true" data-title="create new session" data-url="{{url('sessions/create')}}" type="button" class="btn btn-primary"> Create New Session <i class="fa fa-plus"></i> </button>

       </div>
        <div class="card card-statistics h-100">

            <div class="card-body">

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>start   at</th>
                            <th>duration</th>
                            <th>actions</th>

                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class=" modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title"><div class="mb-30">
                            <h6>EXPERTISE</h6>
                            <h2>Modal title</h2>
                            <p>We are an innovative agency. We develop and design customers around the world. Our clients are some of the most forward-looking companies in the world.</p>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                </div>

            </div>
        </div>
    </div>
@endsection
@push('javascript')

   <script>
        $('#datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('sessions.data') }}",
                "type": "GET",

            },
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'start_at', name: 'start_at'},
                {data: 'duration', name: 'duration'},
                {data: 'actions', name: 'actions'},


            ]
        });

        $(document).on('click','button[data-ajax-popup="true"]',function (e){
            e.preventDefault();
            let url = $(this).data('url'),
                title=$(this).data('title');
            $('#modal .modal-title').html(title);

            $.ajax({
                type:'get',
                url:url,
                success:function (data){
                    $('#modal .modal-body').html(data)
                }
            });
            $('#modal').modal()


        })
    </script>
@endpush
