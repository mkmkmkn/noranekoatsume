<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catimage extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'image_path','map_lat','map_lng','text','user_id'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function nices() {
        return $this->hasMany('App\Models\Nice');
    }
    
    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }
}
