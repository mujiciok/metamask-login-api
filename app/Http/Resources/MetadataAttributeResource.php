<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MetadataAttributeResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'metadata_id' => $this->metadata_id,
            'type' => $this->type,
            'trait_type' => $this->trait_type,
            'value' => $this->value,
            'display_type' => $this->display_type,
        ];
    }
}
