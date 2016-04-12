<?php

    // 타이틀
    $score_title[0] = "인생목표";
    $score_title[1] = "공부목표";
    $score_title[2] = "자기결정력";
    $score_title[3] = "공부미래확신도";
    $score_title[4] = "공부의지도";
    $score_title[5] = "공부희열도";
    $score_title[6] = "공부효능감";
    $score_title[7] = "동기_저빈도반응";
    $score_title[8] = "핵심파악";
    $score_title[9] = "난이도조절";
    $score_title[10] = "논리적사고";
    $score_title[11] = "몰입도";
    $score_title[12] = "집중력";
    $score_title[13] = "인지_저빈도반응";
    $score_title[14] = "목표검토";
    $score_title[15] = "자기보상";
    $score_title[16] = "예습";
    $score_title[17] = "복습";
    $score_title[18] = "노트필기기술";
    $score_title[19] = "수집정리기술";
    $score_title[20] = "행동_저빈도반응";
    $score_title[21] = "행동_방어적반응";
    $score_title[22] = "시험전대응도";
    $score_title[23] = "시험후대응도";
    $score_title[24] = "시험기술";
    $score_title[25] = "시험만족도";
    $score_title[26] = "시험불안";
    $score_title[27] = "성취_방어적반응";
    $score_title[28] = "건강관리";
    $score_title[29] = "시간관리";
    $score_title[30] = "미디어관리";
    $score_title[31] = "역경관리";
    $score_title[32] = "유혹관리";


    // 스코어 키 테이블 (1000이 넘는 값은 역문항)


    // 동기 요인 =================================
    // 인생목표
    $score_keys[0][0] = 0;
    $score_keys[0][1] = 9;
    $score_keys[0][2] = 10;
    $score_keys[0][3] = 17;
    $score_keys[0][4] = 20;
    $score_keys[0][5] = 23;

    // 공부목표
    $score_keys[1][0] = 1;
    $score_keys[1][1] = 8;
    $score_keys[1][2] = 19;
    $score_keys[1][3] = 25;

    // 자기결정력
    $score_keys[2][0] = 2;
    $score_keys[2][1] = 11;
    $score_keys[2][2] = 24;

    // 공부미래 확산도
    $score_keys[3][0] = 3;
    $score_keys[3][1] = 16;
    $score_keys[3][2] = 21;
    $score_keys[3][3] = 30;

    // 공부의지도
    $score_keys[4][0] = 4;
    $score_keys[4][1] = 12;
    $score_keys[4][2] = 14;
    $score_keys[4][3] = 29;

    // 공부희열도
    $score_keys[5][0] = 5;
    $score_keys[5][1] = 7;
    $score_keys[5][2] = 15;
    $score_keys[5][3] = 22;
    $score_keys[5][4] = 27;

    // 공부효능감
    $score_keys[6][0] = 6;
    $score_keys[6][1] = 13;
    $score_keys[6][2] = 26;

    // 동기 저빈도 반응
    $score_keys[7][0] = 18;
    $score_keys[7][1] = 28;

    // 인지 요인 =================================
    // 핵심파악
    $score_keys[8][0] = 31 + 6;
    $score_keys[8][1] = 31 + 9;
    $score_keys[8][2] = 31 + 14;
    $score_keys[8][3] = 31 + 18;

    // 난이도조절
    $score_keys[9][0] = 31 + 7;
    $score_keys[9][1] = 31 + 16;
    $score_keys[9][2] = 31 + 23;

    // 논리적사고
    $score_keys[10][0] = 31 + 0;
    $score_keys[10][1] = 31 + 2;
    $score_keys[10][2] = 31 + 11;
    $score_keys[10][3] = 31 + 21;
    $score_keys[10][4] = 31 + 26;

    // 몰입도
    $score_keys[11][0] = 31 + 3;
    $score_keys[11][1] = 31 + 8;
    $score_keys[11][2] = 31 + 12;
    $score_keys[11][3] = 31 + 17;
    $score_keys[11][4] = 31 + 19;
    $score_keys[11][5] = 31 + 24;
    $score_keys[11][6] = 31 + 27;

    // 집중력
    $score_keys[12][0] = 31 + 1;
    $score_keys[12][1] = 31 + 5;
    $score_keys[12][2] = 31 + 10;
    $score_keys[12][3] = 31 + 13;
    $score_keys[12][4] = 31 + 20;
    $score_keys[12][5] = 31 + 25;

    // 저빈도반응
    $score_keys[13][0] = 31 + 4;
    $score_keys[13][1] = 31 + 15;
    $score_keys[13][2] = 31 + 22;

    // 행동 요인 =================================
    // 목표검토
    $score_keys[14][0] = 31 + 28 + 3;
    $score_keys[14][1] = 31 + 28 + 8;
    $score_keys[14][2] = 31 + 28 + 10;
    $score_keys[14][3] = 31 + 28 + 16;
    $score_keys[14][4] = 31 + 28 + 23;
    $score_keys[14][5] = 31 + 28 + 29;

    // 자기보상
    $score_keys[15][0] = 31 + 28 + 4;
    $score_keys[15][1] = 31 + 28 + 7;
    $score_keys[15][2] = 31 + 28 + 11;
    $score_keys[15][3] = 31 + 28 + 24;

    // 예습
    $score_keys[16][0] = 31 + 28 + 0;
    $score_keys[16][1] = 31 + 28 + 17;
    $score_keys[16][2] = 31 + 28 + 25;

    // 복습
    $score_keys[17][0] = 31 + 28 + 1;
    $score_keys[17][1] = 31 + 28 + 12;
    $score_keys[17][2] = 31 + 28 + 18;
    $score_keys[17][3] = 31 + 28 + 22;
    $score_keys[17][4] = 31 + 28 + 30;

    // 노트필기기술
    $score_keys[18][0] = 31 + 28 + 2;
    $score_keys[18][1] = 31 + 28 + 9;
    $score_keys[18][2] = 31 + 28 + 14;
    $score_keys[18][3] = 31 + 28 + 19;
    $score_keys[18][4] = 31 + 28 + 26;
    $score_keys[18][5] = 31 + 28 + 31;

    // 수집 정리 기술
    $score_keys[19][0] = 31 + 28 + 5;
    $score_keys[19][1] = 31 + 28 + 15;
    $score_keys[19][2] = 31 + 28 + 21;
    $score_keys[19][3] = 31 + 28 + 28;

    // 저빈도반응
    $score_keys[20][0] = 31 + 28 + 6;

    // 방어적 반응
    $score_keys[21][0] = 31 + 28 + 13;
    $score_keys[21][1] = 31 + 28 + 20;
    $score_keys[21][2] = 31 + 28 + 1027;

    // 성취 기술 요인 =================================
    // 시험전대응도
    $score_keys[22][0] = 31 + 28 + 32 + 4;
    $score_keys[22][1] = 31 + 28 + 32 + 12;
    $score_keys[22][2] = 31 + 28 + 32 + 15;
    $score_keys[22][3] = 31 + 28 + 32 + 18;

    // 시험후대응도
    $score_keys[23][0] = 31 + 28 + 32 + 0;
    $score_keys[23][1] = 31 + 28 + 32 + 10;
    $score_keys[23][2] = 31 + 28 + 32 + 14;
    $score_keys[23][3] = 31 + 28 + 32 + 21;
    $score_keys[23][4] = 31 + 28 + 32 + 24;

    // 시험기술
    $score_keys[24][0] = 31 + 28 + 32 + 3;
    $score_keys[24][1] = 31 + 28 + 32 + 5;
    $score_keys[24][2] = 31 + 28 + 32 + 25;

    // 시험만족도
    $score_keys[25][0] = 31 + 28 + 32 + 2;
    $score_keys[25][1] = 31 + 28 + 32 + 6;
    $score_keys[25][2] = 31 + 28 + 32 + 8;
    $score_keys[25][3] = 31 + 28 + 32 + 11;
    $score_keys[25][4] = 31 + 28 + 32 + 22;

    // 시험불안
    $score_keys[26][0] = 31 + 28 + 32 + 1;
    $score_keys[26][1] = 31 + 28 + 32 + 9;
    $score_keys[26][2] = 31 + 28 + 32 + 16;
    $score_keys[26][3] = 31 + 28 + 32 + 17;
    $score_keys[26][4] = 31 + 28 + 32 + 19;
    $score_keys[26][5] = 31 + 28 + 32 + 23;

    // 방어적반응
    $score_keys[27][0] = 31 + 28 + 32 + 7;
    $score_keys[27][1] = 31 + 28 + 32 + 13;
    $score_keys[27][2] = 31 + 28 + 32 + 20;

    // 습관관리 =================================
    // 건강관리
    $score_keys[28][0] = 31 + 28 + 32 + 26 + 1;
    $score_keys[28][1] = 31 + 28 + 32 + 26 + 7;
    $score_keys[28][2] = 31 + 28 + 32 + 26 + 14;
    $score_keys[28][3] = 31 + 28 + 32 + 26 + 21;

    // 시간관리
    $score_keys[29][0] = 31 + 28 + 32 + 26 + 2;
    $score_keys[29][1] = 31 + 28 + 32 + 26 + 8;
    $score_keys[29][2] = 31 + 28 + 32 + 26 + 15;
    $score_keys[29][3] = 31 + 28 + 32 + 26 + 20;

    // 미디어관리
    $score_keys[30][0] = 31 + 28 + 32 + 26 + 3;
    $score_keys[30][1] = 31 + 28 + 32 + 26 + 9;
    $score_keys[30][2] = 31 + 28 + 32 + 26 + 1016;
    $score_keys[30][3] = 31 + 28 + 32 + 26 + 1019;

    // 역경관리
    $score_keys[31][0] = 31 + 28 + 32 + 26 + 1004;
    $score_keys[31][1] = 31 + 28 + 32 + 26 + 1011;
    $score_keys[31][2] = 31 + 28 + 32 + 26 + 17;
    $score_keys[31][3] = 31 + 28 + 32 + 26 + 23;
    $score_keys[31][4] = 31 + 28 + 32 + 26 + 5;
    $score_keys[31][5] = 31 + 28 + 32 + 26 + 1012;
    $score_keys[31][6] = 31 + 28 + 32 + 26 + 18;
    $score_keys[31][7] = 31 + 28 + 32 + 26 + 24;
    $score_keys[31][8] = 31 + 28 + 32 + 26 + 6;

    // 유혹관리
    $score_keys[32][0] = 31 + 28 + 32 + 26 + 1000;
    $score_keys[32][1] = 31 + 28 + 32 + 26 + 1010;
    $score_keys[32][2] = 31 + 28 + 32 + 26 + 1013;
    $score_keys[32][3] = 31 + 28 + 32 + 26 + 1022;
?>
