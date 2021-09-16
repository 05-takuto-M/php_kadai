<?php
// enq_data_create.php

// まずは`var_dump($_POST);`で値を確認すること！！

// データの受け取り
$name = $_POST["name"];
$age = $_POST["age"];
$gender = $_POST["gender"];
$number = $_POST["number"];
$address = $_POST["address"];
$rikaido = $_POST["rikaido"];
$gengo = $_POST["gengo"];
$toiawase = $_POST["toiawase"];

// データ1件を1行にまとめる（最後に改行を入れる）
$write_data = "{$name} {$age} {$gender} {$number} {$address} {$rikaido} {$gengo} {$toiawase}\n";

// ファイルを開く．引数が`a`である部分に注目！
$file = fopen('data/data.csv', 'a');
// ファイルをロックする
flock($file, LOCK_EX);

// 指定したファイルに指定したデータを書き込む
fwrite($file, $write_data);

// ファイルのロックを解除する
flock($file, LOCK_UN);
// ファイルを閉じる
fclose($file);

// データ入力画面に移動する
header("Location:enq_data_input.php");

?>


