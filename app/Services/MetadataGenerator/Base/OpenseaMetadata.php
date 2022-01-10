<?php


namespace App\Services\MetadataGenerator\Base;


class OpenseaMetadata
{
    use Stringable, Arrayable;

    public string $name;

    public string $image;

    public string $description;

    public string $background_color;

    public string $external_url;

    public string $animation_url;

    public string $youtube_url;

    /** @var OpenseaAttribute[] $attributes */
    public array $attributes;


    public function fill(array $data): self
    {
        if (isset($data['name'])) {
            $this->name = $data['name'];
        }
        if (isset($data['image'])) {
            $this->image = $data['image'];
        }
        if (isset($data['description'])) {
            $this->description = $data['description'];
        }
        if (isset($data['background_color'])) {
            $this->background_color = $data['background_color'];
        }
        if (isset($data['external_url'])) {
            $this->external_url = $data['external_url'];
        }
        if (isset($data['animation_url'])) {
            $this->animation_url = $data['animation_url'];
        }
        if (isset($data['youtube_url'])) {
            $this->youtube_url = $data['youtube_url'];
        }

        return $this;
    }

    public function fillAttributes(array $attributes)
    {
        foreach ($attributes as $attributeData) {
            $attribute = new OpenseaAttribute();
            $attribute->fill($attributeData);

            if (!empty($attribute)) {
                $this->attributes[] = $attribute;
            }
        }
    }
}
