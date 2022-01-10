<?php


namespace App\Services\MetadataGenerator\Base;


class OpenseaAttribute
{
    use Stringable, Arrayable;

    public string $trait_type;

    public string|int $value;

    public string $display_type;

    public function fill(array $data): self
    {
        if (isset($data['trait_type'])) {
            $this->trait_type = $data['trait_type'];
        }
        if (isset($data['value'])) {
            $this->value = isset($data['display_type']) ? (int)$data['value'] : (string)$data['value'];
        }
        if (isset($data['display_type'])) {
            $this->display_type = $data['display_type'];
        }

        return $this;
    }
}
