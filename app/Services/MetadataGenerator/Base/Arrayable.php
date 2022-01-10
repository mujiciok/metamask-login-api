<?php


namespace App\Services\MetadataGenerator\Base;


trait Arrayable
{
    public function toArray(): array
    {
        return json_decode(json_encode($this), true);
    }
}
