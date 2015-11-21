<?php

function h($s)
{
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

// DB接続の処理
function connectDb()
{
    define('DSN', 'mysql:host=localhost;dbname=image_bbs;charset=utf8');
    define('USER', 'testuser');
    define('PASSWORD', '9999');

    try
    {
        return new PDO(DSN, USER, PASSWORD);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
        exit;
    }
}

// $fileName = "sales.csv";
// $lines= file($fileName, FILE_IGNORE_NEW_LINES);

// $memberNum = count($lines) - 1;

// foreach ($lines as $line) {
//   $record = explode(" ", $line);
//   $saleSum += $record[1];
// }



?>