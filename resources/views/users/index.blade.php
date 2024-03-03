@extends('layouts.mainlayout')


@section('title')
    Users
@endsection


@section('content')
    <h1>Users</h1>


    <x-sort-select attr="visitors_users_nb"/>
    
    <table class="table table-striped table-bordered table-light table-hover ">
        <thead>
            <tr>
                <th>@sortablelink("id","ID")</th>
                <th>@sortablelink('name','Name')</th>
                <th>@sortablelink('username','Username')</th>
                <th>@sortablelink('is_active','Status')</th>
                <th>@sortablelink('created_at','Created date')</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr > 
                <td> {{ $user->id }}</td>
                <td> {{ $user->name }}</td>
                <td> {{ $user->username }}</td>
                <td> {{ $user->is_active }}</td>
                <td> {{ $user->created_at->format('d/m/Y h:i') }}</td>
                <td> <a href="{{ route('user.show',$user->id) }}"><i class='bi bi-eye fs-4 me-1'></i></a></td>
            </tr>
            @empty
                No data yet
                <tr> 
                    <td colspan="4">No users yet</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $users->appends(Request::except('page','nb'))->onEachSide(1)->links() }}
@endsection


@section('script')
<script>
    var baselink = "{{ str_replace('&amp;', '&', request()->url()."?".http_build_query(Request::except('nb'))) }}";
    $('#select').change(function(){
        location.href= baselink.replaceAll("&amp;", "&")+"&nb="+$(this).val()
    })

    


</script>
@endsection