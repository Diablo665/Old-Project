<?php

if($_POST['loginUs'] != "" && $_POST['passwordUs'] != "" && $_POST['repeat_pas'] != '' && $_POST['user_name'] != "" && $_POST['user_surname'] != '')
{
  require('connect.php'); 
  $conc = 'UserDirectoryFf';
  $login = $_POST['loginUs']; 
  $password = $_POST['passwordUs'];
  $repeat_pas = $_POST['repeat_pas'];
  $name = $_POST['user_name'];
  $surname = $_POST['user_surname'];

  $check_login = false;
  $QUERY = "SELECT Login FROM userData WHERE Login = '$login'";
  $result = $mysqli->query($QUERY);

  if($result->num_rows > 0){
    echo 'Error Такой логин уже существует';
  }else{
    $alph = array("q", "Q", "w", "W", "e", "E", "r", "R", "t", "T", "y", "Y", "u", "U", "i", "I", "o", "O", "p", "P", "a", "A", "s", "S", "d", "D", "f", "F", "g", "G", "h",
    "H", "j", "J", "k", "K", "l", "L", "z", "Z", "x", "X", "c", "C", "v", "V", "b", "B", "n", "N", "m", "M", "/",  "$", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", ".");
    $ghost_key = "";
    $lenght = count($alph);
    for($i = 0; $i < 20; $i++){
        $ghost_key .= $alph[rand(0, $lenght - 1)];
    }
    
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $new_password = "";
    for($i = 0; $i < strlen($hash); $i++){
      if($hash[$i] == "q" ){$new_password .= "_";}else{$new_password .= $alph[array_search($hash[$i], $alph) - 1];}                                                       
    }
    try{
    $result = $mysqli->query("INSERT INTO userData
              (  
                Login,
                Password
              )
              VALUES('$login', '$new_password.$ghost_key')");

    
    $CreateUserInfBase = $mysqli->query("INSERT INTO userInformation(Name, Surname, Sex, Nickname, DateOfBirth) VALUES('$name', '$surname', 'Не указано', 'Отсутствует', NULL)");   
    echo "/index.html";
    }catch(Error $er){
      echo "Ошибка создания нового пользователя";
    }
  }
}

?>