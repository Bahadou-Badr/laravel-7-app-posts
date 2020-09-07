<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path'];

    // public function post(){
    //     return $this->belongsTo(Post::class);
    // }
    public function imageable(){
        return $this->morphTo();
    }
}
