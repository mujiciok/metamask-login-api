<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MetadataAttribute extends Model
{
    use HasFactory;

    const TYPE_STRING = 1;
    const TYPE_NUMERIC = 2;
    const TYPE_DATE = 3;

    const DISPLAY_TYPE_NUMBER = 'number';
    const DISPLAY_TYPE_BOOST_NUMBER = 'boost_number';
    const DISPLAY_TYPE_BOOST_PERCENTAGE = 'boost_percentage';
    const DISPLAY_TYPE_DATE = 'date';

    protected $fillable = [
        'metadata_id',
        'type',
        'trait_type',
        'value',
        'display_type',
    ];

    /**
     * @return BelongsTo
     */
    public function metadata(): BelongsTo
    {
        return $this->belongsTo(Metadata::class, 'metadata_id', 'id');
    }

    public static function getNumericDisplayTypes(): array
    {
        return [
            self::DISPLAY_TYPE_NUMBER,
            self::DISPLAY_TYPE_BOOST_NUMBER,
            self::DISPLAY_TYPE_BOOST_PERCENTAGE,
        ];
    }

    public static function getDateDisplayTypes(): array
    {
        return [
            self::DISPLAY_TYPE_DATE,
        ];
    }
}
