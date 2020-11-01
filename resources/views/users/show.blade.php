@extends('layout.default')


@section('content')
<div class="card col-sm-10 offset-1">
     <div class="card-body">
             <div class="row">
    <div class="col-sm-10 offset-1 margin-tb">
        <div class="pull-left">
            <h2> Show User</h2>
        </div>

    </div>
</div>


<div class="row">
    <div class="col-sm-10 offset-1">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $user->name }}
        </div>
    </div>
    <div class="col-sm-10 offset-1">
        <div class="form-group">
            <strong>Email:</strong>
            {{ $user->email }}
        </div>
    </div>
    <div class="col-sm-10 offset-1">
        <div class="form-group">
            <strong>Roles:</strong>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <label class="badge badge-success">{{ $v }}</label>
                @endforeach
            @endif
        </div>
    </div>
</div>
</div>
</div>

@endsection
