<?php

// 移除所有已完成项

include "databaseinfo.php";

header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

// 创建连接（面向对象）
$conn = new mysqli($servername, $username, $password, $schemaname);

// 删除is_done为1的项
$sql = "delete from ".$dbname." where is_done = 1";

$conn->query($sql);
