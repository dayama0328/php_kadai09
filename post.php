<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();

require_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $image_name = $_POST['image_name'];
  $img_data = "images/" . $_FILES["img_data"]["name"];
  $errors = array();

  if ($name == '') {
    $errors['name'] = "投稿者が入力されておりません。";
  }

  if ($image_name == '') {
    $errors['img_name'] = "画像タイトルが入力されておりません。";
  }

  if (strlen($_FILES["img_data"]["name"]) > 0) {
    $fileinfo = pathinfo($_FILES["img_data"]["name"]);
    $fileext = strtoupper($fileinfo["extension"]);
    //$errmsg = "";

    if ($fileext != "PNG" and $fileext != "JPG") {
        $errors['file_extension'] = "対象ファイルはPNGまたはJPGのみです！";
      } else {
        $img_data = "images/" . $_FILES["img_data"]["name"];

      if (!move_uploaded_file($_FILES["img_data"]["tmp_name"], $img_data)) {
          $errors['file_upload_failure'] = "ファイルのアップロードに失敗しました。";
      }
    }
  } elseif (file_exists($img_data)) {
    $errors['file_upload_none'] = "画像が選択されておりません";
    }

  if (empty($errors)) {
    $_SESSION["name"] = $name;
    $_SESSION["image_name"] = $image_name;
    $_SESSION["img_data"] = $img_data;
    header('location: postdone.php');
    exit;
  }
}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>画像投稿ページ</title>
  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>画像投稿掲示板</h1>
<hr>
<form class="contents" action="" method="post" enctype="multipart/form-data">
<table border="0" cellspacing="0" cellpadding="0" class="table_basic">

<colgroup>
  <col width="33%" />
  <col width="67%" />
</colgroup>

  <tr>
    <th><span>投稿者</span><span class="must">必須</span></th>
    <td ><input type="text" name="name" value="" class="box"><br>
      <?php if ($errors['name']) : ?>
         <?php echo h($errors['name']) ?>
      <?php endif ?>
    </td>
  </tr>

  <tr>
    <th><span>画像タイトル</span><span class="must">必須</span></th>
    <td><input type="text" name="image_name" value="" class="box"><br>
     <?php if ($errors['img_name']) : ?>
         <?php echo h($errors['img_name']) ?>
     <?php endif ?>
    </td>
  </tr>

  <tr>
    <th><span>画像ファイル</span><span class="must">必須</span></th>
    <td><input type="file" name="img_data" value="選択してください"><br>
    <?php if ($errors['file_extension']) : ?>
         <?php echo h($errors['file_extension']) ?>
    <?php endif ?>
    <?php if ($errors['file_upload_failure']) : ?>
         <?php echo h($errors['file_upload_failure']) ?>
    <?php endif ?>
    <?php if ($errors['file_upload_none']) : ?>
         <?php echo h($errors['file_upload_none']) ?>
    <?php endif ?>
    </td>
  </tr>

</table>
<p class="button"><input type="submit" name="submit" value="投稿する" width="50px"></p>
</form>
<p class="link"><a href="index.php">画像一覧ヘージはこちら>></a></p>
</body>
</html>