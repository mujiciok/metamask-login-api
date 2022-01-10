<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NftCollection extends ResourceCollection
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function toArray($request)
    {
        return NftResource::collection($this->collection);
    }
}
