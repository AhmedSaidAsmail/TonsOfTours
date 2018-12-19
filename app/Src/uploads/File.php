<?php

namespace Files\Upload;


use Files\Upload\Exceptions\FolderNotFoundException;
use Files\Upload\Exceptions\NotFoundException;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image as InterventionImage;

class File
{
    /**
     * @var UploadedFile $file
     */
    private $file;
    /**
     * @var string $temporaryFile
     */
    public $temporaryFile;
    /**
     * @var string $destination Image Destination Folder
     */
    private $destination;
    /**
     * @var string $name New Name for image
     */
    private $name;
    /**
     * @var array $thumbs saved thumbs
     */
    public $thumbs = [];

    /**
     * File constructor.
     * @param UploadedFile $file
     * @param string $destination Image Destination Folder
     */
    public function __construct(UploadedFile $file, $destination)
    {
        $this->file = $file;
        $this->destination = $destination;
    }

    /**
     * Moving File from Request to the Destination Folder
     *
     * @throws NotFoundException
     */
    public function upload()
    {
        $this->pathIsExist($this->destination)
            ->setName()
            ->moveFile();

    }

    /**
     * Check given directory is exists or not
     *
     * @param string $path
     * @return $this
     * @throws FolderNotFoundException
     */
    private function pathIsExist($path)
    {
        if (!is_dir($path)) {
            throw new FolderNotFoundException(sprintf('Folder:%s can\'t be found', $path));
        }
        return $this;
    }

    /**
     * Setting the new name for uploaded file
     *
     * @return $this
     */
    private function setName()
    {
        $this->name = md5(uniqid(rand(), true)) . "." . $this->file->getClientOriginalExtension();
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * Moving File from Request to the Destination Folder
     */
    private function moveFile()
    {
        $this->file->move($this->destination, $this->name);
        $this->temporaryFile = $this->destination . $this->name;

    }

    public function thumb($folder, $width)
    {
        $path = $this->destination . trim($folder, "/");
        $this->pathIsExist($path);
        $thumb = InterventionImage::make($this->temporaryFile)->resize($width, null, function ($ratio) {
            $ratio->aspectRatio();
        });
        $thumb->save($path . "/" . $this->name);
        $this->thumbs[] = $path . "/" . $this->name;

    }

}