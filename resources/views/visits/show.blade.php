@extends('layouts.mainlayout')

@section('title')
    {{ $visit->id }}
@endsection

@section('content')
    
<div class="row p-2 border-1 bg-light mt-3">
        
        
        <div class='mb-3'>
            <a href=' {{ route("viewVisits") }}'> <button class='btn btn-outline-secondary btn-sm '>Back</button></a>
        </div>

        @if ($visit->picture)
            <div class="row col-8 mb-4">
                <strong class=''> Visitor's picture:</strong> 
                <img style='width:300px; height:300px' src='{{ asset("storage/media/".$visit->picture) }}' />
            </div>
        @endif
        
        <div class="row col-8 mb-4">
            <strong class='col-4'> Visitor's name:</strong> <span class='col-4'>{{ $visit->vistorname }}</span>
        </div>
        <div class="row col-8 mb-4">
            <strong class='col-4'> Telephone number:</strong> <span class='col-4'>{{ $visit->tel }}</span>
        </div>
        <div class="row col-8 mb-4">
            <strong class='col-4'> Nb of visitors</strong> <span class='col-4'>{{ $visit->nbvisitors }}</span>
        </div>

        <div class="row col-8 mb-4">
            <strong class='col-4'> Status:</strong>
            @if (!$visit->ended)
                <div class='col-4 d-flex '>
                    <span class='fw-bold text-success me-2' >Open</span>
                    <form class='endForm'>
                        @csrf
                        <input type="hidden" name='visitID' value="{{ $visit->id }}" >
                        <button  class='btn btn-sm btn-danger cursor-pointer endButton'>End visit</button>
                    </form>
                </div>
            @else
                <span class='col-4 d-flex text-danger fw-bold'>
                    Ended
                </span>
                
            @endif
             {{-- <span class='col-4'>{{ $visit->ended }}</span> --}}
        </div>

        <div class="row col-8 mb-4">
            <strong class='col-4'> Employee:</strong> <span class='col-4'>{{ $visit->employee->fullname }}</span>
        </div>

        <div class="row col-8 mb-4">
            <strong class='col-4'> Employee Dept:</strong> <span class='col-4'>{{ $visit->employee->dept->name }}</span>
        </div>

        <div class="row col-8 mb-4">
            <strong class='col-4'> Additional Note:</strong> <span class='col-4'>{{ $visit->additionalnote }}</span>
        </div>

        <div class="row col-8 mb-4">
            <strong class='col-4'> Ticket's creator:</strong> <span class='col-4'>{{ $visit->ticketcreator->name }}</span>
        </div>

        <div class="row col-8 mb-4">
            <strong class='col-4'> Creation Date & Time:</strong> <span class='col-4'>{{ $visit->created_at->format('D M d, Y h:i') }}</span>
        </div>

        @if ($visit->ended)

            <div class="row col-8 mb-4">
                <strong class='col-4'> Ticket's closer:</strong> <span class='col-4'>{{ $visit->ticketcloser->name }}</span>
            </div>

            <div class="row col-8 mb-4">
                <strong class='col-4'> Ended Date & Time:</strong> <span class='col-4'>{{ $visit->updated_at->format('D M d, Y h:i') }}</span>
            </div>

        @endif
        

    </div>

@endsection

@section('script')
<script>

    $('.endButton').click(function(e){
        e.preventDefault()
        var endForm = $(this).parent('.endForm')
        if(confirm('Are you sure you want to end this visit?')){

            data = endForm.serialize();
        
            $.ajax({
                url:'{{ route("visitEnd") }}',
                type:'post',
                data:data,
                dataType:'text',
                success: function(donne,statut, xhr){
                    
                    if(donne.trim() == 'ended'){
                        alert('Ended')

                        location.reload()
                    }

                },error:function(response){
                    console.log(response)
                    
                }
            })
        }
    })
    
</script>

@endsection