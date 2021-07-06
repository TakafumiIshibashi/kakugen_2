<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>calendar</title>
    <link rel="stylesheet" href="">
    <style>
    /*ここにスタイルを記述*/
        body {
            width: 275px;
            margin: 25px auto 0;
        }
        .top {
            border-bottom: 2px solid gray;
        }
        .top, .day {
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
        .week{
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
        .week, .day {
          <?php 
              if (date("w") == 0) { echo "color: red;"; }
              if (date("w") == 6) { echo "color: blue;"; }
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
    <?php $week = array("日","月","火","水","木","金","土"); ?>
    <div class="week"><?php echo $week[date("w")]; ?>曜日</div>
    <div class="day">
        <div class="dd"><?php echo date("j"); ?></div>
        <div class="nichi">日</div>
    </div>
</body>
</html>