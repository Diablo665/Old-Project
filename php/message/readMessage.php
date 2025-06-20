<?php 
session_start();
if(isset($_SESSION['ID'])){
    $ID = $_SESSION['ID'];
    $messageID = $_GET['messageID'];
    $messageTo = $_GET['messageTo'];
    require_once('../connect.php');
    
    $query = "UPDATE userMesssage SET status = 'read' WHERE messageID = $messageID";
    
    $mysqli->query($query);
    
    
    $query = "UPDATE `userMessageList` SET notReadValue = notReadValue - 1 WHERE (ID = $ID AND FriendsID = $messageTo) && notReadValue !=0";
    
    $mysqli->query($query);
    
    
}

?> 