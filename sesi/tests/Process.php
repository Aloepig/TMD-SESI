<?php

/**
 * Created by PhpStorm.
 * User: TMD-IT-Aloepig
 * Date: 2016-04-07
 * Time: 오전 11:59
 */
include_once "DataFormat.php";

class Process{
    private $uploadDirName; // 업로드 디렉토리 이름
    private $fileLocation;  // 파일 위치
    private $file;          // 파일(읽음)

    //출력
    private $returnMassage; // 출력 메시지

    //계산
    private $rowHeader;     // csv 파일 row1
    private $rowAnswer;      // csv 파일 나머지 row

    //데이터 형식 정의된 클래스
    private $dataFormat;
    private $questionBeginIndex;    // 문제 시작 인덱스
    private $questionEndIndex;      // 문제 종료 인덱스
    private $questionBeginColumn;   // 문제 시작 열 번호
    private $questionEndColumn;     // 문제 종료 열 번호
    private $questionTotalCount;    // 총 문항수
    private $answerDataRange;       // 데이터 범위 1 부터 X 까지
    
    public function __construct(){
        $this->dataFormat = new DataFormat();
        $this->uploadDirName = $this->dataFormat->getUploadDirName();
        $this->questionBeginColumn = $this->dataFormat->getDataFormat("questionBeginColumn"); // 엑셀 열 번호
        $this->questionEndColumn = $this->dataFormat->getDataFormat("questionEndColumn"); // 엑셀 열 번호
        $this->questionBeginIndex = $this->questionBeginColumn -1;  // 배열 인덱스
        $this->questionEndIndex = $this->questionEndColumn -1; // 배열 인덱스
        $this->questionTotalCount = $this->questionEndColumn - $this->questionBeginColumn;
        $this->answerDataRange = $this->dataFormat->getDataFormat("answerDataRange"); // 데이터 범위 1 부터 X 까지
        
        if($this->makeUploadDir()){
            $this->returnMassage = $this->dataFormat->getMessage("success");
        } else {
            $this->returnMassage = $this->dataFormat->getMessage("uploadFail");
        }
    }

    public function makeUploadDir(){
        if(! file_exists($this->uploadDirName) ) {
            mkdir($this->uploadDirName);
            return true;
        } else {
            return false;
        }
    }

    ////////// get //////////
    public function getFile(){
        return $this->file;
    }
    public function getUploadDirName(){
        return $this->uploadDirName;
    }

    ////////// set //////////
    // 파일 복사 위치
    public function setFileLocation($fileName){
        $this->fileLocation = $this->uploadDirName."/".basename($fileName);
    }

    // 파일 읽기
    private function readUploadFile(){
        $this->file = fopen($this->fileLocation,"r");
    }

    // 파일 닫고 파일 삭제
    private function deleteUploadFile(){
        fclose($this->file);
        unlink($this->fileLocation);
    }

    // 파일 복사
    public function fileCopy(){
        $this->setFileLocation($_FILES["file"]["name"]);
        return move_uploaded_file($this->fileLocation);
    }

    // 파일 내용 검증
    public function isFileDataFormat(){
        $this->readUploadFile();

        // 첫 행은 그냥 통과
        fgetcsv($this->file);

        while ( ($row = fgetcsv($this->file)) !== false ){

            if ( count($row) !== ($this->questionEndColumn) ){
                $this->deleteUploadFile();
                $this->returnMassage = $this->dataFormat->getMessage("countFail");
                return false;
            }

            for($i = $this->questionBeginIndex; $i < $this->questionEndIndex; $i++){
                $answer = $row[$i];

                if(! (1<= $answer && $answer <= $this->answerDataRange) ){
                    $answer = $answer;
                    $this->deleteUploadFile();
                    $this->returnMassage = $this->dataFormat->getMessage("formatFail");
                    return false;
                }
            }
        }
        fclose($this->file);
        return true;
    }

    // 파일 읽고 점수계산
    // 파일 읽어 계산 준비
    public function scoringPrepare(){
        try {
            $this->readUploadFile();
            $rowCount = 0;

            // 첫 row 추출
            $this->rowHeader = fgetcsv($this->file);

            while ( ($row = fgetcsv($this->file)) !== false ){
                // 학생 정보 저장
                $this->rowAnswer[$rowCount]["studentInfo"] = array_slice($row, 0, $this->questionBeginColumn);
                // 답변 정보 저장
                $this->rowAnswer[$rowCount]["studentAnswer"] = array_slice($row, $this->questionBeginColumn, $this->questionEndColumn);
            }
            fclose($this->file);
            return true;
        } catch (Exception $e){
            return false;
        }
    }

    public function scoring(){

    }
}

?>