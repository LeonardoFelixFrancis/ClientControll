<?php

class saveFile{
    protected $file;
    protected $lastId;
    protected $filePath = [];

    public function __construct($file, $lastId)
    {
        $this->file = $file;
        $this->lastId = $lastId;
        $this->filePath = dirname(__DIR__) . "/files/";
    }

    public function saveNewFile(){
        for($i=0;$i<count($this->file['name']);$i++){
            $filename = preg_replace('/\s+/', '_', $this->file['name'][$i]);
            move_uploaded_file($this->file['tmp_name'][$i], $this->filePath.$this->lastId.'/'.$filename);
        }
    }
}