@extends('layouts.mainlayout')

@section('title')
    employee: {{ $employee->fullname }}
@endsection

@section('content')
    
    <x-emp-account-nav page="account" employeeid="{{$employee->id}}" />
        
    
    <div class="row p-2 border-1 bg-light mt-3">
        <div class='mb-3'>
            <a href=' {{ route("employees") }}'> <button class='btn btn-outline-secondary btn-sm '>Back</button></a>
            <a href='{{ route("employee.edit", $employee->id) }}'><button class='btn btn-outline-primary btn-sm '><i class='bi bi-pencil'></i></button></a>
        </div>
        <div class="row col-8 mb-4">
            <strong class='col-4'> Emp ID:</strong> <span class='col-4'>{{ $employee->emp_id }}</span>
        </div>
        <div class="row col-8 mb-4">
            <strong class='col-4'> Fullname:</strong> <span class='col-4'>{{ $employee->fullname }}</span>
        </div>
        <div class="row col-8 mb-4">
            <strong class='col-4'> DOJ:</strong> <span class='col-4'>{{ ($employee->doj)? $employee->doj->format('D M d, Y') : "" }}</span>
        </div>

        <div class="row col-8 mb-4">
            <strong class='col-4'> Status:</strong> <span class='col-4'>{{ $employee->status }}</span>
        </div>

        <div class="row col-8 mb-4">
            <strong class='col-4'> Department:</strong> <span class='col-4'>{{ $employee->dept->name }}</span>
        </div>

        <div class="row col-8 mb-4">
            <strong class='col-4'> Creation Date:</strong> <span class='col-4'>{{ $employee->created_at->format('D M d, Y') }}</span>
        </div>

    </div>

@endsection