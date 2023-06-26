
<?php
// 最初に名前がすでに登録されているか? name.txtに確認するためのコードを書きました。
$filename = "name.txt"; // 名前を保存するファイルのパス

// ファイルが存在し、読み取り可能な場合、名前を取得
if (file_exists($filename) && is_readable($filename)) {
  $name = trim(file_get_contents($filename));
} else {
  $name = ""; // 名前の初期値を設定
}

// フォームが送信された場合、送信された名前を取得し、ファイルに保存
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // 名前が送信された場合
  if (isset($_POST["name"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $content1 = $name . " " . $email.  "\n"; // 名前とemailを1行で保存する
    file_put_contents($filename, $content1);
  }

  // 曲名が送信された場合
  if (isset($_POST["song"])) {
    $song = $_POST["song"];
    $date = date("Y-m-d H:i:s"); // 現在の日付を取得
    $sleep = $_POST["sleep"];
    $condition = $_POST["condition"];
    $content2 = $date . " " . $song ." " . $sleep ." " .$condition .  "\n"; // 日付と曲名、睡眠時間、体調を1行で保存
    file_put_contents("dairy_song.txt", $content2, FILE_APPEND); // dairy_song.txtに追記
  }
}



// 名前が空の場合、名前の入力フォームを表示
if (empty($name)) {
?>
  <title>名前の入力</title>
<!-- </head> -->
<body>
  <form method="post" action="<?php echo        htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    お名前: <input type="text" name="name">
    Email: <input type="text" name="email">
    <input type="submit" value="送信">
  </form>

<?php

} else {
  
  echo "こんにちは、" . $name . "さん！"."<br>";
  echo "<br>";
  echo '<div style="white-space: pre-wrap;">'; //改行したいのでpre-wrapを使う
  echo "今日も一日お疲れさまでした。\n今日はどんな音楽を聴きましたか？もしくはどんな曲を聴きたい気分ですか？\n 1曲だけその曲名を教えて下さい！";

  ?>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    曲名: <input type="text" name="song">
    睡眠時間: <input type="number" name="sleep" min="0" max="15" step="1">
    今日の体調（１(悪い）～５（良い）):<input type="number" name="condition" min="1" max="5" step="1">
    <input type="submit" value="送信">
  
    <p>過去に選んだ曲の記録を見てみる→  <a href="read.php">はい</a></p>
    <p>体調と睡眠時間の過去データを見てみる→  <a href="graph.php">はい</a></p>
  </form>
<?php
}
?>
</html>






