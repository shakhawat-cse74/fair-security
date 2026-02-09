<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'service_type',
        'message',
        'status',
    ];

    protected $casts = [
        'status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    /**
     * Get the status text
     */
    public function getStatusTextAttribute()
    {
        return $this->status ? 'Read' : 'Unread';
    }

    /**
     * Scope to get unread contacts
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 0);
    }

    /**
     * Scope to get read contacts
     */
    public function scopeRead($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope to filter by service type
     */
    public function scopeByServiceType($query, $serviceType)
    {
        return $query->where('service_type', $serviceType);
    }

    /**
     * Mark as read
     */
    public function markAsRead()
    {
        return $this->update(['status' => 1]);
    }

    /**
     * Mark as unread
     */
    public function markAsUnread()
    {
        return $this->update(['status' => 0]);
    }
}

