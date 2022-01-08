<?php

namespace App\Services\VerifyEthSignature;


use Elliptic\EC;
use Illuminate\Support\Str;
use kornrunner\Keccak;
use \Exception;

class VerifyEthSignatureService implements VerifyEthSignatureInterface
{
    const ETH_SIGNED_MESSAGE_PREFIX = "\x19Ethereum Signed Message:\n";

    /**
     * @param SignatureData $signatureData
     * @return bool
     * @throws Exception
     */
    public function verify(SignatureData $signatureData): bool
    {
        $messageLength = strlen($signatureData->message);
        $hash = Keccak::hash(self::ETH_SIGNED_MESSAGE_PREFIX . $messageLength . $signatureData->message, 256);
        $sign = [
            "r" => substr($signatureData->signature, 2, 64),
            "s" => substr($signatureData->signature, 66, 64)
        ];

        $recId  = ord(hex2bin(substr($signatureData->signature, 130, 2))) - 27;

        if ($recId != ($recId & 1)) {
            return false;
        }

        $publicKey = (new EC('secp256k1'))->recoverPubKey($hash, $sign, $recId);

        return $this->pubKeyToAddress($publicKey) === Str::lower($signatureData->address);
    }

    /**
     * @param $publicKey
     * @return string
     * @throws Exception
     */
    protected function pubKeyToAddress($publicKey): string
    {
        return "0x" . substr(Keccak::hash(substr(hex2bin($publicKey->encode("hex")), 1), 256), 24);
    }
}
