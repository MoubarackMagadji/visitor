@extends('layouts.mainlayout')

@section('title')
    {{ $employee->fullname }}' visits
@endsection

@section('content')
    
    
    <x-emp-account-nav page="visits" employeeid="{{$employee->id}}" />
    <h1>Visits ({{ $visits->total() }})</h1>

    

    <x-sort-select attr="visitors_visitsemp_nb"/>

    <table class="table table-striped table-bordered table-light table-hover ">
        <thead>
            <tr>
                <th>@sortablelink("id","ID")</th>
                <th>@sortablelink('vistorname','Visitor Name')</th>
                <th>@sortablelink('nbvisitors','Nb Visitors')</th>
                <th>Phone number</th>
                <th>@sortablelink('ended','Status')</th>
                <th>@sortablelink('created_at','Created date')</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($visits as $visit)
                
                <tr>
                    <td>{{ $visit->id }}</td>
                    <td>{{ $visit->vistorname }}</td>
                    <td>{{ $visit->nbvisitors }}</td>
                    <td>{{ $visit->tel }}</td>
                    <td>
                        @if ($visit->ended)
                            <span class='fw-bold text-danger' >Ended</span>
                        @else
                            <span class='fw-bold text-success' >Open</span>
                        @endif
                    </td>
                    <td>{{ $visit->created_at->format('d/M/Y h:i') }}</td>
                    <td class='text-center'> 
                        <a href="{{route('visitView', $visit->id )}}"> <i class='bi bi-eye fs-4 me-1'></i></a> 

                        
                        
                    </td>
                </tr>
            @empty
                No data yet
                <tr > 
                    <td colspan="4">No employees yet</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $visits->appends(Request::except('page','nb'))->onEachSide(1)->links() }}

@endsection

@section('script')
<script>
    var baselink = "{{ str_replace('&amp;', '&', request()->url()."?".http_build_query(Request::except('nb'))) }}";
    $('#select').change(function(){
        location.href= baselink.replaceAll("&amp;", "&")+"&nb="+$(this).val()
    })

</script>   
@endsection