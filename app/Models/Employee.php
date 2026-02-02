<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'branch_id',
        'name',
        'employee_id',
        'photo',
        'designation',
        'email',
        'phone',
        'present_address',
        'permanent_address',
        'joining_date',
        'workplace_address',
        'shift',
        'status',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
