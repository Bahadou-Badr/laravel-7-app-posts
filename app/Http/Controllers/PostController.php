<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Image;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'all', 'archive']);
    }
    
    public function index()
    {
        $posts = Post::withCount('comments')->with(['user', 'tags'])->get();
        /*C est comme la ligne : 
        $posts = Post::withCount('comments')->with('user')->with('tags')->get();
        */
        return view('posts.index', [
            'posts' => $posts,
            
        ]);
    }

    public function archive()
    {
        $posts = Post::onlyTrashed()->withCount('comments')->get();
        return view('posts.index', [
            'posts' => $posts,
            
        ]);
    }

    public function all()
    {
        $posts = Post::withTrashed()->withCount('comments')->get();
        return view('posts.index', [
            'posts' => $posts, 
            

















            
        ]);
    }

  

    public function show($id)
    {
        return view('posts.show', [
            'post' => Post::with(['comments', 'tags','comments.user'])->findOrFail($id)
        ]);
    }



    public function create()
    {
        return view('posts.create');
    }



    public function store(StorePost $request)
    {

        
    
        
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        $post->user_id = Auth::user()->id;
        $post->slug = Str::slug($post->title, '-');
        $post->active = false;

        $post->save();
        //upload post images 
        $hasFile = $request->hasFile('picture');
        if ($hasFile) {
            
            $path = $request->file('picture')->store('PostsUploads');
            $image = new Image(['path' => $path]);
            $post->image()->save($image);

        }

        $request->session()->flash('status','post was created');
        return redirect()->route('posts.index');
    }



    public function edit($id){
        $post = Post::findOrFail($id);

        $this->authorize("update",$post);
        
        return view('posts.edit',[
            'post'=>$post
        ]);
    }




    public function update(StorePost $request, $id){
        $post = Post::findOrFail($id);

        // if (Gate::denies('post.update',$post)) {
        //     abort(403,"You can't edit this post"); 
        // }
        $this->authorize("update",$post);  //gate and policie
        
        //upload post images 
        $hasFile = $request->hasFile('picture');
        if ($hasFile) {
            
            $path = $request->file('picture')->store('PostsUploads');
            if ($post->image) {
                Storage::delete($post->image->path);  //supression physique de fichier
                $post->image->path = $path;
                $post->image->save();
            }
            else {
                $image = new Image(['path' => $path]);
                $post->image()->save($image);
            }
            $image = new Image(['path' => $path]);
            $post->image()->save($image);

        }

        $post->title= $request->input('title');
        $post->content= $request->input('content');
        $post->slug= Str::slug($request->input('title'),'-') ;

        $post->save();

        $request->session()->flash('status','post was updated');
        return redirect()->route('posts.index');
    }





    public function destroy(Request $request,$id){
        //////////////////comme les methode de Tinker //////////////  
        $post =  Post::findOrFail($id);
        $this->authorize("delete",$post);  //gate and policie
        $post ->delete();
        //ou
        // Post::destroy($id);
        ///////////////////////////////////////////////////////////
        $request->session()->flash('status','post was delated');
        return redirect()->route('posts.index');

    }


    //////restore/////
    public function restore($id){
        
        $post = Post::onlyTrashed()->where('id',$id)->first();

        $this->authorize('restore', $post);

        $post->restore();
        return redirect()->back();
    }
    //////ForceDelete/////
    public function forcedelete($id){
        $post = Post::onlyTrashed()->where('id',$id)->first();

        $this->authorize('forceDelete', $post);

        $post->forceDelete();
        return redirect()->back();
    }

   
}
