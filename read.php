<?php

// DB接続情報
$dbn = 'mysql:dbname=test;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}
// 「dbError:...」が表示されたらdb接続でエラーが発生していることがわかる.

// 参照はSELECT文!
// $sql = 'SELECT * FROM word_table ORDER BY id ASC LIMIT 30'; 
$sql = 'SELECT * FROM word_table WHERE date = current_date()';


$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// $stmt->bindValue(':date', $day, PDO::PARAM_INT);
// $day = new DateTime();
// echo $day->format('Y-m-d');
// var_dump($day);
//   exit();

if ($status == false) {
  $error = $stmt->errorInfo();
  exit('sqlError:' . $error[2]);
  //   // 失敗時􏰂エラー出力

} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $output = "";
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td>{$record["word"]}</td>";
    $output .= "<td>{$record["name"]}</td>";
    $output .= "<td>{$record["trivia"]}</td>";
    $output .= "</tr>";
  }
}



// お酒の情報呼び出し
$sql = 'SELECT * FROM sake_table WHERE date2 = current_date()';

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  exit('sqlError:' . $error[2]);
  //   // 失敗時􏰂エラー出力

} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $output2 = "";
  foreach ($result as $record) {
    $output2 .= "<tr>";
    $output2 .= '<img src="sake_img/' . $record["gazo"] . '" width="150">';
    $output2 .= "<td>{$record["brand"]}</td>";
    $output2 .= "<td>{$record["description"]}</td>";
    $output2 .= "</tr>";
  }
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <title>電子カレンダ７</title>
  <style>
    /*ここにスタイルを記述*/
    body {
      width: 450px;
      margin: 25px auto 0;
    }

    .top {
      border-bottom: 2px solid gray;
    }

    .top,
    .day {
      display: flex;
      align-items: flex-end;
    }

    .day {
      justify-content: center;
    }

    .mm {
      width: 50px;
      font-size: 40px;
      font-weight: bold;
    }

    .eng_m {
      font-size: 25px;
      font-weight: bold;
      color: blue;
    }

    .YYYY {
      width: 200px;
      text-align: right;
      font-size: 25px;
    }

    .week {
      margin-top: 16px;
      text-align: center;
      font-size: 25px;
    }

    .dd {
      font-size: 150px;
    }

    .nichi {
      font-size: 60px;
    }

    .week,
    .day {
      <?php
      if (date("w") == 0) {
        echo "color: red;";
      }
      if (date("w") == 6) {
        echo "color: blue;";
      }
      ?>
    }
  </style>
</head>

<body>

  <div class="top">
    <div class="mm"><?php echo date("m"); ?></div>
    <div class="eng_m"><?php echo date("M"); ?></div>
    <div class="YYYY"><?php echo date("Y"); ?></div>
  </div>
  <?php $week = array("日", "月", "火", "水", "木", "金", "土"); ?>
  <div class="week"><?php echo $week[date("w")]; ?>曜日</div>
  <div class="day">
    <div class="dd"><?php echo date("j"); ?></div>
    <div class="nichi">日</div>
  </div>


  <fieldset>
    <legend>格言</legend>

    <!-- <a href="todo_input.php">入力画面</a> -->
    <table>
      <thead>
        <tr>
          <th>word</th>
          <th>name</th>
          <th>trivia</th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
  <?= $output2 ?>
  <script>
    const hoge = <?= json_encode($result) ?>;
    console.log(hoge);
    const hoge2 = <?= json_encode($day) ?>;
    console.log(hoge2);
  </script>


</body>

</html>