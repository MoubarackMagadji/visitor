@extends('layouts.mainlayout')

@section('title')
    user - {{ $user->name }}
@endsection

@section('content')
    
    <h1>Edit user</h1>

    <div class='mb-3'>
        <a href=' {{ route("users") }}'> <button class='btn btn-outline-secondary btn-sm '>Back</button></a>
    </div>

    <form id='usersEdit' class='w-50 bg-light p-4 shadow-sm rouded'>  
        @csrf
        <div class="mb-3">
            <label class='mb-2' for='name'>Name</label>
            <input type="text" id='name' name='name' class="form-control form-control-sm" value="{{$user->name}}" >
        </div>
        <div class="mb-3">
            <label class='mb-2' for='username'>Username</label>
            <input type="text" id='username' name='username' class="form-control form-control-sm"  value="{{$user->username}}" >
        </div>

        {{-- <div class="mb-3">
            <label class='mb-2' for='password'>Password</label>
            <input type="text" id='password' name='password' class="form-control form-control-sm" >
        </div>

        <div class="mb-3">
            <label class='mb-2' for='password_confirmation'>Password confirmation</label>
            <input type="text" id='password_confirmation' name='password_confirmation' class="form-control form-control-sm"  >
        </div> --}}

        <div class="mb-3">
            <input type="checkbox" id='is_admin' name='is_admin' class="form-control-checkbox" {{ ($user->admin) ? 'checked':'' }} >
            <label class='mb-2' for='is_admin'>Admin</label>
        </div>

        

        

        <input type="submit" value='Add' class="mt-3 btn btn-primary btn-sm px-4">
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
            url:'{{ route("user.update", $user->id) }}',
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