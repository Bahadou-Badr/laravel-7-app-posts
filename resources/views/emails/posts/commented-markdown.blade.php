@component('mail::message')
# laravel App

Some One has comment your post

[twitter account](https://twitter.com/badr_bahadou)

{{-- The body of your message. --}}

@component('mail::button', ['url' => route('posts.show' , ['post' =>$comment->commentable->id]) ])
    Read More
@endcomponent

@component('mail::button', ['url' => route('users.show' , ['user' => $comment->user->id]) ])
    {{$comment->user->name}} Profile
@endcomponent

@component('mail::panel')
    {{ $comment->content }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
