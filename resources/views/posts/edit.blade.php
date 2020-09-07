@extends('layouts.app')

@section('content')
<h1 class="mt-5">Edit Post</h1> 
    <form method="POST" action="{{ route('posts.update',['post'=>$post->id]) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        
        @include('posts.form')

        <button class="btn btn-block btn-warning" type="submit">Update post</button>
    </form>
@endsection