<?php

// 全部标记为已完成/未完成

include "databaseinfo.php";

header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

// 创建连接（面向对象）
$conn = new mysqli($servername, $username, $password, $dbname);

// 获取完整状态
$done = $_REQUEST["done"];
$val = 0;
if ($done == true) $val = 1;

$sql = "update " . $tablename . " set is_done = " .$val. " where id > 0";

$conn->query($sql);
