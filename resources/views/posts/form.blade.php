<div class="form-group">
    <label for="title">Your Title</label>
    <input class="form-control" name="title" id="title" type="text" value="{{ old('title', $post->title ?? null) }}">
</div>

<div class="form-group">
    <label for="content">Your Content</label>
    <input class="form-control" name="content" id="content" type="text" value="{{ old('content', $post->content ?? null) }}">
</div>

<div class="form-group">
    <label for="picture">Picture</label>
    <input type="file" name="picture" id="picture" class="form-control-file">
</div>

<x-errors></x-errors>