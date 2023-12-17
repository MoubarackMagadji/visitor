@props(['attr'])


@php
    $paginator = Request::get('nb') ?? Cookie::get($attr) ?? 10;
    $baseLink = str_replace('&amp;', '&', request()->url()."?".http_build_query(Request::except('nb')));
@endphp

<select id='select' class='form-select my-3' style="width: 70px">
    <option {{ $paginator == 5 ? "selected" : ""}}>5</option>
    <option {{ $paginator == 10 ? "selected" : ""}}>10</option>
    <option {{ $paginator == 20 ? "selected" : ""}}>20</option>
    <option {{ $paginator == 500 ? "selected" : ""}}>500</option>
</select>
