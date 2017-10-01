@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          @if (Session::has('message'))
          <div class="alert alert-success">{{ Session::get('message') }}</div>
          @endif
            <div class="panel panel-default">
                <div class="panel-heading"><b>Author: </b>{{ $post->user->first_name}} {{ $post->user->last_name}}</div>
                <div class="panel-body">
                  {{ $post->body }}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Comments</div>
                <div class="panel-body">
                  <table class="table table-hover">
                    <tr>
                      <th>Author</th>
                      <th>Comment</th>
                      <th>Action</th>
                    </tr>
                    @foreach($comments as $comment)
                      <tr>
                        <td>{{ $comment->user->first_name}} {{ $comment->user->last_name }}</td>
                        <td>{{ $comment->body }}</td>
                        <td>
                          {!! Form::open(array('route'=> ['comments.destroy', $post->id, $comment->id], 'method' => 'DELETE')) !!}
                            @if ($comment->user_id == Auth::user()->id )
                              {{ link_to_route('comments.edit', 'Edit', [$post->id, $comment->id], ['class' => 'btn btn-primary btn-sm']) }}
                              {!! Form::button('Delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) !!}
                            @endif
                          {!! Form::close() !!}
                        </td>
                      </tr>
                    @endforeach
                  </table>
                </div>
            </div>
            {{ link_to_route('comments.create', 'Add your comment', [$post->id], ['class' => 'btn btn-primary']) }}
        </div>
    </div>
</div>
@endsection
