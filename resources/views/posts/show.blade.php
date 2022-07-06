@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>
            {{ $post->title }}
        </h1>
        <p>Add {{$post->created_at->diffForHumans()}} By {{$post->user->name}}</p>
        <p>{{ $post->content }}</p>

        @if(isset($post->image->image))
        <img src="{{asset('storage/'.$post->image->image)}}"/>
        @endif

        
    </div>
</br>
    Comments : 

    @include('comments._form')

    @foreach($post->comment as $comment)
    <p>{{$comment->comment}}<p>
    Add {{$comment->created_at->diffForHumans()}} By {{$comment->user->name}}
    @endforeach
@endsection('content')