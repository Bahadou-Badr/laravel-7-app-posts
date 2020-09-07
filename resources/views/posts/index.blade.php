@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        
        <div class="my-3">
             <h5>{{ $posts->count() }} Post(s)</h5>
        </div>
         <ul class="list-group">
             @forelse ($posts as $post)
                 <li class="list-group-item">
                     @if ($post->created_at->diffInHours() < 1)
                         <x-badge type="success"> New </x-badge>
                     @else
                        <x-badge type="dark"> Old </x-badge>
                     @endif

                    <img src="{{ Storage::url($post->image->path ?? null) }}" class="img-fluid my-3" alt="">

                     <h2>
                         <a href="{{ route('posts.show',['post'=>$post->id]) }}">
                            @if ($post->trashed())
                              <del>{{ $post->title }}</del>    
                            @else
                              {{ $post->title }}
                            @endif
                         </a>
                    </h2>
                    
                   

                    <x-tags :tags="$post->tags"></x-tags>

                     <p>{{ $post->content }}</p>
                     <em>{{ $post->created_at }}</em>
                     
                     @if ($post->comments_count)
                     <div>
                         <span class="badge badge-success">{{ $post->comments_count }} comment (s)</span> 
                     </div>
                     @else
                     <div>
                         <span class="badge badge-dark"> No comments yet!! </span> 
                     </div>
                     @endif
     
     
                     
                     <x-updeted :date="$post->updated_at" :name="$post->user->name" :userId="$post->user->id"></x-updeted>
                @auth             
                     @can('update', $post)
                     <a class="btn btn-sm btn-warning" href="{{ route('posts.edit',['post'=>$post->id]) }}">Edit</a>    
                     @endcan
     
                     @cannot('delete', $post)
                        <x-badge type="danger">You can't delete this post</x-badge>
                     @endcannot
     
                     @if(!$post->deleted_at)
     
                       @can('delete', $post)
                        <form style="display:inline" method="POST" action="{{ route('posts.destroy',['post'=>$post->id]) }}">
                            @csrf
                            @method('DELETE')
                         
                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                        </form>
                       @endcan  
     
                     @else
     
                       @can('restore', $post)
                        <form style="display:inline" method="POST" action="{{ url("/posts/$post->id/restore") }}">
                            @csrf
                            @method('PATCH')
                         
                            <input class="btn btn-sm btn-success" type="submit" value="Restore"/>
                        </form>
                       @endcan 
                       @can('forceDelete', $post)
                       <form style="display:inline" method="POST" action="{{ url('/posts/'.$post->id.'/forcedelete') }}">
                           @csrf
                           @method('DELETE')
                      
                           <input class="btn btn-sm btn-danger" type="submit" value="Force Delete !!"/>
                       </form>
                       @endcan
     
                     @endif   
                @endauth             
                 </li>
             @empty
                 <span class="badge badge-danger">Not posts</span>
             @endforelse
         </ul>
    </div>
    <div class="col-md-4 my-4">
        @include('posts.sidebar')
    </div>
</div>

@endsection