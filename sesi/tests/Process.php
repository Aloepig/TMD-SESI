<?php

/**
 * Created by PhpStorm.
 * User: TMD-IT-Aloepig
 * Date: 2016-04-07
 * Time: 오전 11:59
 */
include_once "DataFormat.php";

class Process{

    //////// DataFormat에서 설정한 값을 읽기 위한 변수 ////
    private $uploadDirName; // 업로드 디렉토리 이름
    private $fileLocation;  // 파일 위치
    private $file;          // 파일(읽음)

    //출력
    private $returnMassage; // 출력 메시지

    //계산
    private $rowHeader;     // csv 파일 row1
    private $rowAnswer;      // csv 파일 나머지 row

    private $studentInfo = "studentInfo";
    private $studentAnswer = "studentAnswer";

   //데이터 형식 정의된 클래스
    private $dataFormat;
    private $questionBeginIndex;    // 문제 시작 인덱스
    private $questionEndIndex;      // 문제 종료 인덱스
    private $questionBeginColumn;   // 문제 시작 열 번호
    private $questionEndColumn;     // 문제 종료 열 번호
    private $questionTotalCount;    // 총 문항수
    private $answerDataRange;       // 데이터 범위 1 부터 X 까지
    
    public function __construct(){
        // 정의된 값을 세팅한다.
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
    // 파일 닫기
    private function closeUploadFile(){
        fclose($this->file);
        $this->file= null;
    }
    // 파일 닫고 파일 삭제
    private function deleteUploadFile(){
        $this->closeUploadFile();
        unlink($this->fileLocation);
    }

    // 파일 복사
    public function fileCopy(){
        $this->setFileLocation($_FILES["file"]["name"]);
        return move_uploaded_file($this->fileLocation);
    }

    // 파일 읽어 계산 준비
    // 파일 내용 검증은 불필요 하다. 무효는 무조건 0으로 처리하기 때문.
    public function scoringPrepare(){
        try{

            $this->readUploadFile();

            // 첫 row 복사
            $this->rowHeader = fgetcsv($this->file);

            // 첫 행에서 전체 문항수를 체크
            if ( count($this->rowHeader) !== ($this->questionEndColumn) ){
                $this->deleteUploadFile();
                $this->returnMassage = $this->dataFormat->getMessage("countFail");
                return false;
            }

            $rowCount = 0;

            while ( ($row = fgetcsv($this->file)) !== false ){
                // 학생 정보 저장
                $this->rowAnswer[$rowCount][$this->studentInfo] = array_slice($row, 0, $this->questionBeginIndex);
                // 답변 정보 저장
                $this->rowAnswer[$rowCount][$this->studentAnswer] = array_slice($row, $this->questionBeginIndex, $this->questionEndColumn);

                for($i = $this->questionBeginIndex; $i < $this->questionEndIndex; $i++){
                    $answerNumber = $row[$i];

                    // 벗어난 값은 0으로 처리. 묵시적으로 숫자형태가 아니거나 null 이어도 벗어난 값으로 처리된다.
                    if(! (1<= $answerNumber && $answerNumber <= $this->answerDataRange) ){
                        $this->rowAnswer[$rowCount][$this->studentAnswer][$i-$this->questionBeginIndex] = "0";
                    }
                }
                $rowCount++;
            }

            $this->closeUploadFile();
            return true;

        } catch (Exception $e){
            return false;
        }
    }

    // 점수 합산하기

    // 점수 점수계산하기

    // 파일로 만들기

    // 종료 및 화면출력

/*
    // 파일 읽고 점수계산
    // 파일 읽어 계산 준비
    public function scoringPrepare(){
       // try {
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
        //} catch (Exception $e){
//            return false;
  //      }
    }

    public function scoring(){

    }
*/
}

?>