<?php

class SimpleUpload {

    private $maxFileSize = 500000;
    private $allowedTypes = array();
    private $dir;
    public $uploadedFile;
    public $successful = false;
    public $errors = array();

    public function setMaxFileSize($bytes) {
        $this->maxFileSize = (int) $bytes;
    }

    public function setAllowedTypes($allowedTypes = array()) {
        array_push($this->allowedTypes, $allowedTypes);
    }

    public function setDirectory($dir) {
        $this->dir = (string) $dir;
    }

    /**
     * Do upload.
     * 
     * @param FileObject $file
     */
    public function upload($file) {

        $targetFile = $this->dir . '/' . basename($file['name']);
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

}
