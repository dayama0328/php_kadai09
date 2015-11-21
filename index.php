<?php
require_once('functions.php');

$dbh = connectDb();
$sql = "select * from posts";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($row);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>画像投稿掲示板</title>
  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>画像投稿掲示板</h1>
<hr>
<p class="posting"><a href="post.php">画像を投稿する</a></p>
<h2>投稿内容一覧</h2>
<?php if(count($row)) : ?>
  <?php foreach($row as $post) : ?>
    <ul>
      <li>投稿時間：<?php echo h($post['create_at'])?></li>
      <li>名前：<?php echo h($post['name'])?></li>
      <li>画像タイトル：<?php echo h($post['image_name'])?></li>
      <li>画像：<br><img src="<?php echo $post['img_data']?>" alt="" width="300px"></li>
    </ul>
    <hr>
  <?php endforeach ?>
<?php endif; ?>
</body>
</html>