<?php

/**
 * Created by PhpStorm.
 * User: TMD-IT-Aloepig
 * Date: 2016-04-08
 * Time: 오후 1:13
 */
class DataFormat {

    // 역문항 질문 번호
    const REVERSE_QUESTIONS = [
        "12" => true,
        "29" => true,
        "34" => true,
        "36" => true,
        "37" => true,
        "42" => true,
        "48" => true,
        "68" => true,
        "78" => true,
        "80" => true
    ];

    // 다음 타이틀 순서가 출력 순서이다.
    // 형식: [타이틀, 해당되는 문항 번호, 해당되는 문항 번호, ...... ]
    // 문항번호의 순서는 상관없음.
    const MATCHING_QUESTIONS = [
        // 상위요인(대분류)
        ["동기", 1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 17, 18, 20, 23, 24, 25, 27, 28, 30, 31, 32, 33, 35, 38, 45, 46, 47, 49, 50],
        ["인지", 51, 57, 62, 73, 63, 69, 74, 56, 61, 67, 72, 77, 54, 59, 64, 70, 75, 81, 84, 55, 60, 66, 71, 76, 82],
        ["행동", 87, 88, 90, 91, 93, 94, 85, 89, 92, 95, 98, 100, 101, 102, 104, 97, 99, 103, 128, 131, 134, 137, 140, 142, 130, 132, 136, 141],
        ["성취기술", 105, 110, 114, 117, 108, 112, 116, 120, 124, 129, 135, 138, 109, 113, 122, 125, 127, 106, 111, 115, 118, 121, 123],
        // 동기요인
        ["인생목표", 1, 4, 7, 10, 17, 20],
        ["공부목표", 2, 8, 11, 18],
        ["자기결정력", 3, 6, 9],
        ["공부미래확신도", 23, 28, 32, 45],
        ["공부의지도", 24, 33, 46, 49],
        ["공부희열도", 25, 30, 38, 47, 50],
        ["공부효능감", 27, 31, 35],
        // 인지요인
        ["핵심파악", 51, 57, 62, 73],
        ["난이도조절", 63, 69, 74],
        ["논리적사고", 56, 61, 67, 72, 77],
        ["몰입도", 54, 59, 64, 70, 75, 81, 84],
        ["집중력", 55, 60, 66, 71, 76, 82],
        // 행동요인
        ["목표검토", 87, 88, 90, 91, 93, 94],
        ["자기보상", 85, 89, 92, 95],
        ["예습", 97, 99, 103],
        ["복습", 98, 100, 101, 102, 104],
        ["노트필기기술", 128, 131, 134, 137, 140, 142],
        ["수집정리기술", 130, 132, 136, 141],
        // 성취기술요인
        ["시험전대응도", 105, 110, 114, 117],
        ["시험후대응도", 108, 112, 116, 120, 124],
        ["시험기술", 129, 135, 138],
        ["시험만족도", 109, 113, 122, 125, 127],
        ["시험불안", 106, 111, 115, 118, 121, 123],
        // 저빈도반응, 방어적반응
        ["무선반응", 39, 65, 86, 107, 126, 139],
        ["방어반응", 5, 52, 78, 96, 119, 133],
        // 습관관리
        ["습관관리", 13, 21, 40, 58, 14, 22, 41, 53, 15, 26, 42, 48, 16, 19, 34, 36, 43, 44, 79, 80, 83, 12, 29, 37, 68],
        ["건강관리", 13, 21, 40, 58],
        ["시간관리", 14, 22, 41, 53],
        ["유혹관리", 12, 29, 37, 68],
        ["역경관리", 16, 19, 34, 36, 43, 44, 79, 80, 83],
        ["미디어관리", 15, 26, 42, 48]
    ];

    // 임시 업로드 폴더
    const UPLOAD_DIR_NAME = "temp_upload";

    // 출력 메시지
    const MASSAGE_UPLOAD_FAIL = "파일 업로드 실패: 파일이 복사되지 않음. 관리자에 문의하세요.";
    const MASSAGE_COUNT_FAIL = "CSV 파일에서 전체 문항 수가 부족합니다.";

    /////////////////////////////////////////////
    // 전체 문항수가 바뀌면 반드시 변경해야 한다.
    /////////////////////////////////////////////
    const QUESTION_BEGIN_COLUMN = 9;    // 문제 컬럼: 9~150 (총142개)
    const QUESTION_END_COLUMN = 150;    // 컬럼 수: 1~150 (총150개)
    const ANSWER_DATA_RANGE = 5;        // 문항 답변값 범위: 1~5

