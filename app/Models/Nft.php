<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Nft extends Model
{
    use HasFactory;

    protected $table = 'nfts';

    protected $fillable = [
        'user_id',
        'image_url',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function metadata(): HasOne
    {
        return $this->hasOne(Metadata::class, 'nft_id', 'id');
    }
}
