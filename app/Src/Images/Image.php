<?php

namespace App\Src\Images;

use App\Src\Images\Exception\PathException;
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
     * @var UploadImages|null $upload
     */
    private $upload_contract = null;
    /**
     * @var RemoveImage $remove
     */
    private $remove_contract;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->setPath()->setWidths()->setCurrentImage();
        $this->remove_contract = new RemoveImage($this->path);
    }

    /**
     * Setting Path Directory
     *
     * @return $this
     */
    private function setPath()
    {
        if ($this->request->has('path')) {
            $this->path = $this->request->get('path');
        }
        return $this;
    }

    /**
     * Setting the thumbs widths array
     *
     * @return $this
     */
    private function setWidths()
    {
        if ($this->request->has('widths')) {
            $this->widths = $this->request->get('widths');
        }
        return $this;

    }


    /**
     * Setting the current image if exists
     *
     * @return void
     */
    private function setCurrentImage()
    {
        if ($this->request->has('current')) {
            $this->current_img = $this->request->get('current');
        }

    }

    /**
     * Uploading new image and deleting the current image
     *
     * @param array $data
     * @param string $key
     * @throws PathException
     * @return void
     */

    public function upload(array &$data, $key = 'img')
    {
        if ($this->request->hasFile('img')) {
            $this->upload_contract = new UploadImages($this->request->file('img'), $this->path, $this->widths);
            $data[$key] = $this->upload_contract->upload();
            $this->deleteCurrentImage();
        }


    }

    /**
     * Deleting current image
     *
     */
    private function deleteCurrentImage()
    {
        if (!is_null($this->current_img)) {
            $this->remove_contract->remove($this->current_img);
        }
    }

    /**
     * Rolling back the uploaded image
     *
     */
    public function rollback()
    {
        if (!is_null($this->upload_contract)) {
            $this->remove_contract->remove($this->upload->getCurrentImage());
        }
    }

    /**
     * Removing image
     *
     * @param $img
     */
    public function remove($img)
    {
        $this->remove_contract->remove($img);
    }


}