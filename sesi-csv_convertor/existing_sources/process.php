<?php

    include_once "score_table.php";
    
    $uploaddir = "temp_upload";

    // 임시 업로드 폴더 만들기
    if(!file_exists($uploaddir)) {
        mkdir($uploaddir);
    }

    $uploadfile = $uploaddir."/".basename($_FILES["file"]["name"]);

    // 업로드 된 파일을 임시저장
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadfile)) {

        // 파일 읽기
        $file = fopen($uploadfile, "r");
        if ($file) {
            
            // 현재 읽고 있는 row
            $row = 0;
            
            // 문제 시작 인덱스
            $questionBeginIndex = 8;
            
            while (($line = fgetcsv($file)) !== false) {
                
                // 첫번째 줄은 데이터가 아니므로 넘어간다.
                if(0 == $row) {
                    
                    $headers = array_splice($line, 0, $questionBeginIndex);
                    
                } else {
                    
                    $students[$row - 1] = array_splice($line, 0, $questionBeginIndex);
                    
                    // 8번째 데이터부터 142개의 데이터가 답변 데이터이다.
                    $answers[$row - 1] = array_splice($line, 0, 142);
                    
                    // 데이터 검증
                    for($i = 0 ; $i < 142 ; $i++) {
                        // 답변은 1 ~ 5 사이의 값을 가져야 한다.
                        $answer = $answers[$row - 1][$i];
                        if(!(1 <= $answer && $answer <= 5)) {
                            // 답변이 1 ~ 5사이의 값을 가지지 않는다면
                            $answers[$row - 1][$i] = "0";
                        }
                    }   
                }
                
                $row++;
            }
        
            fclose($file);
            
            // 업로드된 파일 삭제
            unlink($uploadfile);
            
            // 파일 다운로드 처리 (하기 헤더가 있으면 파일다운로드로 간주한다.)
            header('Content-Type: application/octet-stream');
            header("Content-Transfer-Encoding: Binary"); 
            header("Content-disposition: attachment; filename=\"" . "result.csv" . "\""); 
            
            // 입력된 데이터에 오류가 없다면 한줄씩 계산 시작    
            for($i = 0 ; $i < count($answers) ; $i++) {
                
                for($y = 0 ; $y < count($score_keys) ; $y++) {
                    
                    $value[$i][$y] = 0;
                    for($z = 0 ; $z < count($score_keys[$y]) ; $z++) {
                        $index = $score_keys[$y][$z];
                        if(1000 <= $index) {
                            // 역문항
                            $index -= 1000;
                            $value[$i][$y] += (6 - intval($answers[$i][$index]));    
                        } else {
                            $value[$i][$y] += intval($answers[$i][$index]);    
                        }
                    }
                }
            }
            
            // 칼럼 정보 출력
            $result_content = "";
            for($i = 0 ; $i < count($headers) ; $i++) {
                if(0 < $i) {
                    $result_content = $result_content . ",";
                }
                
                $result_content = $result_content . $headers[$i];
            }
            
            for($i = 0 ; $i < count($score_title) ; $i++) {
                $result_content = $result_content . "," .  mb_convert_encoding($score_title[$i], "EUC-KR", "UTF-8");
            }
            
            echo ($result_content);
            echo "\r\n";
            
            // 평균 정보 출력
            // echo (mb_convert_encoding("평균,,,,,," "EUC-KR", "UTF-8"));
            // for($i = 0 ; $i < count($value) ; $i++) {
                
            //     for($y = 0 ; $y < count($value[$i]) ; $y++) {
                    
            //         $result_content = $result_content . ",";
            //         $result_content = $result_content . $students[$i][$y];    
            //     }
            // }
            // echo "\r\n";
            
            // 학생 정보 출력
            for($i = 0 ; $i < count($students) ; $i++) {
                
                $result_content = "";
                
                // 학생 기본 정보
                for($y = 0 ; $y < count($students[$i]) ; $y++) {
                    
                    if(0 < $y) {
                        $result_content = $result_content . ",";
                    }
                
                    $result_content = $result_content . $students[$i][$y];    
                }
                
                // 평가 정보
                for($y = 0 ; $y < count($value[$i]) ; $y++) {
                    
                    $result_content = $result_content . mb_convert_encoding(",", "EUC-KR", "UTF-8");
                    $result_content = $result_content . mb_convert_encoding($value[$i][$y], "EUC-KR", "UTF-8");
                }
                
                echo ($result_content);
                echo "\r\n";
            }
            
        } else {
            // error opening the file.
            echo("파일 열기 실패");
        } 
    } else {
        // 파일 업로드 실패
        echo("파일 업로드 실패");
    }

?>

