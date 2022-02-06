
<!--=================================
 jquery -->

<!-- jquery -->
<script src="{{asset('dashboard/assets/')}}/js/jquery-3.3.1.min.js"></script>

<!-- plugins-jquery -->
<script src="{{asset('dashboard/assets/')}}/js/plugins-jquery.js"></script>

<!-- plugin_path -->
<script>var plugin_path = 'js/';</script>

<!-- chart -->
<script src="{{asset('dashboard/assets/')}}/js/chart-init.js"></script>

<!-- calendar -->
<script src="{{asset('dashboard/assets/')}}/js/calendar.init.js"></script>

<!-- charts sparkline -->
<script src="{{asset('dashboard/assets/')}}/js/sparkline.init.js"></script>

<!-- charts morris -->
<script src="{{asset('dashboard/assets/')}}/js/morris.init.js"></script>

<!-- datepicker -->
<script src="{{asset('dashboard/assets/')}}/js/datepicker.js"></script>

<!-- sweetalert2 -->
<script src="{{asset('dashboard/assets/')}}/js/sweetalert2.js"></script>

<!-- toastr -->
<script src="{{asset('dashboard/assets/')}}/js/toastr.js"></script>

<!-- validation -->
<script src="{{asset('dashboard/assets/')}}/js/validation.js"></script>

<!-- lobilist -->
<script src="{{asset('dashboard/assets/')}}/js/lobilist.js"></script>

<!-- custom -->
<script src="{{asset('dashboard/assets/')}}/js/nicescroll/jquery.nicescroll.js"></script>
<script src="{{asset('dashboard/assets/')}}/js/custom.js"></script>
<script src="{{asset('dashboard/assets/js/bootstrap-datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard/assets/js/bootstrap-datatables/dataTables.bootstrap4.min.js')}}"></script>
<script>

    $(document).ajaxComplete(function (){
        $('#summernote').summernote({
            height: 100,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true                  // set focus to editable area after initializing summernote
        });
    })
</script>
