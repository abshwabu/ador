<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    use HasFactory;

    public const STATUS_NEW = 'new';
    public const STATUS_CONTACTED = 'contacted';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_ARCHIVED = 'archived';

    public const STATUSES = [
        self::STATUS_NEW => 'New Inquiry',
        self::STATUS_CONTACTED => 'Contacted Client',
        self::STATUS_IN_PROGRESS => 'Quote In Progress',
        self::STATUS_COMPLETED => 'Completed / Closed',
        self::STATUS_ARCHIVED => 'Archived',
    ];

    protected $fillable = [
        'full_name',
        'company',
        'phone',
        'email',
        'project_type',
        'message',
        'status',
        'admin_notes',
        'ip_address',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst((string) $this->status);
    }
}
