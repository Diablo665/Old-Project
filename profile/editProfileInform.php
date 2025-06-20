<?php
/* запись редактированной информации в JSON файл */
$conc = 'UserDirectoryFf';
$userLogin = $_GET['UsLogin'];
$json = file_get_contents("../"."$conc"."$userLogin"."/todo.json"); 
$jsonArray = json_decode($json, true);
$EditingName = $_GET['EditingName'];
$EditingSurname = $_GET['EditingSurname'];
$EditingNickname = $GET['EditingNickname'];
$DateOfBirth = $_GET['EditinDateOfBirth'];
$sexEditing = $_GET['EditinSex'];
if ($EditingName != '')
    $jsonArray['user_name'] = $EditingName;
if ($EditingSurname != '')
    $jsonArray['user_surname'] = $EditingSurname;
if ($EditingNickname != '')
    $jsonArray['nickname'] = $EditingNickname;
if ($DateOfBirth != '')
    $jsonArray['DateOfBirth'] = $DateOfBirth;
if ($sexEditing != '')
    $jsonArray['sex'] = $sexEditing;
file_put_contents("../"."$conc".$userLogin.'/todo.json', json_encode($jsonArray, JSON_FORCE_OBJECT));

/*----------- */


$serverName = "";
$connectionInfo = array("Database" => "userInformation", "CharacterSet" => "UTF-8");
$connection = sqlsrv_connect($serverName, $connectionInfo);

if($connection){
    $query = "UPDATE userInformations SET Name = '$EditingName', Surname =  '$EditingSurname', Nickname = '$EditingNickname', DateOfBirth = $DateOfBirth, SEX = '$sexEditing' WHERE ";

}else{

}

?>