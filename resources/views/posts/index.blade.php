@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if (Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">Posts on Pluto</div>

                <div class="panel-body">
                  <table class="table table-hover">
                    <tr>
                      <th>Author</th>
                      <th>Post</th>
                      <th>Action</th>
                    </tr>
                    @foreach($posts as $post)
                      <tr>
                        <td>{{ $post->user->first_name}} {{ $post->user->last_name }}</td>
                        <td>{{ link_to_route('posts.show', $post->body, [$post->id]) }}</td>
                        <td>
                          {!! Form::open(array('route'=> ['posts.destroy', $post->id], 'method' => 'DELETE')) !!}
                            @if ($post->user_id == Auth::user()->id )
                              {{ link_to_route('posts.edit', 'Edit', [$post->id], ['class' => 'btn btn-primary btn-sm']) }}
                              {!! Form::button('Delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) !!}
                            @endif
                            {{ link_to_route('comments', 'Comments', [$post->id], ['class' => 'btn btn-success btn-sm']) }}
                          {!! Form::close() !!}
                        </td>
                      </tr>
                    @endforeach
                  </table>
                </div>
            </div>
            {{ link_to_route('posts.create', 'Add your post', null, ['class' => 'btn btn-primary']) }}
        </div>
    </div>
</div>
@endsection
