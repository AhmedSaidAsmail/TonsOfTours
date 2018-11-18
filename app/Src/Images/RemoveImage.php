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
     * @param string $img The image name
     */
    public function __construct($path, $img)
    {
        $this->img = $img;
        $this->path = public_path() . $path;
    }

    public function remove()
    {
        foreach (self::paths as $folder) {
            if ($this->checkFile($this->path, $folder, $this->img)) {
                $file = $this->path . $folder . "/" . $this->img;
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