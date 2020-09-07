<?php

namespace App;

use App\Scopes\AdminShowDeleteScope;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    // public function comments(){
    //     return $this->hasMany('App\Comment')->dernier();
    // } 

    public function comments(){
        return $this->morphMany('App\Comment', 'commentable')->dernier();
    }

    // public function image(){
    //     return $this->hasOne(Image::class);
    // }
    public function image(){
        return $this->morphOne('App\Image' ,'imageable');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeMostCommented(Builder $query)
    {
        return $query->withCount('comments')->orderBy('comments_count', 'desc');///scope local
    }

   

    public static function boot(){

        static::addGlobalScope(new AdminShowDeleteScope);
        parent::boot();
        

        static::addGlobalScope(new LatestScope);

        static::deleting(function(Post $post){
            $post->comments()->delete();

        });
        static::restoring(function(Post $post){
            $post->comments()->restore();

        });
    }

    public function tags(){
        return $this->morphToMany('App\Tag','taggable')->withTimestamps();
    }
}