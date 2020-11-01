@extends('layout.default')


@section('content')
<div class="card col-sm-10 offset-1">
     <div class="card-body">
<div class="row">
    <div class="col-sm-10 offset-1 margin-tb">
        <div class="pull-left">
            <h2> Show Role</h2>
        </div>
      
    </div>
</div>


<div class="row">
    <div class="col-sm-10 offset-1">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-sm-10 offset-1">
        <div class="form-group">
            <strong>Permissions:</strong>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <label>{{ $v->name }},</label>
                @endforeach
            @endif
        </div>
    </div>
</div>
</div>
</div>
@endsection
