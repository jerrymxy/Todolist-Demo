<?php

include "databaseinfo.php";

header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

// 创建连接（面向对象）
$conn = new mysqli($servername, $username, $password, $schemaname);
// 设置字符集
$conn->set_charset("utf8");

$req_title = $_REQUEST["title"];

$sql = "insert into ".$dbname."(title) values(\"".$req_title."\")";

$conn->query($sql);

echo $req_title;