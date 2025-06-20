<?php 
    session_start();
    if(isset($_SESSION["ID"])){
        require_once('../connect.php');
        $ID = $_SESSION['ID'];
        $messageTo = $_GET['messageTo'];
        $messageText = $_GET['messageText'];

        $query = "UPDATE `userMessageList` SET LastMessage = '$messageText' WHERE (ID = $ID  AND FriendsID = $messageTo) || (ID = $messageTo AND FriendsID = $ID)";

        $mysqli->query($query);
        $mysqli->close();
        
    }

?>