<!-- 　睡眠時間と体調をグラフ表示させるためのファイル。 -->
<!-- ここは完全にCHAT-GPTの力を借りました。dairy_song.txtからデータを読み取り、JavaScriptにデータを渡すためにjson_encode関数を使用しています。 -->
<!-- しかし、何も表示されません。なぜ表示されないかを調べたかったですが、時間がなく、ここで終了としました。提出後も時間あれば、ここは追及していきたいます！！ -->


  <!-- データを折れ線グラフ表示させるため、Chart.jsというライブラリを読みに行きます -->
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<?php
$dataFile = "dairy_song.txt";
$dates = [];
$sleep_times = [];
$conditions = [];

if (file_exists($dataFile) && is_readable($dataFile)) {
    $lines = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $parts = explode(" ", $line);
        if (count($parts) >= 4) { // 日付, 曲名, 睡眠時間, 体調が含まれている場合のみ
            $dates[] = $parts[0]; // 日付
            $sleep_times[] = (int)$parts[2]; // 睡眠時間
            $conditions[] = (int)$parts[3]; // 体調
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart"></canvas>
    <script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($dates); ?>,
            datasets: [
                {
                    label: '睡眠時間',
                    data: <?php echo json_encode($sleep_times); ?>,
                    borderColor: 'rgba(75, 192, 192, 1)', // 青色
                    fill: false,
                },
                {
                    label: '体調',
                    data: <?php echo json_encode($conditions); ?>,
                    borderColor: 'rgba(255, 99, 132, 1)', // 赤色
                    fill: false,
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    type: 'time',
                    time: {
                        parser: 'YYYY-MM-DD',
                        unit: 'day'
                    }
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
    <h3>戻る→  <a href="post.php">はい</a></h3>
</body>
</html>
