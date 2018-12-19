<?php

namespace Files\Upload;

use Files\Upload\Exceptions\FolderNotFoundException;
use Files\Upload\Exceptions\NotFoundException;
use Files\Upload\Exceptions\NotImageException;
use Illuminate\Http\Request;

interface UploadsInterface
{
    /**
     * Uploading File to specified destination
     *
     * @param Request $request
     * @param string $destination Destination Folder
     * @param string $key specified key for image input inside request
     * @return $this
     * @throws FolderNotFoundException
     */
    public function upload(Request $request, $destination, $key = 'img');

    /**
     *Creating Thumbs of uploaded file
     * Its working just when the file uploaded is an image
     *
     * @param string $folder
     * @param int $width
     * @param null|int $height
     * @return $this
     * @throws NotImageException
     */
    public function makeThumb($folder, $width, $height = null);

    /**
     * Returning the uploaded file name
     *
     * @return string
     */

    public function getName();

    /**
     * Removing the uploaded file and it's thumbs if its an image
     *
     * @return void
     */

    public function rollback();

    /**
     * Removing Files form specified folders
     *
     * @param string $fileName
     * @param string $folder
     * @return void
     * @throws NotFoundException
     */

    public function remove($fileName, $folder);

    /**
     * Removing Files form specified folders and it's thumbs
     *
     * @param $fileName
     * @param $folder
     * @param array $thumbFolders
     * @return void
     * @throws NotFoundException
     */

    public function removeAll($fileName, $folder, array $thumbFolders);

}