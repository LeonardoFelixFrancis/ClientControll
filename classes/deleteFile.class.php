<?php

class deleteFile{

    private $file;
    private $filePath;
    private $id;

    public function __construct($file, $id)
    {
        $this->file = $file;
        echo $this->file;
        $this->id = $id;
        $this->filePath = dirname(__DIR__) . "/files/";
    }

    public function deleteFile(){
        $fullPath = $this->filePath.$this->id.'/'.$this->file;
        echo $fullPath;
        unlink($fullPath);
    }
}