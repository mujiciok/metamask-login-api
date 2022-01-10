<?php


namespace App\Services\MetadataGenerator\Base;


trait Stringable
{
    public function toString(): string
    {
        return json_encode($this, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    }
}
