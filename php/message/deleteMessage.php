<?php 

    session_start();
    if(isset($_SESSION['ID'])){
        require_once("../connect.php");
        $ID = $_SESSION['ID'];
        $ids = json_decode(stripslashes($_POST['data']));

        $query = "DELETE FROM userMesssage WHERE messageFrom = $ID and messageID IN(".implode(',',$ids).")";

        $mysqli->query($query);

        printf("Кол-во удаленных сообщений: %d\n", $mysqli->affected_rows);
        $mysqli->close();
    }
?>