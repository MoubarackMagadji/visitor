@extends('layouts.mainlayout')

@section('title')
    Employees
@endsection

@section('content')
    
    <div class="bg-danger p-3 rounded w-50" id="formFeedback">
        <ul id='formFeedbackUl'>
        </ul>
    </div>

    <form id='employeeAdd' class='w-50 bg-light p-4 shadow-sm rouded'>  
        @csrf
        <div class="mb-3">
            <label class='mb-2' for='emp_id'>EMP ID</label>
            <input type="text" id='emp_id' name='emp_id' class="form-control form-control-sm" >
        </div>

        <div class="mb-3">
            <label class='mb-2' for='firstname'>Firstname</label>
            <input type="text" id='firstname' name='firstname' class="form-control form-control-sm" >
        </div>

        <div class="mb-3">
            <label class='mb-2' for='employee'>Lastname</label>
            <input type="text" id='employee' name='lastname' class="form-control form-control-sm"  >
        </div>

        <div class="mb-3">
            <label class='mb-2' for='doj'>DOJ</label>
            <input type="date" id='doj' name='doj' class="form-control form-control-sm" >
        </div>

        <div class="mb-3">
            <label class='mb-2' for='dept_id'>Dept</label>
            <select class="form-select" name="dept_id" required>
                <option value="">Choose a department</option>
                @foreach($depts as $dept)
                    <option value='{{ $dept->id }}'>{{ strtoupper($dept->name) }} </option>
                @endforeach
            </select>
        </div>

        <input type="submit" value='Add' class="mt-3 btn btn-primary btn-sm px-4">
    </form>

    <table class="table table-striped table-bordered table-light table-hover ">
        <thead>
            <tr>
                <th>@sortablelink("id","ID")</th>
                <th>@sortablelink('firstname','Name')</th>
                <th>@sortablelink('dept.name','Dept')</th>
                <th>@sortablelink('e_status','Status')</th>
                <th>@sortablelink('created_at','Created date')</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
            <tr > 
                <td> {{ $employee->id }}</td>
                <td> {{ $employee->fullname }}</td>
                <td> {{ $employee->dept->name }}</td>
                <td> {{ $employee->status }}</td>
                <td> {{ $employee->created_at->format('d/m/Y h:i') }}</td>
                <td class='text-center'> <a href="{{route('employee.show', $employee->id )}}"> <i class='bi bi-eye fs-4'></i> </td>
            </tr>
            @empty
                No data yet
                <tr > 
                    <td colspan="4">No employees yet</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $employees->appends(Request::except('page','nb'))->onEachSide(1)->links() }}
@endsection

@section('script')
<script>
    // var baselink = "{{ str_replace('&amp;', '&', request()->url()."?".http_build_query(Request::except('nb'))) }}";
    // $('#select').change(function(){
    //     location.href= baselink.replaceAll("&amp;", "&")+"&nb="+$(this).val()
    // })
    
    $('#employeeAdd').submit(function(e){
        e.preventDefault();

        $('#formFeedback').hide()
        $('#formFeedbackUl').empty()
        
        data = $(this).serialize();

        // console.log(data)
        // return false;
        $.ajax({
            url:'{{ route("employees.store") }}',
            type:'post',
            data:data,
            dataType:'text',
            success: function(donne,statut, xhr){
                
                console.log(donne)

                if(donne.trim() == 'ok'){
                    alert('Entered')
                }

                if(xhr.status == 202){
                    var response = $.parseJSON(donne).errors
                    
                    for(error in response){
                        $('#formFeedbackUl').append(
                            $('<li>').text(response[error])
                        )
                    }
                    $('#formFeedback').show(100)
                }

                
            },error:function(response){
                console.log(response)
                
            }
        })
    })

</script>
@endsection