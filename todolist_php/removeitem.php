<?php

include "databaseinfo.php";

header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

// 创建连接（面向对象）
$conn = new mysqli($servername, $username, $password, $schemaname);

// 获取待修改ID
$upd_id = $_REQUEST["id"];

$sql = "delete from ".$dbname." where id = ".$upd_id;

$conn->query($sql);
