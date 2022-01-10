<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Metadata extends Model
{
    use HasFactory;

    protected $table = 'metadatas';

    protected $fillable = [
        'nft_id',
        'name',
        'image',
        'description',
        'background_color',
        'external_url',
        'animation_url',
        'youtube_url',
    ];

    /**
     * @return BelongsTo
     */
    public function nft(): BelongsTo
    {
        return $this->belongsTo(Nft::class, 'nft_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function attributes(): HasMany
    {
        return $this->hasMany(MetadataAttribute::class, 'metadata_id', 'id');
    }

    /**
     * @param array $attributes
     */
    public function attachAttributes(array $attributes)
    {
        foreach ($attributes as $key => $attribute) {
            $type = MetadataAttribute::TYPE_STRING;
            if (isset($attribute['display_type'])) {
                if (in_array($attribute['display_type'], MetadataAttribute::getNumericDisplayTypes())) {
                    $type = MetadataAttribute::TYPE_NUMERIC;
                }
                if (in_array($attribute['display_type'], MetadataAttribute::getDateDisplayTypes())) {
                    $type = MetadataAttribute::TYPE_DATE;
                }
            }
            $attributes[$key]['type'] = $type;
        }

        $this->attributes()->createMany($attributes);
    }
}
