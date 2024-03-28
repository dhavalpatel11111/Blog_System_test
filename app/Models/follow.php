<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class follow extends Model
{
    use HasFactory;

    protected $table = "follows";

    protected $fillable = [
        'userid',
        'you_foloow',
        'who_follow_you',
    ];
}
