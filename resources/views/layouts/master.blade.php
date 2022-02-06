<!DOCTYPE html>
<html lang="en">
<head>
   @include('includes.css')

</head>

<body>

<div class="wrapper">

    @include('includes.header')
    <!--=================================
     Main content -->

    <div class="container-fluid">
        <div class="row">
            <!-- Left Sidebar start-->
          @include('includes.aside')

            <!-- Left Sidebar End-->

            <!--=================================
           wrapper -->

            <div class="content-wrapper">
                @stack('page_title')
                @yield('content')

  @include('includes.footer')
            </div><!-- main content wrapper end-->
        </div>
    </div>
</div>

<!--=================================
 footer -->


<!--=================================
 jquery -->

@include('includes.js')
@stack('javascript')

@include('includes.toastr')
</body>
</html>
