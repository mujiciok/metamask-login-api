<?php

namespace App\Http\Requests;

use App\Services\VerifyEthSignature\SignatureData;
use App\Services\VerifyEthSignature\VerifyEthSignatureInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class MetamaskLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message' => 'required|string',
            'signature' => 'required|string',
            'address' => 'required|string|size:42',
        ];
    }

    /**
     * @param Validator $validator
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function (Validator $validator) {
            $signatureData = new SignatureData(...$validator->validated());
            $verifyEthSignatureService = resolve(VerifyEthSignatureInterface::class);

            if (!$verifyEthSignatureService->verify($signatureData)) {
                $validator->errors()->add('signature', 'Invalid signature.');
            }
        });
    }
}
