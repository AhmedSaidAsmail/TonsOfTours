<?php

namespace Files\Upload;


class Rollback
{
    /**
     * @var File $file
     */
    private $file;

    /**
     * Rollback constructor.
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    public function destroy()
    {
        $this->destroyFile($this->file->temporaryFile);
        array_map(function ($file) {
            $this->destroyFile($file);
        }, $this->file->thumbs);

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