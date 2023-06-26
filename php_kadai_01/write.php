<?php

// inputから受け取る
$song = $_POST['song'];
// $email = $_POST['email'];

// データを整形する（＋で足す）
// $song = $name "\n";
// データを保存する
file_put_contents('data.txt', $data, FILE_APPEND)

// ファイルに書き込み

//文字作成

?>


<html>

<head>
    <meta charset="utf-8">
    <title>File書き込み</title>
</head>

<body>

    <h1>書き込みしました。</h1>
    <h2>内容を確認しましょう！</h2>

    <ul>
        <li><a href="read.php">確認する</a></li>
        <li><a href="input.php">戻る</a></li>
    </ul>
</body>

</html>
