<?php

namespace Files\Upload;


use Illuminate\Http\UploadedFile;
use Closure;

class Upload
{
    /**
     * @var array $data given data
     */
    public $data;
    /**
     * @var string $destination Given Destination Folder Name
     */
    private $destination;
    /**
     * @var string $key Given key to search in given data
     */
    private $key;

    /**
     * Searching on given data for a specified key and this key must be UploadedFile
     * Moving this choosen UploadedFile to specified directory
     *
     * @param array $data
     * @param $destination
     * @param string $key
     * @return $this
     * @throws \Files\Upload\Exceptions\NotFoundException
     */
    public function upload(array $data, $destination, $key = 'img')
    {
        $this->destination = $destination;
        $this->key = $key;
        $this->data = $this->rebuildGivenData($data);
        $this->searchAndDo($this->data, function (File $file) {
            $file->upload();
        });
        return $this;
    }

    /**
     * Making thumbs of existing resource
     *
     * @param $folder
     * @param $width
     */
    public function makeThumb($folder, $width)
    {
        $this->searchAndDo($this->data, function (File $file) use ($folder, $width) {
            $file->thumb($folder, $width);
        });
    }

    /**
     * Rebuilding Given array
     *
     * @param array $data
     * @return array
     */

    private function rebuildGivenData(array $data)
    {
        $replaced = [];
        foreach ($data as $key => $val) {
            if ($val instanceof UploadedFile && $key == $this->key) {
                $replaced[$key] = new File($val, $this->destination);
            } elseif (is_array($val)) {
                $replaced [$key] = $this->rebuildGivenData($val);
            } else {
                $replaced[$key] = $val;
            }
        }
        return $replaced;
    }

    /**
     * Searching  for File object to do an action
     *
     * @param array $data
     * @param Closure $callback
     */
    private function searchAndDo(array $data, Closure $callback)
    {
        foreach ($data as $val) {
            if ($val instanceof File) {
                $callback($val);
            }
            if (is_array($val)) {
                $this->searchAndDo($val, $callback);
            }
        }
    }

    /**
     * Destroying all File Item and thumbs if exists
     *
     */

    public function rollback()
    {
        $this->searchAndDo($this->data, function (File $file) {
            (new Rollback($file))->destroy();
        });
    }

    /**
     * Destroying existing resource
     *
     * @param array $files
     * @param $directory
     * @param array $thumbsDir
     */
    public function destroy(array $files, $directory, array $thumbsDir = [])
    {
        (new DestroyFiles($files, $directory, $thumbsDir))->exec();

    }

    /**
     * Extracting File object name
     *
     * @param array $data
     * @return array
     */
    private function extractFileNames(array $data)
    {
        $return = [];
        foreach ($data as $key => $val) {
            if ($val instanceof File) {
                $return[$key] = $val->getName();
            } elseif (is_array($val)) {
                $return[$key] = $this->extractFileNames($val);
            } else {
                $return[$key] = $val;
            }
        }
        return $return;
    }

    /**
     * Converting File Object with associated name in data array
     *
     * @return array
     */

    public function toArray()
    {
        return $this->extractFileNames($this->data);
    }

}