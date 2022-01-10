<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MetadataResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nft_id' => $this->nft_id,
            'name' => $this->name,
            'image' => $this->image,
            'description' => $this->description,
            'background_color' => $this->background_color,
            'external_url' => $this->external_url,
            'animation_url' => $this->animation_url,
            'youtube_url' => $this->youtube_url,
            'attributes' => new MetadataAttributeCollection($this->attributes),
        ];
    }
}
