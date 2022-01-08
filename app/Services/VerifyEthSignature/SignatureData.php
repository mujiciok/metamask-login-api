<?php

namespace App\Services\VerifyEthSignature;

class SignatureData
{
    public function __construct(
        public string $message = '',
        public string $signature = '',
        public string $address =  '0x00',
    ) {}
}
