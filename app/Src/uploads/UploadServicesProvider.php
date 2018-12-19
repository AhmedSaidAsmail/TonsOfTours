<?php

namespace Files\Upload;

use Illuminate\Support\ServiceProvider;

class UploadServicesProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('upload', function () {
            return new Upload();
        });

    }
}