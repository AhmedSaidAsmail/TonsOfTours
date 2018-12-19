<?php

namespace Files\Upload;


class DestroyFiles
{
    /**
     * @var array $files
     */
    private $files;
    /**
     * @var string $directory
     */
    private $directory;
    /**
     * @var array $thumbs
     */
    private $thumbsDir;

    /**
     * DestroyFiles constructor.
     * @param array $files Requested Files to delete
     * @param string $directory Directory which files exists
     * @param array $thumbsDir Files thumbs Directory if it has
     */
    public function __construct(array $files, $directory, array $thumbsDir = [])
    {
        $this->files = $files;
        $this->directory = rtrim($directory,'/\\/');
        $this->thumbsDir = $thumbsDir;
    }

    public function exec()
    {
        $this->destroyFiles();
    }

    private function destroyFiles()
    {
        foreach ($this->files as $file) {
            $this->destroyFile($this->directory . DIRECTORY_SEPARATOR . $file);
            $this->destroyThumbs($file);
        }
    }

    private function destroyThumbs($file)
    {
        foreach ($this->thumbsDir as $dir) {
            $thumb = trim($dir, "/\\") . DIRECTORY_SEPARATOR . $file;
            $this->destroyFile($this->directory . DIRECTORY_SEPARATOR . $thumb);
        }

    }

    private function fileIsExists($file)
    {
        return file_exists($file);
    }

    private function destroyFile($file)
    {
        if ($this->fileIsExists($file)) {
            unlink($file);
        }
    }


}