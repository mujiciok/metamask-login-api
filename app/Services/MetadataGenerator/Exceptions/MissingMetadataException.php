<?php

namespace App\Services\MetadataGenerator\Exceptions;

use Exception;

class MissingMetadataException extends Exception
{
    const CODE = 422;
    const MESSAGE = 'Missing metadata';

    /**
     * InvalidSettingsProvidedException constructor.
     */
    public function __construct()
    {
        parent::__construct(self::MESSAGE, self::CODE);
    }
}
