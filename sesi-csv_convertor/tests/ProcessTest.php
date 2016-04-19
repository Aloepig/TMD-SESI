<?php

include_once "../Process.php";

/**
 * Created by PhpStorm.
 * User: TMD-IT-Aloepig
 * Date: 2016-04-07
 * Time: 오후 12:00
 */
class ProcessTest extends PHPUnit_Framework_TestCase{

    const TEST_FILE_NAME = "sesi_csv_test.csv";
    private $testClass;

    // 테스트 클래스 인스턴스 생성
    public function __construct(){
        $this->testClass = new Process();
    }

    //파일을 읽도록 위치를 세팅하는 함수
    private function setFileLocation(){
        $this->testClass->setFileLocation($this::TEST_FILE_NAME);
    }
    
    // 업로드 폴더 만들기 테스트
    public function testCanFileUpload(){
        $this->assertFileExists($this->testClass->getUploadDirName());
    }
 
    //업로드 파일 서버 복사 테스트 생략
    //assertFileEquals();

    //파일 읽고 배열만들기 테스트
    public function testFileDataFormat(){
        $this->setFileLocation();
        $this->assertTrue($this->testClass->scoringPrepare(false));
    }


    // 점수 합산(계산 준비) 테스트
    /**
     *
     */
    public function testScoringPrepare() {
        //파일 읽고 배열만들기
        $this->setFileLocation();
        $this->testClass->scoringPrepare(false);

        //점수 합산 테스트
        $this->testClass->sumScoring();
        $testRow = $this->testClass->getRowAnswer();
        $this->assertEquals(91, $testRow[0]["동기"]);
        $this->assertEquals(73, $testRow[0]["인지"]);
        $this->assertEquals(81, $testRow[0]["행동"]);
        $this->assertEquals(74, $testRow[0]["성취기술"]);
        $this->assertEquals(18, $testRow[0]["인생목표"]);
        $this->assertEquals(11, $testRow[0]["공부목표"]);
        $this->assertEquals(11, $testRow[0]["자기결정력"]);
        $this->assertEquals(16, $testRow[0]["공부미래확신도"]);
        $this->assertEquals(10, $testRow[0]["공부의지도"]);
        $this->assertEquals(16, $testRow[0]["공부희열도"]);
        $this->assertEquals(9, $testRow[0]["공부효능감"]);
        $this->assertEquals(12, $testRow[0]["핵심파악"]);
        $this->assertEquals(10, $testRow[0]["난이도조절"]);
        $this->assertEquals(19, $testRow[0]["논리적사고"]);
        $this->assertEquals(16, $testRow[0]["몰입도"]);
        $this->assertEquals(16, $testRow[0]["집중력"]);
        $this->assertEquals(19, $testRow[0]["목표검토"]);
        $this->assertEquals(12, $testRow[0]["자기보상"]);
        $this->assertEquals(6, $testRow[0]["예습"]);
        $this->assertEquals(17, $testRow[0]["복습"]);
        $this->assertEquals(18, $testRow[0]["노트필기기술"]);
        $this->assertEquals(9, $testRow[0]["수집정리기술"]);
        $this->assertEquals(12, $testRow[0]["시험전대응도"]);
        $this->assertEquals(19, $testRow[0]["시험후대응도"]);
        $this->assertEquals(12, $testRow[0]["시험기술"]);
        $this->assertEquals(15, $testRow[0]["시험만족도"]);
        $this->assertEquals(16, $testRow[0]["시험불안"]);
        $this->assertEquals(9, $testRow[0]["무선반응"]);
        $this->assertEquals(12, $testRow[0]["방어반응"]);
        $this->assertEquals(70, $testRow[0]["습관관리"]);
        $this->assertEquals(16, $testRow[0]["건강관리"]);
        $this->assertEquals(13, $testRow[0]["시간관리"]);
        $this->assertEquals(8, $testRow[0]["유혹관리"]);
        $this->assertEquals(23, $testRow[0]["역경관리"]);
        $this->assertEquals(10, $testRow[0]["미디어관리"]);
    }

