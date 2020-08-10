<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class film extends Model
{
     protected $fillable = [
        'genre', 'price','title',
    ];
}
