<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemNotification extends Model
{
    protected $fillable = ['user_id', 'message', 'type', 'is_read', 'expires_at'];

    protected $casts = [
        'is_read' => 'boolean',
        'expires_at' => 'datetime',
    ];

    public function user(): BelongsTo { 
        return $this->belongsTo(User::class); 
    }
}
