<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'notifications';

    // Fillable properties for mass assignment
    protected $fillable = [
        'user_id',
        'user_type',
        'type',
        'item_id',
        'message',
        'admin_message',
        'is_read',
        'is_read_admin',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the user associated with the notification.
     * This can be a polymorphic relationship if 'user_type' has different models.
     */
    public function user()
    {
        return $this->morphTo(null, 'user_type', 'user_id');
    }

    /**
     * Scope for unread notifications.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', 0);
    }

    /**
     * Scope for admin unread notifications.
     */
    public function scopeAdminUnread($query)
    {
        return $query->where('is_read_admin', 0);
    }

    /**
     * Get a human-readable type for the notification.
     */
    public function getTypeLabelAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->type));
    }
}
