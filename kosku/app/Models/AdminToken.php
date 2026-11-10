<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminToken extends Model
{
    use HasFactory;

    protected $fillable = ['token', 'name', 'is_active', 'usage_count', 'last_used_at'];

    protected $casts = [
        'last_used_at' => 'datetime',
        'is_active' => 'boolean'
    ];

    /**
     * Cek token valid
     */
    public static function isValid($inputToken): bool
    {
        $token = self::where('token', strtoupper(trim($inputToken)))
                    ->where('is_active', true)
                    ->first();

        if ($token) {
            // Update usage
            $token->increment('usage_count');
            $token->update(['last_used_at' => now()]);
            return true;
        }

        return false;
    }
}
