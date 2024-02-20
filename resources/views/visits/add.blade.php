@extends('layouts.mainlayout')

@section('title')
    Add a visit
@endsection


@section('csscode')
<style>
    #videoDiv{
        display: none;
    }
</style>   
@endsection

@section('content')

    <a href="{{ url()->previous() }}"><button class='btn btn-outline-secondary btn-sm '>Back</button></a>

    <div class="bg-danger p-3 rounded w-50" id="formFeedback">
        <ul id='formFeedbackUl'>
        </ul>
    </div>

    <div class='my-4 ms-5'> <button  id='addPicture' class='btn btn-outline-primary btn-sm'> Add picture</button></div>

    <div id='videoDiv' class='row mt-3'>
        <div class='row'>
            <div class='col-6 text-center'>
                <video id="video" width="350" height="260" autoplay></video>
            </div>
            <div class='col-6 text-center'>
                <canvas id="canvas" width="350" height="260"></canvas>
            </div>
        </div>

        <div class='row mt-2'>
            <div class='col-6 text-center'>
                <button class='btn btn-secondary btn-sm' id="snapButton">Snap Photo</button>
                <button class='btn btn-secondary btn-sm' id="tryagain">Try again</button>
                <button class='btn btn-secondary btn-sm' id='cancelButton'>Cancel</button>
            </div>
            <div class='col-6 text-center'>
                <button class='btn btn-primary btn-sm'id="uploadButton">Upload picture</button>
            </div>
        </div>
        
    </div>
    
    <form id='visitAdd' class='w-50 bg-light p-4 shadow-sm rouded'>  
        @csrf

        <div class="mb-3">
            <label class='mb-2' for='vistorname'>Visitor name</label>
            <input type="text" id='vistorname' name='vistorname' class="form-control form-control-sm" >
        </div>

        <div class="mb-3">
            <label class='mb-2' for='nbvisitors'>Number of visitors</label>
            <input type="number" id='nbvisitors' name='nbvisitors' class="form-control form-control-sm" >
        </div>

        <div class="mb-3">
            <label class='mb-2' for='tel'>Telephone number</label>
            <input type="text" id='tel' name='tel' class="form-control form-control-sm"  >
        </div>

        <div class="mb-3">
            <label class='mb-2' for='emp_id'>Employee name</label>
            <select class="form-select" name="emp_id" required>
                <option value="">Choose a staff</option>
                @foreach($employees as $employee)
                    <option value='{{ $employee->id }}'>{{ strtoupper($employee->fullname) }} - {{ strtoupper($employee->dept->name) }} </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class='mb-2' for='tel'>Additional Note</label>
            <textarea class='form-control' rows='4' name='additionalnote'></textarea>
            
        </div>

        <input type="submit" value='Add' class="mt-3 btn btn-primary btn-sm px-4">
    </form>

    

@endsection


@section('script')
<script>
    
    $('#addPicture, #editPicture, #tryagain').click( async function(){
        $('#tryagain').hide()
        $('#snapButton').show()
        stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
        video.srcObject = stream;
        $('#videoDiv').show('200')
    })

    $('#snapButton').click(function(){
			canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
		   	let image_data_url = canvas.toDataURL('image/jpeg');
		   	stream.getTracks().forEach(track => track.stop())
		   	$('#snapButton').hide()
		   	$('#tryagain').show(100)
		})

		$('#cancelButton').click(function(){
			stream.getTracks().forEach(track => track.stop())
			$('#videoDiv').hide('200')
		})
    
    $('#visitAdd').submit(function(e){
        e.preventDefault();

        $('#formFeedback').hide()
        $('#formFeedbackUl').empty()
        
        
        image_base64  = canvas.toDataURL('image/jpeg').replace(/^data:image\/jpeg;base64,/, "");
        data = $(this).serialize()+ '&image=' + image_base64;
        

        $.ajax({
            url:'{{ route("addVisitPost") }}',
            type:'post',
            data:data,
            dataType:'text',
            success: function(donne,statut, xhr){
                
                console.log(donne)

                if(donne.trim() == 'ok'){
                    alert('Entered')
                }

                if(xhr.status == 202){

                    console.log(response)

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