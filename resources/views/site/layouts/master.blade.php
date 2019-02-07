<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NOREMON|</title>
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
    <link href="{{asset('public/static/css/frontend/style.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{asset('public/static/js/jquery.min.js') }}"></script>
    <!-- sidenav mobile -->
    <link rel="stylesheet" href="{{asset('public/static/css/frontend/sidenav.css') }}" type="text/css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/icon?family=Material+Icons' type='text/css'>
    <link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel="stylesheet" type="text/css">
    <script src="{{asset('public/static/js/frontend/sidenav.min.js') }}"></script>
    <!-- /sidenav mobile -->
    <script src="{{asset('public/static/js/function.js') }}"></script>

    <script>var BASE_URL = "{{url('/')}}/"</script>
    <script>var CURRENT_PATH = "{{url('/')}}/"</script>
    @stack('css')
</head>
<body>

		@include('site.block.header')

	        @yield('content')
	    
	    <!-- END content-page -->
	    @include('site.block.footer')

    <script src="{{asset('public/static/js/bootstrap.min.js') }}"></script>
    
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