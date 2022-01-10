<?php

namespace App\Services\MetadataGenerator;


use App\Models\Nft;

interface MetadataGeneratorInterface
{
    /**
     * Initialize data for metadata generation
     *
     * @param Nft $nft
     * @return MetadataGeneratorInterface
     */
    public function init(Nft $nft): MetadataGeneratorInterface;

    /**
     * Generate a JSON metadata
     *
     * @return MetadataGeneratorInterface
     */
    public function generate(): MetadataGeneratorInterface;

    /**
     * Saves generated JSON file into local storage
     *
     * @return MetadataGeneratorInterface
     */
    public function save(): MetadataGeneratorInterface;

    /**
     * Returns local storage URL of the generated JSON file
     *
     * @return string
     */
    public function getUrl(): string;

    /**
     * Returns the content of the generated JSON file
     *
     * @return array
     */
    public function getContent(): array;
}
