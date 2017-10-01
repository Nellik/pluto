@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Update Your Post</div>

                <div class="panel-body">
                  {!! Form::model($post, array('route'=> ['posts.update', $post->id], 'method'=>'PUT')) !!}
                    <div class="form-group">
                      {!! Form::label('body', 'Enter Boby') !!}
                      {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                      {!! Form::button('Update', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                    </div>
                  {!! Form::close() !!}
                </div>
            </div>
            @if($errors->has())
              <ul class="aler alert-danger">
                @foreach ($errors->all() as $error)
                  {{ $error }}
                @endforeach
              </ul>
            @endif
        </div>
    </div>
</div>
@endsection
