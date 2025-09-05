<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    public function posts() {
        return $this->belongsToMany(Post::class);
    }

    use HasFactory;
}
