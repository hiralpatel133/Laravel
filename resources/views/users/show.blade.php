@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-4">
            @if(isset($user->image->image))
            <img src="{{asset('storage/'.$user->image->image)}}" class="img-thumbnail avatar" />
            @endif
        </div>
        <div class="col-8">
            <h3>{{ $user->name }}</h3>

            @auth
            <div class="mb-2 mt-2">
                <form method="POST" action="/users/{{$user->id}}/comments">
                    @csrf
                    
                    <div class="form-group">
                        <input type="text" name="comment" class="form-control"/>
                    </div>
                </br>
                    <button type="submit" class="btn btn-primary btn-block">Add Comment</button>
                </form>
                @include('errors.error')
            </div>
            @else
            </br>Please login to add comment
            @endauth

            @forelse($user->comment as $comment)
            <p>{{$comment->comment}}<p>
            Add {{$comment->created_at->diffForHumans()}} By {{$comment->user->name}}
            @empty
            No comments yet!
            @endforelse
            
            </div>

    </div>
@endsection