@auth
<h5>Add comment</h5>
<form method="POST" action="{{ route('posts.comments.store',['post' => $id]) }}">
     @csrf

    <textarea class="form-control my-2" name="content" id="content" rows="3"></textarea>
    <x-errors></x-errors>
    <button class="btn btn-block btn-primary" type="submit">Add Comment</button>
</form>
@else
    <a href="" class="btn btn-success btn-sm">SingIn</a> To post a comment
@endauth