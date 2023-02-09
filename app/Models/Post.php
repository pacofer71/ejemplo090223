<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['titulo', 'contenido', 'imagen', 'estado', 'user_id'];

    //Relacion 1:N con users
    public function user(){
        return $this->belongsTo(User::class);
    }
    //Relacion N:M con tags
    public function tags(){
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
