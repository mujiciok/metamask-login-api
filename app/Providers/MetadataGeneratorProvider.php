<?php

namespace App\Providers;

use App\Services\MetadataGenerator\MetadataGeneratorInterface;
use App\Services\MetadataGenerator\MetadataGeneratorService;
use Illuminate\Support\ServiceProvider;

class MetadataGeneratorProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(MetadataGeneratorInterface::class, MetadataGeneratorService::class);
    }

    /**
     * @return string[]
     */
    public function provides()
    {
        return [MetadataGeneratorInterface::class];
    }
}
