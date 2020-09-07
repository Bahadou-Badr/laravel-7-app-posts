@extends('layouts.app')

@section('content')
<div class="row my-4">
    <div class="col-md-8">
        <h1>{{ $post->title }}</h1>
        <img src="{{ Storage::url($post->image->path ?? null) }}" class="img-fluid my-3" alt="">
        <p>{{ $post->content }}</p>
        <x-tags :tags="$post->tags"></x-tags><br>
        <em>{{ $post->created_at->diffForHumans() }}</em>

        <p>Status:
            @if ($post->active)
                Enabled
            @else
                Disabled
            @endif
        </p>
        <h2>Comments</h2>

        {{-- @include('comments.form',['id' => $post->id]) --}}
        <x-comment-form :action="route('posts.comments.store',['post' => $post->id])"></x-comment-form>
        <hr>
        <x-comment-list :comments="$post->comments"></x-comment-list>
    </div>
    <div class="col-md-4">
      @include('posts.sidebar')
    </div>
</div>

   
    
@endsection