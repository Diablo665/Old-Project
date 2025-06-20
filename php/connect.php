<?php
require("configSQL.php");

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE, 3306);
if ($mysqli->connect_error) {
    die("Ошибка: не удается подключиться к серверу");
}
 
?>