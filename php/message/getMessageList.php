<?php 
    $MyArray = array();
    session_start();
    $ID = $_SESSION['ID'];
    require("../connect.php");
    $query = "SELECT *, to_seconds(now() + INTERVAL 3 HOUR) - to_seconds(lastMessageData) as duration, notReadValue FROM userMessageList WHERE ID = $ID ORDER BY lastMessageData ";
    $resultMessageList = $mysqli->query($query);
    $mysqli->close();
    
    while($row = $resultMessageList->fetch_row()){
        $MyArray[] = $row;
    }
    
    
    header('content-type:application/json');
    echo json_encode($MyArray);
    unset($MyArray);
    
?>