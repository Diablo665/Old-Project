<?php
/* Вход пользователя */
if ($_POST['Entry_login'] != '' && $_POST['Entry_password'] != ''){
/* Верхняя линия */
    require_once("connect.php");

    $login = $_POST['Entry_login'];
    $password = $_POST['Entry_password'];
    $alph = array("q", "Q", "w", "W", "e", "E", "r", "R", "t", "T", "y", "Y", "u", "U", "i", "I", "o", "O", "p", "P", "a", "A", "s", "S", "d", "D", "f", "F", "g", "G", "h",
      "H", "j", "J", "k", "K", "l", "L", "z", "Z", "x", "X", "c", "C", "v", "V", "b", "B", "n", "N", "m", "M", "/",  "$", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", ".");
      
    $query="SELECT Password, ID FROM `userData` WHERE Login = '$login'";
    $getPassword = $mysqli->query($query);

    if($getPassword)
    {
        $row = $getPassword->fetch_assoc();
        $passwordHash = mb_substr(trim($row["Password"]), 0, -20);
        $passwordUnhash = "";
        for($i = 0; $i <strlen($passwordHash); $i++){
            if ($passwordHash[$i] == "_"){$passwordUnhash .= "q";}else{$passwordUnhash .= $alph[array_search($passwordHash[$i], $alph) + 1];}
        }

        if(password_verify((string)$password, (string)$passwordUnhash))
        {
            session_start();
            $_SESSION["ID"] = $row["ID"];
            echo "/main";
            
        }else{
            echo "Error1: Неправильный логин или пароль";
        }          
    }else{

        echo "Error2: Неправильный логин или пароль";
    }

} 
