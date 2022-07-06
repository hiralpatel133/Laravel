@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-8">
    @forelse ($posts as $post)
        <p>
            <h3>
                <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
            </h3>

            <p class="text-muted">
                Added {{ $post->created_at->diffForHumans() }}
                by <a href="/users/{{$post->user->id}}"> {{ $post->user->name }} </a>
            </p>

            @if($post->comment_count)
                <p>{{ $post->comment_count }} comments</p>
            @else
                <p>No comments yet!</p>
            @endif

            @foreach($post->tags as $tag)
            <a href="/post/tag/{{$tag->id}}"><span class="">{{$tag->name}}</span></a>
            @endforeach

            @can('update',$post)
            <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                class="btn btn-primary">
                Edit
            </a>
            @endcan

            @can('delete',$post)
            <form method="POST" class="fm-inline"
                action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                @csrf
                @method('DELETE')

                <input type="submit" value="Delete!" class="btn btn-primary"/>
            </form>
            @endcan
        </p>
    @empty
        <p>No blog posts yet!</p>
    @endforelse
    </div>
    <div class="col-sm-4">
    <div class="card" style="width: 18rem;">
        <div class="card-header">
            Most commented posts
        </div>
        <ul class="list-group list-group-flush">
            @foreach($most_commented_posts as $post)
            <a href="/posts/{{$post->id}}">
                <li class="list-group-item">{{$post->title}}</li>
            </a>
            @endforeach
        </ul>
        </div>
    </div>
</div>
@endsection('content')