<?php
/**
 * Created by PhpStorm.
 * User: TMD-IT-Aloepig
 * Date: 2016-04-08
 * Time: 오후 4:06
 */
include_once "Process.php";

$processClass = new Process();

$processClass->fileCopy();
$processClass->scoringPrepare(true);
$processClass->sumScoring();
$processClass->tScoring();
$processClass->CSVDownlod();
