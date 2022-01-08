<?php

namespace App\Services\VerifyEthSignature;


interface VerifyEthSignatureInterface
{
    /**
     * @param SignatureData $signatureData
     * @return bool
     */
    public function verify(SignatureData $signatureData): bool;
}
