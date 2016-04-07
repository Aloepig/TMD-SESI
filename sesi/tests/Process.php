<?php

/**
 * Created by PhpStorm.
 * User: TMD-IT-Aloepig
 * Date: 2016-04-07
 * Time: 오전 11:59
 */
class Process{
    private $uploadDirName;
    private $fileLocation;
    private $file;

    public function __construct($uploadDirName){
        $this->uploadDirName = $uploadDirName;
        $this->makeUploadDir();
    }

    public function isUploadDir(){
        return file_exists($this->uploadDirName);
    }

    public function makeUploadDir(){
        if(!$this->isUploadDir()) {
            mkdir($this->uploadDirName);
        }
    }

    // get
    public function getFile(){
        return $this->file;
    }

    public function getUploadDirName(){
        return $this->uploadDirName;
    }

    // 파일 복사 위치
    public function setFileLocation($fileName){
        $this->fileLocation = $this->uploadDirName."/".basename($fileName);
    }
    // 파일 복사
    public function fileCopy(){
        $this->setFileLocation($_FILES["file"]["name"]);
        return move_uploaded_file($this->fileLocation);
    }

    // 파일 읽기
    public function readUploadFile(){
        $this->file = fopen($this->fileLocation,"r");
    }



}