<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    const STORAGE_FOLDER = 'files';

    protected $fillable = [
        'nft_id',
        'name',
        'size',
        'mime_type',
        'path',
    ];

    protected $appends = [
        'size_formatted',
        'url',
    ];

    /**
     * @return string
     */
    public function getSizeFormattedAttribute(): string
    {
        return formatSizeUnits($this->size);
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return $this->path ? Storage::disk('public')->url($this->path) : '';
    }

    /**
     * @return BelongsTo
     */
    public function nft(): BelongsTo
    {
        return $this->belongsTo(Nft::class, 'nft_id', 'id');
    }
}
