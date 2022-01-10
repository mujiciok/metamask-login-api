<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MetadataAttributeCollection extends ResourceCollection
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function toArray($request)
    {
        return MetadataAttributeResource::collection($this->collection);
    }
}
