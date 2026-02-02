<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;


class Branch extends Model
{
    protected $fillable = [
        'name',
        'location',
        'mobile',
        'email',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    
}

    

    
