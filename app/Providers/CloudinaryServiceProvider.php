<?php

namespace App\Providers;

use App\Adapters\CloudinaryFilesystemAdapter;
use Illuminate\Support\ServiceProvider;
use Enl\Flysystem\Cloudinary\ApiFacade as CloudinaryClient;
use Enl\Flysystem\Cloudinary\CloudinaryAdapter;
use Enl\Flysystem\Cloudinary\Converter\TruncateExtensionConverter;
use Enl\Flysystem\Cloudinary\Plugin\GetUrl;
use League\Flysystem\Filesystem;
use Storage;

class CloudinaryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('cloudinary', function($app, $config) {
            $client = new CloudinaryClient($config, new TruncateExtensionConverter());

            $filesystem = new Filesystem(new CloudinaryAdapter($client), ['disable_asserts' => true]);
            $filesystem->addPlugin(new GetUrl($client));

            return new CloudinaryFilesystemAdapter($filesystem);
        });
    }
}
