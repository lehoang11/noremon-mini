<!DOCTYPE html>
<html class="no-js">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CMS-NOREMON| @if($title) {{$title}} @endif</title>
    <meta name="description" content="CMS-NOREMON">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('public/static/images/favicon.ico') }}">
    <!-- Bootstrap CSS -->
    <link href="{{asset('public/static/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome CSS -->
    <link href="{{asset('public/static/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="{{asset('public/static/css/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- BEGIN CSS for this page
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
    <! END CSS for this page -->
    <script src="{{asset('public/static/js/jquery.min.js') }}"></script>

    <script src="{{asset('public/static/js/function.js') }}"></script>

    <script>var BASE_URL = "{{url('/')}}/"</script>
    <script>var CURRENT_PATH = "{{url('/')}}/{{ADMIN_PATH}}"</script>
    @stack('css')

</head>

<body class="adminbody">
    <div id="main">
        @include('cms.block.header')
        @include('cms.block.menu-left')
        <div class="content-page">
            @yield('content')
        </div>
        <!-- END content-page -->
        @include('cms.block.footer')
    </div>

<script src="{{asset('public/static/js/modernizr.min.js') }}"></script>
<script src="{{asset('public/static/js/moment.min.js') }}"></script>

<script src="{{asset('public/static/js/popper.min.js') }}"></script>
<script src="{{asset('public/static/js/bootstrap.min.js') }}"></script>

 <script src="{{asset('public/static/js/detect.js') }}"></script>
<script src="{{asset('public/static/js/fastclick.js') }}"></script>
<script src="{{asset('public/static/js/jquery.blockUI.js') }}"></script>
<script src="{{asset('public/static/js/jquery.nicescroll.js') }}"></script>

<!-- App js -->
<script src="{{asset('public/static/js/pikeadmin.js') }}"></script>

<!-- BEGIN Java Script for this page 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
-->
    @stack('js')
    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
</script>
</body>
</html>
