@extends("layouts.mainlayout")

@section('content')
    
    <button  class='btn btn-primary btn-sm my-3'> Add a department</button>

    <form class='w-50 bg-light p-4 shadow-sm rouded'>
        <div class="mb-3">
            <label class='mb-2' for='dept'>Department anme</label>
            <input type="text" id='dept' name='dept' class="form-control form-control-sm" placeholder="Ex: Audit" required>
        </div>

        <input type="submit" value='Add' class="mt-3 btn btn-primary btn-sm px-4">
    </form>
@endsection

@section('script')
<script>
    
</script>
@endsection