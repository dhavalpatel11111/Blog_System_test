<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostLikeDislike extends Model
{
    use HasFactory;

    protected $table ="post_like_dislike";

    protected $fillable = [
        'postid',
        'like_dislike_status',
        'userid',
    ];
}
