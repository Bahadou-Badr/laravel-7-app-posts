@forelse($comments as $comment)
    <p>{{ $comment->content }}</p>
   
    <p class="text-muted"> 
        <x-updeted :date="$comment->updated_at" :name="$comment->user->name" :user-id="$comment->user->id"></x-updeted>
    </p>
    @empty
    <div>
        <span class="badge badge-dark"> no comments yet!! </span> 
    </div>
@endforelse