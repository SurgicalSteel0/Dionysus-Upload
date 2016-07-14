<?php

namespace Dionysus;

class DionysusUpload {

    /**
     * The max number of bytes allowed.
     * 
     * @var int 
     */
    protected $maxFileSize;

    /**
     * The allowed file extensions.
     * 
     * @var array
     */
    protected $allowedFilesTypes = array();

    /**
     * The directory to upload the file to.
     * 
     * @var string
     */
    protected $uploadDirectory;

    /**
     * The file that is being uploaded.
     * 
     * @var string
     */
    protected $file;

    /**
     * Create a DionysusUpload object via the contructor.
     * 
     * @param false|array $configuration
     */
    public function __construct($configuration = false) {
        if ($configuration) {
            $this->setMaxFileSize($configuration['maxFileSize']);
            $this->setUploadDirectory($configuration['uploadDirectory']);
            $this->setFile($configuration['file']);
        }
    }

    /**
     * Uploads the file.
     * 
     */
    public function upload() {

        $targetFile = $this->uploadDirectory . '/' . basename($this->file['name']);
        $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);

        // Check file size
        if ($file['size'] > $this->maxFileSize) {
            array_push($this->errors, "Your file is too big.");
        }

        // Check file format
        if (!in_array($fileType, $this->allowedTypes)) {
            array_push($this->errors, "That file type is not allowed.");
        }

        // Try to upload
        if (count($this->errors) === 0) {
            $this->successful = move_uploaded_file($file['tmp_name'], $targetFile);
            $this->uploadedFile = $this->successful ? $targetFile : '';
        }
    }

    // Getters

    public function getMaxFileSize() {
        return $this->maxFileSize;
    }

    public function getAllowedFilesTypes() {
        return $this->allowedFilesTypes;
    }

    public function getUploadDirectory() {
        return $this->uploadDirectory;
    }

    public function getFile() {
        return $this->file;
    }

    // Setters

    public function setMaxFileSize($maxFileSize) {
        $this->maxFileSize = (int) $maxFileSize;
    }

    public function setAllowedFilesTypes($allowedFilesTypes) {
        $this->allowedFilesTypes = $allowedFilesTypes;
    }

    public function setUploadDirectory($uploadDirectory) {
        $this->uploadDirectory = (string) $uploadDirectory;
    }

    public function setFile($file) {
        $this->file = (string) $file;
    }

}
