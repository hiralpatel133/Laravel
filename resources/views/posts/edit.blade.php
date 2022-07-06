@extends('layouts.app')

@section('content')
    <form method="POST" 
          action="{{ route('posts.update', ['post' => $post->id]) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control"
                value="{{ old('title', $post->title ?? null) }}"/>
        </div>

        <div class="form-group">
            <label>Content</label>
            <input type="text" name="content" class="form-control"
                value="{{ old('content', $post->content ?? null) }}"/>
        </div>

        <div class="form-group">
            <label>Post image</label>
            <input type="file" name="photo" class="form-control-file"/>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Update</button>
    </form>
    @include('errors.error')
@endsection