    // T점수 테스트
    public function testTScoring(){
        $this->setFileLocation();
        $this->testClass->scoringPrepare(false);
        $this->testClass->sumScoring();
        // T점수 테스트
        $this->testClass->tScoring();
        $this->assertEquals(47, $this->testClass->getRowAnswer()[0]["동기"]);
        $this->assertEquals(49, $this->testClass->getRowAnswer()[0]["인지"]);
        $this->assertEquals(49, $this->testClass->getRowAnswer()[0]["행동"]);
        $this->assertEquals(68, $this->testClass->getRowAnswer()[0]["성취기술"]);
        $this->assertEquals(43, $this->testClass->getRowAnswer()[0]["인생목표"]);
        $this->assertEquals(49, $this->testClass->getRowAnswer()[0]["공부목표"]);
        $this->assertEquals(52, $this->testClass->getRowAnswer()[0]["자기결정력"]);
        $this->assertEquals(54, $this->testClass->getRowAnswer()[0]["공부미래확신도"]);

        $this->assertEquals(44, $this->testClass->getRowAnswer()[0]["공부의지도"]);
        $this->assertEquals(47, $this->testClass->getRowAnswer()[0]["공부희열도"]);
        $this->assertEquals(46, $this->testClass->getRowAnswer()[0]["공부효능감"]);
        $this->assertEquals(47, $this->testClass->getRowAnswer()[0]["핵심파악"]);
        $this->assertEquals(50, $this->testClass->getRowAnswer()[0]["난이도조절"]);
        $this->assertEquals(58, $this->testClass->getRowAnswer()[0]["논리적사고"]);
        $this->assertEquals(47, $this->testClass->getRowAnswer()[0]["몰입도"]);
        $this->assertEquals(44, $this->testClass->getRowAnswer()[0]["집중력"]);
        $this->assertEquals(50, $this->testClass->getRowAnswer()[0]["목표검토"]);
        $this->assertEquals(46, $this->testClass->getRowAnswer()[0]["자기보상"]);
        $this->assertEquals(44, $this->testClass->getRowAnswer()[0]["예습"]);
        $this->assertEquals(58, $this->testClass->getRowAnswer()[0]["복습"]);
        $this->assertEquals(49, $this->testClass->getRowAnswer()[0]["노트필기기술"]);
        $this->assertEquals(44, $this->testClass->getRowAnswer()[0]["수집정리기술"]);
        $this->assertEquals(50, $this->testClass->getRowAnswer()[0]["시험전대응도"]);
        $this->assertEquals(60, $this->testClass->getRowAnswer()[0]["시험후대응도"]);
        $this->assertEquals(56, $this->testClass->getRowAnswer()[0]["시험기술"]);
        $this->assertEquals(48, $this->testClass->getRowAnswer()[0]["시험만족도"]);
        $this->assertEquals(46, $this->testClass->getRowAnswer()[0]["시험불안"]);
        $this->assertEquals(9, $this->testClass->getRowAnswer()[0]["무선반응"]);    // t계산 없이 합산값 사용
        $this->assertEquals(12, $this->testClass->getRowAnswer()[0]["방어반응"]);   // t계산 없이 합산값 사용
        $this->assertEquals(43, $this->testClass->getRowAnswer()[0]["습관관리"]);
        $this->assertEquals(53, $this->testClass->getRowAnswer()[0]["건강관리"]);
        $this->assertEquals(51, $this->testClass->getRowAnswer()[0]["시간관리"]);
        $this->assertEquals(45, $this->testClass->getRowAnswer()[0]["유혹관리"]);
        $this->assertEquals(40, $this->testClass->getRowAnswer()[0]["역경관리"]);
        $this->assertEquals(42, $this->testClass->getRowAnswer()[0]["미디어관리"]);
    }


    // makeCSVStringRowHeader 테스트
    public function testMakeCSVStringRowHeader(){
        $this->setFileLocation();
        $this->testClass->scoringPrepare(false);
        $this->testClass->sumScoring();
        $this->testClass->tScoring();

        $resultCSVStringRowHeader = "이름,학생코드,학교코드,반,반번호,성별,구분,학년";
        $resultCSVStringRowHeader = $resultCSVStringRowHeader.",동기,인지,행동,성취기술,인생목표,공부목표";
        $resultCSVStringRowHeader = $resultCSVStringRowHeader.",자기결정력,공부미래확신도,공부의지도,공부희열도,공부효능감";
        $resultCSVStringRowHeader = $resultCSVStringRowHeader.",핵심파악,난이도조절,논리적사고,몰입도,집중력";
        $resultCSVStringRowHeader = $resultCSVStringRowHeader.",목표검토,자기보상,예습,복습,노트필기기술,수집정리기술";
        $resultCSVStringRowHeader = $resultCSVStringRowHeader.",시험전대응도,시험후대응도,시험기술,시험만족도,시험불안";
        $resultCSVStringRowHeader = $resultCSVStringRowHeader.",무선반응,방어반응,습관관리,건강관리,시간관리,유혹관리";
        $resultCSVStringRowHeader = $resultCSVStringRowHeader.",역경관리,미디어관리";
        $this->assertEquals(iconv("UTF-8", "EUC-KR", $resultCSVStringRowHeader), $this->testClass->makeCSVStringRowHeader());
    }

    // makeCSVStringRows 테스트
    public function testMakeCSVStringRow(){
        $this->setFileLocation();
        $this->testClass->scoringPrepare(false);
        $this->testClass->sumScoring();
        $this->testClass->tScoring();

        $resultCSVStringRow ="고준오,700101,1001,1,1,1,3,1";
        $resultCSVStringRow = $resultCSVStringRow.",47,49,49,68,43,49,52,54,44,47,46,47,50,58,47,44,50,46";
        $resultCSVStringRow = $resultCSVStringRow.",44,58,49,44,50,60,56,48,46,9,12,43,53,51,45,40,42";
        $this->assertEquals(iconv("UTF-8", "EUC-KR", $resultCSVStringRow), $this->testClass->makeCSVStringRow(0));
    }

}