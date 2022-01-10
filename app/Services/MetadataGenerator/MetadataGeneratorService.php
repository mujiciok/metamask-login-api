<?php

namespace App\Services\MetadataGenerator;


use App\Models\Nft;
use App\Services\MetadataGenerator\Base\OpenseaMetadata;
use App\Services\MetadataGenerator\Exceptions\MissingMetadataException;
use Illuminate\Support\Facades\Storage;

class MetadataGeneratorService implements MetadataGeneratorInterface
{
    const STORAGE_FOLDER = 'metadatas';

    protected Nft $nft;

    // @TODO created abstraction for Metadata object (Opensea, Enjin, ERC721)
    protected OpenseaMetadata $metadata;

    /**
     * @param Nft $nft
     * @return MetadataGeneratorInterface
     * @throws MissingMetadataException
     */
    public function init(Nft $nft): MetadataGeneratorInterface
    {
        $this->nft = $nft;

        if (!$this->nft->metadata) {
            throw new MissingMetadataException();
        }

        return  $this;
    }

    /**
     * @return MetadataGeneratorInterface
     */
    public function generate(): MetadataGeneratorInterface
    {
        $this->metadata = new OpenseaMetadata();
        $this->metadata->fill($this->nft->metadata->toArray());

        $nftAttributes = $this->nft->metadata->attributes;
        if (!$nftAttributes->isEmpty()) {
            $this->metadata->fillAttributes($nftAttributes->toArray());
        }

        return $this;
    }

    /**
     * @return MetadataGeneratorInterface
     */
    public function save(): MetadataGeneratorInterface
    {
        Storage::disk('public')->put($this->getPath(), $this->metadata->toString());

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return Storage::disk('public')->url($this->getPath());
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return $this->metadata->toArray();
    }

    /**
     * @return string
     */
    protected function getPath(): string
    {
        return self::STORAGE_FOLDER . "/" . $this->nft->id . ".json";
    }
}
