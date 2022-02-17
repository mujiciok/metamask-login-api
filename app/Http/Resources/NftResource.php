<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NftResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'file' => FileResource::make($this->whenLoaded('file')),
            'metadata' => MetadataResource::make($this->whenLoaded('metadata')),
        ];
    }
}
