<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the singleton instance of Setting.
     */
    public static function instance(): self
    {
        return static::firstOrCreate([], [
            'company_name' => 'Adron Trading PLC',
            'short_name' => 'Adron',
            'tagline' => 'Design. Source. Deliver.',
        ]);
    }
}
