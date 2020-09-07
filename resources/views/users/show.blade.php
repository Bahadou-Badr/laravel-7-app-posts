@extends('layouts.app')

@section('content')
<div class="row mt-4">
        <div class="col-md-4">
            <h5>Avatar</h5>
            <img src="{{ Storage::url($user->image->path ?? null) }}" alt="" class="img-thumbnail avatar">
            @can('update', $user)
                <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-info btn-sm">Edit</a>  
            @endcan
        </div>
        <div class="col-md-8">
            <h3>{{ $user->name }}</h3>
            <x-comment-form :action="route('users.comments.store',['user' => $user->id])"></x-comment-form>
            <hr>

            <x-comment-list :comments="$user->comments"></x-comment-list>
        </div>
</div>

@endsection