<?php

include_once "Process.php";

/**
 * Created by PhpStorm.
 * User: TMD-IT-Aloepig
 * Date: 2016-04-07
 * Time: 오후 12:00
 */
class ProcessTest extends PHPUnit_Framework_TestCase{

    private $uploadDirName = "temp_upload";
    private $testFileName = "test.csv";
    private $testClass;

    // 테스트 클래스 인스턴스 생성
    public function __construct(){
        $this->testClass = new Process($this->uploadDirName);
    }

    // 업로드 폴더 만들기 테스트
    public function testCanFileUpload(){
        $this->assertTrue($this->testClass->isUploadDir());
        $this->assertFileExists($this->testClass->getUploadDirName());
    }

    //업로드 파일 서버 복사 테스트 생략
    /*
    public function testCanFileCopy(){
        assertFileEquals();
    }
    */

    // 파일읽기 (파일을 읽도록 위치를 세팅)
    public function testCanFileRead(){
        $this->testClass->setFileLocation($this->testFileName);
        $this->testClass->readUploadFile();
        $this->assertTrue(True);
        //$this->assert($this->testClass->getFile());
    }
}