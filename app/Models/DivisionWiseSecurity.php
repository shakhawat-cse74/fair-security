<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DivisionWiseSecurity extends Model
{
    protected $fillable = [
        'division_name',
        'security_qty',
        'security_purpose',
        'deployment_area',
        'support_staff',
        'total_employees',
        'status',
    ];
}
