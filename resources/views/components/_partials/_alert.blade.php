@if(session()->has('info'))
    <div class="alert alert-info mb-3">
        <i class="fa fa-info-circle m-r-10"></i> {{ session()->get('info') }}
    </div>
@endif

@if(session()->has('warning'))
    <div class="alert alert-warning mb-3">
        <i class="fa fa-warning m-r-10"></i> {{ session()->get('warning') }}
    </div>
@endif

@if(session()->has('danger'))
    <div class="alert alert-danger">
        <i class="fa fa-exclamation-circle m-r-10"></i> {{ session()->get('danger') }}
    </div>
@endif

@if(session()->has('success'))
    <div class="alert alert-success mb-3">
        <i class="fa fa-check-circle m-r-10"></i> {{ session()->get('success') }}
    </div>
@endif

@if($errors->any())
    <div class="list-group list-group-flush mb-3">
        @foreach($errors->all() as $error)
            <div class="list-group-item list-group-item-danger"><i class="fa fa-info-circle m-r-10"></i> {{ $error }}</div>
        @endforeach
    </div>
@endif