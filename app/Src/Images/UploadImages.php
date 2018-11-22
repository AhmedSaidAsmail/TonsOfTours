<?php

namespace App\Src\Images;

use App\Src\Images\Exception\PathException;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image as InterventionImage;

class UploadImages
{
    const paths = ['', 'thumbMd', 'thumbSm'];
    /**
     * @var UploadedFile $img Uploaded File
     */
    private $img;
    /**
     * @var string $path Storing Folder Path
     */
    private $path;
    /**
     * @var array $widths Thumbs withs
     */
    private $widths;
    /**
     * @var string $name Uploaded image name
     */
    private $name;

    /**
     * @param UploadedFile $img
     * @param $path
     * @param array $widths
     */

    public function __construct(UploadedFile $img, $path, array $widths)
    {
        $this->img = $img;
        $this->path = public_path() . $path;
        $this->widths = $widths;

    }
    /**
     * @return mixed
     * @throws PathException
     */

    public function upload()
    {
        $this->checkPath($this->path);
        $this->exec();
        return $this->name;

    }

    public function getCurrentImage()
    {
        return $this->name;
    }

    private function exec()
    {
        $this->setName($this->img)
            ->saveThumb($this->img)
            ->saveImage($this->img);
    }

    /**
     * @param  $path
     * @param null $fileName
     * @return bool
     * @throws PathException
     */

    private function checkPath($path, $fileName = null)
    {
        $file = (!is_null($fileName)) ? "/" . $fileName : null;
        foreach (self::paths as $insiderPaths) {
            $dir = $path . $insiderPaths . $file;
            if (!is_dir($dir)) {
                throw new PathException(sprintf('Given path:%s is not exists', $dir));
//                mkdir($dir);
            }
        }
        return true;
    }

    /**
     * @param UploadedFile $img
     * @return $this
     */

    private function setName(UploadedFile $img)
    {
        $this->name = time() . md5(uniqid(mt_rand())) . "." . $img->getClientOriginalExtension();
        return $this;
    }

    /**
     * @param UploadedFile $img
     * @return $this
     */
    private function saveImage(UploadedFile $img)
    {
        $img->move($this->path, $this->name);
        return $this;
    }

    /**
     * @param UploadedFile $img
     * @return $this
     */

    private function saveThumb(UploadedFile $img)
    {
        foreach (self::paths as $key => $path) {
            if ($key !== 0) {
                $thumb = InterventionImage::make($img->getRealPath())->resize($this->widths[$key - 1], null, function ($ratio) {
                    $ratio->aspectRatio();
                });
                $thumb->save($this->path . $path . "/" . $this->name);
            }
        }
        return $this;
    }

}
