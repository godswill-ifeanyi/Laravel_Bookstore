<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'price',
        'pages',
        'author',
        'description',
        'image'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
