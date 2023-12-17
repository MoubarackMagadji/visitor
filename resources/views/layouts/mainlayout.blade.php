<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href=" {{ asset('css/bootstrap-5.3.1.css')}}"> 
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link href="{{asset('css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" >
    {{-- <link id="bs-css" href="{{ asset('css/jqD.css') }}" rel="stylesheet"> --}}
    @yield('css')
    @yield('csscode')
	<meta charset='utf-8'>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>Visitors | @yield('title')</title>
<style>
	#formFeedback{
        display: none;
    }
</style>

</head>
<body class="p-3">
    <header>
        
        <nav>
            

            <a href='{{ route('dashboard')}}'><i class='fa fa-home'></i><span> Dashboard</span></a>
            <a href='{{ route('depts')}}'> <span> Depts </span></a>
            <a href='{{ route('employees')}}'> <span> Employees </span></a>
            

        @yield('content')
    </div>
</section>
	
<?php /* include('footer.php'); */ ?>
	<script src='{{ asset('js/jq.js') }}'></script>
    <script src=' {{ asset('js/bootstrap-5.3.1.js') }}'> </script>
    {{-- <script src=" {{ asset('js/jqD.js') }}"></script> --}}
    @yield('js')
    @yield('script')
	<script>
		
	</script>
</body>
</html>