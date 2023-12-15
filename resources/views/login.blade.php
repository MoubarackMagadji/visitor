<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href=" {{ asset('css/bootstrap-5.3.1.css')}}"> 
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    
	<meta charset='utf-8'>
	<title>Visitors | login</title>
<style>
	
</style>

</head>
<body>
<section>
    <div>
        <form action="{{ route('login')}}"  method='post' class="w-50 mt-5 bg-light p-4 mx-auto">
            
            @csrf
            @method('POST')
            <div class="mb-4">
                <label for="" class="mb-1 fw-bold">Username <span class="text-danger">*</span></label>
                <input type="text" name="username" placeholder="Username" class="form-control" value={{ old('username') }}>

                @error('username')
                    <span class="text-danger">{{ $message }}</span>
                @endError
            </div>
            <div class="mb-4">
                <label for="" class="mb-1 fw-bold">Password <span class="text-danger">*</span></label>
                <input type="password" name="password" placeholder="**********" class="form-control">
            </div>

            <div class="mt-5">
                <input type="submit" class="btn btn-primary d-block btn-sm mx-auto w-25" value="Login">
            </div>

        </form>
    </div>
</section>
	
<?php /* include('footer.php'); */ ?>
	<script src='{{ asset('js/jq.js') }}'></script>
    <script src=' {{ asset('js/bootstrap-5.3.1.js') }}'> </script>
    
</body>
</html>