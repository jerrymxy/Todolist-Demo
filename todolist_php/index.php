<?php

// 入口，获取所有数据库表内容

include "databaseinfo.php";

// 跨域设置
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods: GET");

// 创建连接（面向对象）
$conn = new mysqli($servername, $username, $password, $dbname);

// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 设置字符集
$conn->set_charset("utf8");

// SQL语句
$sql = "select * from ".$tablename;
// 查询
$result = $conn->query($sql);

$ret = array();

if ($result->num_rows > 0) {
    // 输出数据
    while ($row = $result->fetch_assoc()) {
        // echo "id: " . $row["id"] . " - title: " . $row["title"] . " " . $row["is_done"] . "<br>";
        // echo json_encode($row);
        array_push($ret, $row);
    }
    // echo json_encode((Object)$ret);
}
echo json_encode($ret);
$conn->close();
