<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'comment',
        'user_id',
        'catimage_id'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function catimage() {
        return $this->belongsTo('App\Models\Catimage');
    }
}
