<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopTopupUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'count',

    ];

    protected $casts = [
        'user_id' => 'integer',
        'count' => 'decimal:2'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