    ///////////////////
    // T점수 설정 부분
    ///////////////////
    // 0, 0 인경우 합산만 (T점수 아님)
    // 형식[타이틀, 차감 값, 곱셈 값]
    const T_SCORING = [
        // 상위요인(대분류)
        ["동기", 96.2918, 17.84926],
        ["인지", 74.4988, 15.44273],
        ["행동", 82.0253, 17.96862],
        ["성취기술", 52.4531, 11.85840],
        // 동기요인
        ["인생목표", 21.5098, 5.38444],
        ["공부목표", 11.0928, 3.54021],
        ["자기결정력", 10.4037, 2.38335],
        ["공부미래확신도", 14.6883, 3.26900],
        ["공부의지도", 11.6453, 3.03557],
        ["공부희열도", 16.9794, 3.81007],
        ["공부효능감", 9.7580, 2.37132],
        // 인지요인
        ["핵심파악", 12.6462, 3.05807],
        ["난이도조절", 9.8277, 2.25373],
        ["논리적사고", 15.8607, 3.62146],
        ["몰입도", 17.4224, 5.08585],
        ["집중력", 18.6448, 4.61654],
        // 행동요인
        ["목표검토", 18.8855, 4.40814],
        ["자기보상", 13.1515, 3.55608],
        ["예습", 7.3377, 2.55223],
        ["복습", 13.6036, 4.20261],
        ["노트필기기술", 18.4362, 4.90402],
        ["수집정리기술", 10.6247, 3.12777],
        // 성취기술요인
        ["시험전대응도", 11.7704, 3.47899],
        ["시험후대응도", 14.5794, 4.11461],
        ["시험기술", 10.4103, 2.59271],
        ["시험만족도", 15.6512, 3.93394],
        ["시험불안", 17.7638, 4.84575],
        // 저빈도반응, 방어적반응
        ["무선반응", 0, 0],
        ["방어반응", 0, 0],
        // 습관관리
        ["습관관리", 78.3657, 12.57661],
        ["건강관리", 14.9773, 3.20237],
        ["시간관리", 12.5429, 3.09179],
        ["유혹관리", 9.6181, 3.26554],
        ["역경관리", 28.6003, 6.03108],
        ["미디어관리", 12.6271, 3.59438]
    ];
    const T_SCORING_MULTI_VALUE = 10;   // 곱하는 값
    const T_SCORING_ADD_VALUE = 50;     // 더하는 값

    ////////////////////////////////////////////////////////////////////////////////////
    // 여기 아래는 절대 손대지 말 것. 문항은 상수만 변경하세요. Aloepig 2016.4.12
    /////////////////////////////////////////////////////////////////////////////////////
    private $totalNumberOfTitles;       // 전체 타이틀 개수
    private $totalNumberOfQuestions;    // 전체 문항수 (150-9 = 142개)

    public function __construct() {
        $this->calculationProcedure();
    }

    // 문항 정보 사전 계산
    private function calculationProcedure(){
        $this->totalNumberOfTitles = count($this::MATCHING_QUESTIONS);
        $this->totalNumberOfQuestions = $this::QUESTION_END_COLUMN - $this::QUESTION_BEGIN_COLUMN;

        if ( count($this::MATCHING_QUESTIONS) != count($this::T_SCORING) ){
            throw new Exception("타이틀(MATCHING_QUESTIONS) 개수와 계산(T_SCORING) 개수가 일치하지 않음");
        }
    }

    public function getUploadDirName(){
        return $this::UPLOAD_DIR_NAME;
    }

    public function getReverseQuestions(){
        return $this::REVERSE_QUESTIONS;
    }

    // 매칭 질문을 리턴
    public function getMatchingQuestions($arrayNumber){
        if($arrayNumber >= $this->totalNumberOfTitles){
            throw new Exception("배열 범위를 벗어났음");
        } else {
            return $this::MATCHING_QUESTIONS[$arrayNumber];
        }
    }

    public function  getQuestionBeginColumn(){
        return $this::QUESTION_BEGIN_COLUMN;
    }

    public function  getQuestionEndColumn(){
        return $this::QUESTION_END_COLUMN;
    }

    public function  getAnswerDataRange(){
        return $this::ANSWER_DATA_RANGE;
    }

    public function getTScoring(){
        return $this::T_SCORING;
    }

    public function getTScoringMultiValue(){
        return $this::T_SCORING_MULTI_VALUE;
    }

    public function getTScoringAddValue(){
        return $this::T_SCORING_ADD_VALUE;
    }

    public function  getTotalNumberOfTitles(){
        return $this->totalNumberOfTitles;
    }

    public function  getTotalNumberOfQuestions(){
        return $this->totalNumberOfQuestions;
    }

}
