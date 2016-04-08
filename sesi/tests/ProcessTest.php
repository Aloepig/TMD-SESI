<?php

include_once "Process.php";

/**
 * Created by PhpStorm.
 * User: TMD-IT-Aloepig
 * Date: 2016-04-07
 * Time: 오후 12:00
 */
class ProcessTest extends PHPUnit_Framework_TestCase{

    private $testFileName = "input_win.csv";
    //private $testFileName = "input_fail_column.csv";
    //private $testFileName = "input_out_range.csv";
    private $testClass;
    private $testTscore = 10;

    // 테스트 클래스 인스턴스 생성
    public function __construct(){
        $this->testClass = new Process();
    }

    // 업로드 폴더 만들기 테스트
    public function testCanFileUpload(){
        $this->assertFileExists($this->testClass->getUploadDirName());
    }

    //업로드 파일 서버 복사 테스트 생략
    /*
    public function testCanFileCopy(){
        assertFileEquals();
    }
    */

    //파일을 읽도록 위치를 세팅
    public function setFileLocation(){
        $this->testClass->setFileLocation($this->testFileName);
    }

    //파일 내용 검증
    public function testFileDataFormat(){
        $this->setFileLocation();
        $this->assertTrue($this->testClass->isFileDataFormat());
    }

    // 파일읽고 점수계산 준비
    public function testScoringPrepare(){
        $this->assertTrue($this->testClass->scoringPrepare());
        //$array = ["a"=>2];
        //$this->assertEquals($array["a"],"2");
        //$this->assertEquls($this->testClass->setTscore(), $this->testTscore);
        //$this->assert($this->testClass->getFile());
    }
}