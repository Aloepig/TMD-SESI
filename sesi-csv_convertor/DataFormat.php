<?php

/**
 * Created by PhpStorm.
 * User: TMD-IT-Aloepig
 * Date: 2016-04-08
 * Time: 오후 1:13
 */
class DataFormat {

    private $uploadDirName = "temp_upload";

    private $massage = [
        "success" => true,
        "uploadFail"=>"파일 업로드가 실패했습니다.",
        "countFail" =>"문항 수가 부족합니다.",
        "formatFail"=>"문항 입력값이 1~5 가 아닙니다(파일 형식이 다릅니다)."
    ];

    // 컬럼 수: 1~150 (총150개)
    // 문제 컬럼: 9~150 (총142개)
    private $dataFormat = [
        "questionBeginColumn" => 9,
        "questionEndColumn" => 150,
        "answerDataRange" => 5
    ];

    public function getUploadDirName(){
        return $this->uploadDirName;
    }

    public function getMessage($select){
        return $this->massage[$select];
    }

    public function getDataFormat($select){
        return $this->dataFormat[$select];
    }

}