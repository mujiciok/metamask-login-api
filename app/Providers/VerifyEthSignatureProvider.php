<?php

namespace App\Providers;

use App\Services\VerifyEthSignature\VerifyEthSignatureInterface;
use App\Services\VerifyEthSignature\VerifyEthSignatureService;
use Illuminate\Support\ServiceProvider;


class VerifyEthSignatureProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(VerifyEthSignatureInterface::class, VerifyEthSignatureService::class);
    }

    /**
     * @return string[]
     */
    public function provides()
    {
        return [VerifyEthSignatureInterface::class];
    }
}
