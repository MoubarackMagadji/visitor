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
	
</style>

</head>
<body class="p-3">
    <header>
        <div id='head'>
            {{-- <span><i id='shrink' style='font-size: 23px;margin-right:10px;' class='fa fa-bars'></i><a id='hIndex' href='{{ route('dashboard')}}'>Ticketing Tool - Employee </a></span> 
                <div>
                    <span id='a'></span>:
                    <span id='b'></span>:
                    <span id='c'></span>
                </div>
            <div id="headProf">
                <img id='headPic' src="../images/Person.png">
                
                <span>
                    {{ Auth::user()->name }} 
                </span>

                <span id='editSpan'><a href='profile.php'><i class='fa fa-gear fa-spin'></i> Edit</a></span>
            </div> --}}
        </div>
        
        <nav>
            {{-- <a href='dashboard.php'><i class='fa fa-home'></i><span> Dashboard</span></a>
            <a href='outTickets.php'><i class='fa fa-ticket'></i> Out <span>  Tickets</span></a>
            <a href='inTickets.php'><i class='fa fa-ticket'></i> In <span>  Tickets</span></a>
            <a href='profile.php'><i class='fa fa-user-circle'></i><span>  Profile</span></a> --}}
            

            <a href='{{ route('dashboard')}}'><i class='fa fa-home'></i><span> Dashboard</span></a>
            <a href='{{ route('depts')}}'> <span> Depts </span></a>
            {{-- <a href='{{ route('tickets')}}'><i class='fa fa-ticket'></i> Tickets</span></a>
            <a href='{{ route('users')}}'><i class='fa fa-ticket'></i> Users</span></a>
            <a href='{{ route('depts')}}'><i class='fa fa-ticket'></i> Depts</span></a>
            <a href='{{ route('status')}}'><i class='fa fa-ticket'></i> Status</span></a>
            <a href='{{ route('priorities')}}'><i class='fa fa-ticket'></i> Priorities</span></a>
            <a href='{{ route('categories')}}'><i class='fa fa-ticket'></i> Categories</span></a>
            <a href='{{ route('subcategories')}}'><i class='fa fa-ticket'></i> Subcategories</span></a> --}}

            {{-- <form method="post" action='{{ route('logout')}}'>
                @csrf
                <input type="submit" class='btn btn-danger text-start w-100'  value='Logout'>
            </form> --}}
            {{-- <a href='postfolder/logout.php'><i class='fa fa-sign-out'></i><span>  Log out</span></a> --}}
        </nav>
    </header>

<section>
    <div id='content'>
        
        {{-- @if (session()->has('success'))
            <p class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }} 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </p>
        @endif

        @if (session()->has('error'))
            <p class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }} 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </p>
        @endif --}}

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