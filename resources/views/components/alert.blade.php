@if (session()->has('status'))
    <div class="alert alert-info" role="alert">
        <strong>info: </strong>{{ session()->get('status') }}
    </div>
@endif