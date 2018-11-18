<?php

namespace App\Src\Images;

use App\Src\Images\Exception\PathException;
use App\Src\Images\Exception\WidthException;
use Illuminate\Http\Request;

class Image
{
    /**
     * @var Request $request
     */
    public $request;
    /**
     * @var string $path Storing Folder Path
     */
    private $path = null;
    /**
     * @var array $widths Default Thumbs withs
     */
    private $widths = [700, 350];
    /**
     * @var null|string $current_img Current image name which will be replaced
     */
    private $current_img = null;
    /**
     * @var string $uploaded_img Uploading Image Name
     */
    private $uploaded_img = null;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->setPath()->setWidths()->setCurrentImage();
    }

    /**
     * Setting Path Directory
     *
     * @return $this
     */
    private function setPath()
    {
        if ($this->request->exists('path') && !is_null($this->request->get('path'))) {
            $this->path = $this->request->get('path');
            return $this;
        }
        throw new PathException('The Request path key is not exists');

    }

    /**
     * Setting the thumbs widths array
     *
     * @return $this
     */
    private function setWidths()
    {
        if ($this->request->exists('widths')) {
            $width = $this->request->get('widths');
            $this->checkWidths($width);
            $this->widths = $width;
        }
        return $this;

    }

    /**
     * Checking given widths is array and not null
     *
     * @param array $widths
     */
    private function checkWidths($widths)
    {
        if (!is_array($widths) || empty($widths)) {
            throw new WidthException('Given Request widths is not an array or empty');
        }

    }

    /**
     * Setting the current image if exists
     *
     * @return void
     */
    private function setCurrentImage()
    {
        if ($this->request->exists('current')) {
            $this->current_img = $this->request->get('current');
        }

    }

    /**
     * @param array $data
     * @throws PathException
     * @return void
     */

    public function upload(array &$data)
    {
        if ($this->request->hasFile('img')) {
            $this->uploaded_img = (new UploadImages($this->request->file('img'), $this->path, $this->widths))
                ->upload();
            $this->checkCurrent();

            $data['img'] = $this->uploaded_img;
        }


    }

    /**
     * Checking current file exists for replacing
     *
     */
    private function checkCurrent()
    {
        if (!is_null($this->current_img)) {
            $this->remove($this->current_img);
        }
    }

    /**
     * Removing Image
     *
     * @param string $img
     */
    public function remove($img)
    {
        (new RemoveImage($this->path, $img))->remove();
    }

}