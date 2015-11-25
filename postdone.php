<?php
require_once('functions.php');
session_start();


$dbh = connectDb();
$sql = "insert into posts (create_at, name, image_name, img_data) values
        (now(), :name, :image_name, :img_data)";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(":name", $_SESSION["name"]);
$stmt->bindParam(":image_name", $_SESSION["image_name"]);
$stmt->bindParam(":img_data", $_SESSION["img_data"]);


$stmt->execute();



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>投稿完了ページ</title>
  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <h1>画像投稿掲示板</h1>
  <hr>
<div id="wrapper">
<p class="title">下記の内容で投稿しました！</p>

<p>投稿者：<?php echo h($_SESSION["name"]); ?></p>

<p class="imagestitle">画像タイトル：<?php echo h($_SESSION["image_name"]); ?></p>

<p>画像ファイル：<br>
  <?php echo "<img src=\"{$_SESSION['img_data']}\"><br><br><br>"; ?>
</p>

  <p class="return"><a href="posting.php">画像投稿ページへ戻る>></a></p>
  <p class="link"><a href="index.php">画像一覧ヘージはこちら>></a></p>
</div>
</body>
</html>