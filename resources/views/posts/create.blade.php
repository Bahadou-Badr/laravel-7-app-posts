@extends('layouts.app')

@section('content')
<h1 class="mt-5">New Post</h1> 
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        
        @include('posts.form')
        
        <button class="btn btn-block btn-primary" type="submit">Add post</button>
    </form>
@endsection