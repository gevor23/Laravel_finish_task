<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const COMPLETED = 'completed';
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
    ];
}
