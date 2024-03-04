<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}"> 
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
<body class="">

    <div id='topheader'>
        <h2>V</h2>
    </div>

    <div style='display:flex; padding-top:50px'>
        <header>
            
            <nav class='animated bounceInDown'>
                <ul>
                    <li><a href='{{ route('dashboard')}}'><i class='fa fa-home'></i><span> Dashboard</span></a></li>
                    <li><a href='{{ route('depts')}}'> <span> Depts </span></a></li>
                    <li><a href='{{ route('employees')}}'> <span> Employees </span></a></li>
                    <li class='sub-menu'>  <a href='#'>Visits <div class='fa fa-caret-down right'></div></a>
                        <ul>
                            <li><a href='{{ route('addVisit')}}'> <span> Add visit </span></a></li>
                            <li><a href='{{ route('viewVisits')}}'> <span> View visits </span></a></li>
                        </ul>
                    </li>
                    <li class='sub-menu'>  <a href='#'>Users <div class='fa fa-caret-down right'></div></a>
                        <ul>
                            <li><a href='{{ route('users')}}'> <span> View users </span></a></li>
                            <li><a href='{{ route('user.add')}}'> <span> Add user </span></a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <div style="width:100%;margin-left: 180px;padding:10px">
            @yield('content')
        </div>
    </div>

</section>
	
<?php /* include('footer.php'); */ ?>
    
	<script src='{{ asset('js/jq.js') }}'></script>
    <script src='{{ asset('js/ess.js') }}'></script>
    <script src='{{ asset('js/bootstrap.js') }}'> </script>
    <script src=" {{ asset('js/notify.min.js') }}"></script>
    @yield('js')
    @yield('script')
	
    <script>

	</script>
</body>
</html>