<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUser;
use App\Image;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user'); //a la place d' utiliser '$this->authorize($user);' dans chaque methode il suffit d' utiliser 'authorizeResource'
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show' ,['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit' ,['user' => $user]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        $hasFile = $request->hasFile('avatar');
        if ($hasFile) {
            
            $path = $request->file('avatar')->store('usersUploads');
            if ($user->image) {
                Storage::delete($user->image->path);  //supression physique de fichier
                $user->image->path = $path;
                $user->image->save();
            }
            else {
                $image = new Image(['path' => $path]);
                $user->image()->save($image);
            }
            return redirect()->back()->withStatus('User Updated');

        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
