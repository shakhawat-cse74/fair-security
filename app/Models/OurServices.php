<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurServices extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'status',
    ];
}
