<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
   protected $fillable = [
        'user_id', 'film_id','amount','time',
    ];

 }
