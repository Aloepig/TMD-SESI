<?php
/**
 * Created by PhpStorm.
 * User: TMD-IT-Aloepig
 * Date: 2016-04-08
 * Time: 오후 4:06
 */
include_once "Process.php";
include_once "DataFormat.php";

$processClass = new Process();

if ( $processClass->fileCopy() ){
    
    if ($processClass->scoringPrepare(true)){
        $processClass->sumScoring();
        $processClass->tScoring();
        $processClass->CSVDownlod();
    } else {
        echo DataFormat::MASSAGE_COUNT_FAIL;
    }
    
} else {
    echo DataFormat::MASSAGE_UPLOAD_FAIL;
}
