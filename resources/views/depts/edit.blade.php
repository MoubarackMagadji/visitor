@extends('layouts.mainlayout')

@section('title')
    dept - {{ $dept->name }}
@endsection

@section('content')
    
    <h1>Edit user</h1>

    <div class='mb-3'>
        <a href=' {{ route("depts") }}'> <button class='btn btn-outline-secondary btn-sm '>Back</button></a>
    </div>

    <form id='usersEdit' class='w-50 bg-light p-4 shadow-sm rouded'>  
        @csrf
        <div class="mb-3">
            <label class='mb-2' for='name'>Name</label>
            <input type="text" id='name' name='name' class="form-control form-control-sm" value="{{$dept->name}}" >
        </div>
        
        <div class="mb-3">
            <input type="checkbox" id='d_status' name='d_status' class="form-control-checkbox" {{ ($dept->d_status) ? 'checked':'' }} >
            <label class='mb-2' for='d_status'>Active</label>
        </div>

        
        <input type="submit" value='Edit' class="mt-3 btn btn-primary btn-sm px-4">
    </form>

@endsection

@section('script')
<script>
    
    
    $('#usersEdit').submit(function(e){
        e.preventDefault();

        $('#formFeedback').hide()
        $('#formFeedbackUl').empty()
        
        data = $(this).serialize();

        
        $.ajax({
            url:'{{ route("dept.update", $dept->id) }}',
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