<?php 
require_once("connect.php");
session_start();

if(isset($_SESSION['ID'])){
    $ID = $_SESSION["ID"];
    if(isset($_GET["ID"])){
        $ID = $_GET['ID'];
    }
    $query = "SELECT * FROM profileImage WHERE image_id = $ID";

    $result = $mysqli->query($query);

    if($result === false){
        //echo "Error: image been unuploade from server: ".print_r(mysqli_error//($mysqli), true);
        exit();
    }
    if($result->num_rows == 0){
        
        $data  = file_get_contents("../image/noPhoto.jpg");
        header("Content-type: ". "image/jpeg");
        echo $data;
        exit;

        
    }else{
        $image =$result->fetch_assoc();
        header("Content-type: ". $image['image_mime']);
        echo $image['image_data'];
    }

}
?>