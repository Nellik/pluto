@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $post->user->first_name}} {{ $post->user->last_name}}</div>
                <div class="panel-body">
                  {{ $post->body }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
