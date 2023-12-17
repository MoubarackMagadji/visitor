@extends("layouts.mainlayout")

@section('title')
    Depts
@endsection

@section('csscode')
<style>
    
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
            <label class='mb-2' for='dept'>Department name</label>
            <input type="text" id='dept' name='name' class="form-control form-control-sm" placeholder="Ex: Audit" required>
        </div>

        <input type="submit" value='Add' class="mt-3 btn btn-primary btn-sm px-4">
    </form>

    <x-sort-select attr="visitors_data_nb"/>

    <table class="table table-striped table-bordered table-light table-hover ">
        <thead>
            <tr>
                <th>@sortablelink("id","ID")</th>
                <th>@sortablelink('name','Name')</th>
                <th>@sortablelink('d_status','Status')</th>
                <th>@sortablelink('created_at','Created date')</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($depts as $dept)
            <tr > 
                <td> {{ $dept->id }}</td>
                <td> {{ $dept->name }}</td>
                <td> {{ $dept->status }}</td>
                <td> {{ $dept->created_at->format('d/m/Y h:i') }}</td>
                <td> <button class="btn btn-primary btn-sm px-3">Edit</button> </td>
            </tr>
            @empty
                No data yet
                <tr > 
                    <td colspan="4">No depts yet</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $depts->appends(Request::except('page','nb'))->onEachSide(1)->links() }}
    
@endsection

@section('script')
<script>
    var baselink = "{{ str_replace('&amp;', '&', request()->url()."?".http_build_query(Request::except('nb'))) }}";
    $('#select').change(function(){
        location.href= baselink.replaceAll("&amp;", "&")+"&nb="+$(this).val()
    })
    
    $('#deptAdd').submit(function(e){
        e.preventDefault();

        $('#formFeedback').hide()
        $('#formFeedbackUl').empty()
        
        data = $(this).serialize();

        $.ajax({
            url:'{{ route("depts.store") }}',
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
                            $('<li>').text(error+ ": "+response[error])
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