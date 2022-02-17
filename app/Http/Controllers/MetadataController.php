<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMetadataRequest;
use App\Http\Resources\MetadataResource;
use App\Models\Nft;
use App\Services\MetadataGenerator\MetadataGeneratorInterface;

class MetadataController extends Controller
{
    /**
     * @param StoreMetadataRequest $request
     * @param Nft $nft
     * @return MetadataResource
     */
    public function store(StoreMetadataRequest $request, Nft $nft)
    {
        $requestData = $request->validated();

        $metadata = $nft->metadata()->create($requestData);
        $metadata->attachAttributes($requestData['attributes']);

        return new MetadataResource($metadata);
    }

    /**
     * @param MetadataGeneratorInterface $metadataGenerator
     * @param Nft $nft
     * @return string
     */
    public function generate(MetadataGeneratorInterface $metadataGenerator, Nft $nft)
    {
        $metadataGenerator->init($nft)
            ->generate()
            ->save();

        $nft->update([
            'metadata_url' => $metadataGenerator->getUrl(),
        ]);

        return $metadataGenerator->getUrl();
    }
}
