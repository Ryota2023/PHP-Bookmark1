<?php
// ファイルを読み込む
$data = file_get_contents('dairy_song.txt');

//読み込んだものをブラウザに表示する
echo nl2br($data);
?>
<br>
<a href="post.php">曲の入力へ</a>
