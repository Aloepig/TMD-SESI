<?php

/**
 * Created by PhpStorm.
 * User: TMD-IT-Aloepig
 * Date: 2016-04-07
 * Time: 오전 11:59
 */
include_once "DataFormat.php";

class Process{

    // 학생 정보와 답변
    const STUDENT_INFO = "studentInfo";
    const STUDENT_ANSWER = "studentAnswer";

    // 계산 데이터 배열
    private $rowHeader;     // csv 파일 row1
    private $rowAnswer;     // csv 파일 나머지 row
    private $students;      // 학생 수
    private $totalNumberOfTitles;

    // 파일
    private $file;          // 파일(읽음)
    private $fileName;      // 파일 이름
    private $fileLocation;  // 파일 위치

    //////// DataFormat에서 설정한 값을 읽기 위한 변수 ////
    private $dataFormat;
    private $uploadDirName;         // 업로드 디렉토리 이름
    private $questionBeginIndex;    // 문제 시작 인덱스
    private $questionEndIndex;      // 문제 종료 인덱스
    private $questionEndColumn;     // 문제 종료 CSV 열 번호
    private $answerDataRange;       // 데이터 범위 1 부터 X 까지

    public function __construct(){
        // 정의된 값을 세팅한다.
        $this->dataFormat = new DataFormat();
        $this->uploadDirName = DataFormat::UPLOAD_DIR_NAME;
        $this->questionEndColumn = DataFormat::QUESTION_END_COLUMN;
        $this->answerDataRange = DataFormat::ANSWER_DATA_RANGE;
        $this->totalNumberOfTitles = $this->dataFormat->getTotalNumberOfTitles();

        $this->questionBeginIndex = DataFormat::QUESTION_BEGIN_COLUMN -1;  // 문제시작 배열 인덱스
        $this->questionEndIndex = $this->questionEndColumn -1; // 문제종료 배열 인덱스

        $this->makeUploadDir();
    }

    // 업로드 디렉토리 없으면 폴더를 만든다.
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
    public function getRowHeader(){
        return $this->rowHeader;
    }
    public function getRowAnswer(){
        return $this->rowAnswer;
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
        $this->fileName = $_FILES["file"]["name"];
        $tmpFileName =  $_FILES["file"]["tmp_name"];
        $this->setFileLocation($this->fileName);
        return move_uploaded_file($tmpFileName, $this->fileLocation);
    }

    // 인코딩 확인
    public function detectStringEncoding($string){
        $encoding = array("UTF-8", "EUC-KR");
        foreach ($encoding as $item){
            try{
                if( iconv($item, $item, $string) != false){
                    return $item;
                }
            } catch (Exception $e){
                // php 5.6에서는 잘못된 문자열이 들어오면 false가 아닌 에러를 던짐.
            }
        }
        return DataFormat::INPUT_DEFAULT_ENCODING;
    }

    // 파일 읽어 계산 준비 - 임시파일은 읽고 나서 삭제한다.
    // 파일 내용 검증은 불필요 하다. 무효는 무조건 0으로 처리하기 때문.
    public function scoringPrepare($isDeleteCsvFile){
        try{
            $this->readUploadFile();

            // 첫 row 복사
            $this->rowHeader = fgetcsv($this->file);

            // 첫 행에서 전체 문항수를 체크
            if ( count($this->rowHeader) !== ($this->questionEndColumn) ){
                $this->deleteUploadFile();
                return false;
            }

            $rowCount = 0;

            while ( ($row = fgetcsv($this->file)) !== false ){
                // 학생 정보 저장 (원본값)
                $this->rowAnswer[$rowCount][$this::STUDENT_INFO] = array_slice($row, 0, $this->questionBeginIndex);
                // 답변 정보 저장 (원본값)
                $this->rowAnswer[$rowCount][$this::STUDENT_ANSWER] = array_slice($row, $this->questionBeginIndex, $this->questionEndColumn);

                $rowCount++;
            }

            $this->students = $rowCount;

            // 실제 동작시에는 임시 파일을 삭제하고 종료하고,
            // 테스트 할 때, 매번 삭제하면 번거롭기 때문에 false 값을 넘긴다.
            if($isDeleteCsvFile === true){
                $this->deleteUploadFile();
            } else {
                $this->closeUploadFile();
            }

            return true;

        } catch (Exception $e){
            return false;
        }
    }

    // 범위를 벗어난 값은 "0"으로 바꾸는 함수. 타입이 다르지만 숫자로 비교하는 것을 주의하자.
    private function changingValueToZeroOut($value) {
        // 벗어난 값은 0으로 처리. 묵시적으로 숫자형태가 아니거나 null 이어도 벗어난 값으로 처리된다.
        if (1 <= $value && $value <= $this->answerDataRange) {
            return $value;
        } else {
            return "0";
        }
    }

    // 역문항 처리
    private function isReverseScoring($questionNumber){
        if( array_key_exists($questionNumber, DataFormat::REVERSE_QUESTIONS) ){
            return true;
        } else {
            return false;
        }
    }

