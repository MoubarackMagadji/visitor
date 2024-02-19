@extends('layouts.mainlayout')

@section('content')
    <div class='my-3'>

        <a href=' {{ url()->previous() }}'> <button class='btn btn-outline-secondary btn-sm '>Back</button></a>
        
    </div>
    
    <form action="{{route('employee.update', $employee->id)}}" method='post' id='employeeAdd' class='w-50 bg-light p-4 shadow-sm rouded'>  
        @csrf
        @method("POST")

        <div class="mb-3">
            <label class='mb-2' for='emp_id'>EMP ID</label>
            <input type="text" id='emp_id' name='emp_id' value="{{old('emp_id', $employee->emp_id)}}" disabled class="form-control form-control-sm" >
        </div>

        <div class="mb-3">
            <label class='mb-2' for='firstname'>Firstname</label>
            <input type="text" id='firstname' name='firstname' value="{{old('firstname', $employee->firstname)}}" class="form-control form-control-sm" >

            @error('firstname')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class='mb-2' for='employee'>Lastname</label>
            <input type="text" id='employee' name='lastname' value="{{old('lastname', $employee->lastname)}}" class="form-control form-control-sm"  >

            @error('lastname')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class='mb-2' for='doj'>DOJ</label>
            <input type="date" id='doj' name='doj' value="{{old('doj', $employee->doj)}}" class="form-control form-control-sm" >
        </div>

        <div class="mb-3">
            <label class='mb-2' for='dept_id'>Dept</label>
            <select class="form-select" name="dept_id" >
                <option value="">Choose a department</option>
                @foreach($depts as $dept)
                    <option value='{{ $dept->id }}' {{ $employee->dept->id == $dept->id ? 'selected' : ''}}>{{ strtoupper($dept->name) }} </option>
                @endforeach
            </select>

            @error('dept_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class='mb-2' for='e_status'>Status</label>
            <select class="form-select" name="e_status" >
                <option value='1' {{ ($employee->e_status) ? 'selected' : ''}}>Active </option>
                <option value='0' {{ (!$employee->e_status) ? 'selected' : ''}}>Inactive </option>
                
                
            </select>

            @error('dept_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <input type="submit" value='Update' class="mt-3 btn btn-primary btn-sm px-4">
    </form>


@endsection