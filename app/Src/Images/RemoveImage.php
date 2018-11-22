<?php

namespace App\Src\Images;


class RemoveImage
{
    const paths = ['', 'thumbMd', 'thumbSm'];
    /**
     * @var string $img Image Name
     */
    private $img;
    /**
     * @var string $path Path Folder directory
     */
    private $path;

    /**
     * @param string $path Folder path
     */
    public function __construct($path)
    {
        $this->path = public_path() . $path;
    }

    /**
     * Removing image and its thumbs
     *
     * @param $img
     */
    public function remove($img)
    {
        foreach (self::paths as $folder) {
            if ($this->checkFile($this->path, $folder, $img)) {
                $file = $this->path . $folder . "/" . $img;
                unlink($file);
            }
        }
    }

    /**
     * @param $path
     * @param $folder
     * @param $img
     * @return bool
     */
    private function checkFile($path, $folder, $img)
    {
        $file = $path . $folder . "/" . $img;
        if (file_exists($file)) {
            return true;
        }
        return false;

    }

}