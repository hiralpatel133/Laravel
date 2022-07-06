@auth
<div class="mb-2 mt-2">
    <form method="POST" action="/post/comment/{{$post->id}}">
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