    // 점수 합산하기 - scoringPrepare() 선실행 필요.
    public function sumScoring(){
        $totalNumberOfTitles = $this->totalNumberOfTitles;

        // 학생 수 만큼 반복
        for ($n=0; $n < $this->students; $n++){

            // 출력 타이틀 만큼 반복
            for ($s=0; $s < $totalNumberOfTitles; $s++){
                $questionsInTitle = $this->dataFormat->getMatchingQuestions($s);    // 타이틀과 속한 질문
                $countQuestions = count($questionsInTitle);                         // 전체 개수
                $questionTitle = $questionsInTitle[0];                              // 배열 0번은 제목이 들어있다.
                $this->rowAnswer[$n][$questionTitle] = 0;                           // 초기화

                // 타이틀 해당 개수 만큼 반복 (1부터인 이유는 0번은 제목이기 때문)
                for ($i=1; $i < $countQuestions ; $i++){
                    $questionNumber = $questionsInTitle[$i];    // 질문번호
                    $arrayIndex = $questionNumber - 1;          // 배열 인덱스 값
                    $questionAnswer = $this->rowAnswer[$n][$this::STUDENT_ANSWER][$arrayIndex]; // 학생 응답값
                    $questionAnswer = $this->changingValueToZeroOut($questionAnswer);

                    //역문항 처리
                    if( $questionAnswer != 0 && $this->isReverseScoring($questionNumber) ){
                        $questionAnswer = $this->answerDataRange + 1 - $questionAnswer;
                    }
                    $this->rowAnswer[$n][$questionTitle] += $questionAnswer;
                }

            }

        }
    }

    // T 점수계산하기 - sumScoring() 선실행 필요.
    // 0점이면 0점
    // 결과가 -(마이너스) 이면 0
    // 결과가 +(플러스) 이면 소수점 버림
    public function tScoring(){
        $totalNumberOfTitles = $this->totalNumberOfTitles; //타이틀 수가 일치하지 않으면 예외를 던지니 걱정하지 말 것.
        $tScoring = DataFormat::T_SCORING;
        $tScoringMultiValue = DataFormat::T_SCORING_MULTI_VALUE;
        $tScoringAddValue = DataFormat::T_SCORING_ADD_VALUE;

        // 학생 수 만큼 반복
        for ($n=0; $n < $this->students; $n++) {

            // 출력 타이틀 만큼 반복
            for ($s = 0; $s < $totalNumberOfTitles; $s++) {

                $sumAnswer = &$this->rowAnswer[$n][$tScoring[$s][0]];
                $tMinus = $tScoring[$s][1];
                $tDivision = $tScoring[$s][2];

                // 0이 아닐때만 계산
                if (0 != $sumAnswer) {
                    // 두 값이 0 이면 t점수를 계산하지 않는다.
                    if (!($tMinus == 0 && $tDivision == 0)) {
                        $tScore = $tScoringMultiValue * ($sumAnswer - $tMinus) / $tDivision + $tScoringAddValue;

                        // 결과가 -(마이너스) 이면 0
                        if ($tScore < 0) {
                            $tScore = 0;
                        } else {
                            // 결과가 +(플러스) 이면 소수점 버림
                            $tScore = floor($tScore);
                        }
                        $sumAnswer = $tScore;
                    }
                }
            }
        }
    }

    // CSV 형식 String 만들기 (첫번째 row) - tScoring() 선실행 필요
    public function makeCSVStringRowHeader(){
        $csvString =  "";
        $resultHeader = array_slice($this->rowHeader, 0, $this->questionBeginIndex);
        $countResultHeader = count($resultHeader);

        for ($i = 0; $i < $countResultHeader; $i++){
            $inputEncoding = $this->detectStringEncoding($resultHeader[$i]);
            $csvString = $csvString . iconv($inputEncoding, "UTF-8", $resultHeader[$i]) . ",";
        }

        $totalNumberOfTitles = $this->totalNumberOfTitles;
        $tScoring = DataFormat::T_SCORING;
        for ($i = 0; $i < $totalNumberOfTitles; $i++){
            if(0 < $i){
                $csvString = $csvString . ",";
            }
            $csvString = $csvString . $tScoring[$i][0];
        }

        return iconv("UTF-8", DataFormat::OUTPUT_ENCODING, $csvString);
    }

    // CSV 형식 String 만들기 (rows) - tScoring() 선실행 필요
    public function makeCSVStringRow($studentNumber){
        $csvString =  "";
        $countInfoColumn = $this->questionBeginIndex;
        $totalNumberOfTitles = $this->totalNumberOfTitles;
        
        for ($i = 0; $i < $countInfoColumn; $i++){
            $studentInfo = $this->rowAnswer[$studentNumber][$this::STUDENT_INFO][$i];
            $inputEncoding = $this->detectStringEncoding($studentInfo);
            $csvString = $csvString . iconv($inputEncoding, "UTF-8", $studentInfo) . ",";
        }
        
        for ($i = 0; $i < $totalNumberOfTitles; $i++){
            if(0 < $i){
                $csvString = $csvString . ",";
            }
            $csvString = $csvString . $this->rowAnswer[$studentNumber][$this->dataFormat->getMatchingQuestions($i)[0]];
        }
        
        return iconv("UTF-8", DataFormat::OUTPUT_ENCODING, $csvString);
    }

    // CSV 다운로드 - 계산이 끝난 후에 실행 가능.
    public function CSVDownlod(){
        // 파일 다운로드 처리 (하기 헤더가 있으면 파일다운로드로 간주한다.)
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . "result_" . $this->fileName . "\"");

        echo $this->makeCSVStringRowHeader();
        echo "\r\n";

        for($i = 0; $i < $this->students; $i++){
            echo ($this->makeCSVStringRow($i));
            echo "\r\n";
        }
    }
}

?>
