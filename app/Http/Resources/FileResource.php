<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
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
            'size' => $this->size,
            'size_formatted' => $this->size_formatted,
            'mime_type' => $this->mime_type,
            'path' => $this->path,
            'url' => $this->url,
            'nft' => NftResource::make($this->whenLoaded('nft')),
        ];
    }
}
