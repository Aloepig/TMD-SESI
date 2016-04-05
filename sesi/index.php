<html>
<head>
<title>타이틀</title>
</head>
<body>
    <h1>SESI결과 파일 만들기</h1>
    <form name="upload-form" enctype="multipart/form-data" action="https://www.tmdedu.com/sesi/process.php" method="post">
        본 페이지는 임시로 만들어진 페이지입니다. SESI정식버전이 개발될 경우 사용하지 않을 예정입니다.<br>
        파일 업로드 하기
        <input type="file" name="file" accept=".csv"/>
        <input type="submit" value="업로드"/>

    </form>
    <h2>주의사항</h2>
        <ul>
            <li>파일 크기는 1MB미만이어야 합니다.</li>
            <li>CSV파일만 업로드 가능합니다.</li>
            <li>업로드한 파일은 서버에 저장되지 않습니다.</li>
        </ul>
</body>
</html>
