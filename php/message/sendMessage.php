<?php 
    session_start();
    $ID = $_SESSION['ID'];

    $messageTo = $_GET['messageTo'];
    $status = $_GET['status'];
    $time = date('Y-m-d H:i:s');
    $messageText = $_GET['messageText'];

    require_once('../connect.php');

    $query = "INSERT INTO userMesssage(messageTo, messageFrom, messageText, messageData, status) VALUES($messageTo, $ID, '$messageText', ADDDATE(now(), INTERVAL 3 HOUR), '$status')";
    $mysqli->query($query);


    $query = "SELECT * FROM userMessageList WHERE ID = $ID AND FriendsID = $messageTo";
    $result = $mysqli->query($query);
    if($result->num_rows == 0){
            $queryGetUserInfo = "SELECT Name, Surname FROM userInformation WHERE ID = $messageTo";
            $result = $mysqli->query($queryGetUserInfo);
            $row = $result->fetch_assoc();
            $name = $row['Name'] ." ". $row['Surname'];
            $query = "INSERT INTO userMessageList(ID, FriendsID, FriendsName, LastMessage) VALUES($ID, $messageTo, '$name', '$messageText')";
            $res = $mysqli->query($query);

            $queryGetUserInfo = "SELECT Name, Surname FROM userInformation WHERE ID = $ID";
            $result = $mysqli->query($queryGetUserInfo);
            $row = $result->fetch_assoc();
            $name = $row['Name'] ." ". $row['Surname'];
            $query = "INSERT INTO userMessageList(ID, FriendsID, FriendsName, LastMessage, notReadValue) VALUES($messageTo, $ID, '$name', '$messageText', 1)";
            $res = $mysqli->query($query);
        }else {
            $query = "UPDATE `userMessageList` SET LastMessage = '$messageText', lastMessageData = ADDDATE(now(), INTERVAL 3 HOUR) WHERE (ID = $ID  AND FriendsID = $messageTo) || (ID = $messageTo AND FriendsID = $ID)";
            $mysqli->query($query);
            
            $query = "UPDATE `userMessageList` SET notReadValue = notReadValue + 1 WHERE (ID = $messageTo AND FriendsID = $ID)";
            
            $mysqli->query($query);
            
        }
    $mysqli->close();
?>