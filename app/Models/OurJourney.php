<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurJourney extends Model
{
    protected $fillable = [
        'title',
        'sub_title',
        'image',
        'status',
    ];
}
