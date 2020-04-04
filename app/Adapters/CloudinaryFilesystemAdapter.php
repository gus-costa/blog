<?php

namespace App\Adapters;

class CloudinaryFilesystemAdapter extends \Illuminate\Filesystem\FilesystemAdapter {

    public function url($path, $options = []) {
        if (is_callable([$this->driver, 'getUrl'])) {
            return $this->driver->getUrl($path, $options);
        } else {
            parent::url($path);
        }
    }

}