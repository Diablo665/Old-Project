<?php 
    session_start();
    if(isset($_SESSION["ID"])){
        $ID = $_SESSION['ID'];
        $newMessageText = $_GET['newText'];
        $messageTo = $_GET['messageTo'];
        $messageID = $_GET["messageID"];

        require_once('../connect.php');

        $query = "UPDATE userMesssage SET messageText = '$newMessageText', lastModify = ADDDATE(now(), INTERVAL 3 HOUR) WHERE messageFrom = $ID && messageTo = $messageTo && messageID = $messageID";

        $mysqli->query($query);

        $mysqli->close();

    }
?>