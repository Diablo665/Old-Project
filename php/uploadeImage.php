<?php

session_start();
if(isset($_SESSION["ID"]) && $_SESSION['ID'] != ""){
    $ID = $_SESSION["ID"];

    require_once("connect.php");


    $query = "SELECT image_id FROM profileImage WHERE image_id = $ID";
    $exist = $mysqli->query($query);

    $image = $_FILES['file'];
    ($image['error'] == 0) or die("Возникла ошибка при загрузке изображения");
    is_uploaded_file($image['tmp_name']) or die("Вы пытаетесь загрузить вредоностный файл");
    getimagesize($image['tmp_name']) or die('Загруженный фаил не является изображением');

    $image_info = getimagesize($image['tmp_name']);
    $image_mime = $image_info['mime'];
    $image_data = addslashes(file_get_contents($image['tmp_name']));

    if($exist->num_rows != 0){
        
    $query = "DELETE FROM `profileImage` WHERE image_id = $ID";
    $result = $mysqli->query($query);
    
    $query = "INSERT INTO `profileImage`  VALUES($ID, '$image_data', '$image_mime')";
    
    }else{
        $query = "INSERT INTO `profileImage`  VALUES($ID, '$image_data', '$image_mime')";
        
    }
    
    $result = $mysqli->query($query);
    if($result){
        echo "Изображение было успешно загружено";
        
    }else{
        echo "Произошла ошибка при загрузке изображения";
    }
}


?>