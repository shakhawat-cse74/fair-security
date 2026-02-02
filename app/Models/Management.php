<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    protected $table = 'management';

    protected $fillable = [
        'branch_id',
        'name',
        'designation',
        'image',
        'email',
        'phone',
        'employee_id',
        'message',
        'joining_date',
        'status',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
