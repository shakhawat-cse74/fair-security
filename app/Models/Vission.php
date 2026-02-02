<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vission extends Model
{
    protected $fillable = [
        'title',
        'sub_title',
        'image',
        'status',
    ];
}
