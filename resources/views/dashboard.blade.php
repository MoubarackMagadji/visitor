@extends("layouts.mainlayout")

@section('title')
    Dashboard
@endsection

@section('content')

    <h1 class="text-secondary">Tic Tac</h1>

    <form action="logout" method="post">
        @csrf
        @method("POST")
        <button class="btn btn-primary btn-sm px-3">Logout</button>
    </form>
    
@endsection