@if(session()->has('alert'))
<div class="alert alert-danger" role="alert">
    <strong>Alert!</strong> {{session()->get('alert')}}
</div>
@endif

@if(session()->has('success'))
<div class="alert alert-success" role="alert">
    <strong>Conratulation!</strong> {{session()->get('success')}}
</div>
@endif