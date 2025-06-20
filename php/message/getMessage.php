<?php 
    session_start();
    $ID = $_SESSION['ID'];
    $MyArray = array();
    if(isset($_GET['messageTo'])){

        $messageTo = $_GET['messageTo'];
        require_once("../connect.php");
        $query = "SELECT *, to_seconds(lastModify) as second FROM userMesssage WHERE (messageFrom = $ID AND MessageTo = $messageTo) OR (messageFrom = $messageTo AND MessageTo = $ID)";
        $getMessage = $mysqli->query($query);
        $mysqli->close();
        
        while($messages = $getMessage->fetch_row()){
            $MyArray[] = $messages;

        };

        header('content-type:application/json');
        echo json_encode($MyArray);
    
    }
?>