@extends("layouts.mainlayout")

@section('csscode')
<style>
    #formFeedback{
        display: none;
    }
</style>
@endsection
@section('content')
    
    <button  class='btn btn-primary btn-sm my-3'> Add a department</button>

    <div class="bg-danger p-3 rounded w-50" id="formFeedback">
        <ul id='formFeedbackUl'>
        </ul>
    </div>

    <form id='deptAdd' class='w-50 bg-light p-4 shadow-sm rouded'>

        
        @csrf

        <div class="mb-3">
            <label class='mb-2' for='dept'>Department anme</label>
            <input type="text" id='dept' name='name' class="form-control form-control-sm" placeholder="Ex: Audit" required>
        </div>

        <input type="submit" value='Add' class="mt-3 btn btn-primary btn-sm px-4">
    </form>
@endsection

@section('script')
<script>

    $('#deptAdd').submit(function(e){
        e.preventDefault();

        data = $(this).serialize();

        
        $.ajax({
            url:'{{ route("depts.store") }}',
            type:'post',
            data:data,
            dataType:'text',
            success: function(donne,statut, xhr){
                
                if(xhr.status == 202){
                    var response = $.parseJSON(donne).errors
                    
                    
                    for(error in response){
                        $('#formFeedbackUl').append(
                            $('<li>').text(error+ ": "+response[error])
                        )
                    }
                    $('#formFeedback').slideToggle(100)
                }

                
            },error:function(response){
                console.log(response)
                
            }
        })
    })

    
</script>
@endsection