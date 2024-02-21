@props(['page', 'employeeid'])


<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link {{ ($page == "account") ? 'active':''}}" href="{{ route('employee.show', $employeeid) }}">Account</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ ($page == "visits") ? 'active':''}}" href="{{ route('employee.visits', $employeeid) }}">Visits</a>
    </li>
    
    {{-- <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
    </li> --}}
    
</ul>

