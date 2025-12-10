@if(!empty(session('success')))
    <div class="alert alert-success">
        <i class="bi bi-check2-circle"></i> {{ session('success') }}
    </div>
@endif
@if(!empty(session('error')))
    <div class="alert alert-danger">
        <i class="bi bi-x-square"></i> {{ session('error') }}
    </div>
@endif
@if(!empty(session('warning')))
    <div class="alert alert-warning">
        <i class="bi bi-exclamation-diamond"></i> {{ session('warning') }}
    </div>
@endif
