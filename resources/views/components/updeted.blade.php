<div class="text-muted">
    {{ $date->diffForHumans() }}, By {!! '<a href='. route('users.show' ,['user' => $userId]) .'>' .$name .'</a>'  !!}
</div>