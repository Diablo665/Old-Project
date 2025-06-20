<?php

        // Получить поля и убрать пустое место
    
        $recipient = filter_var(trim($_GET["email"]), FILTER_SANITIZE_EMAIL);

        $subject = "Подтверждение email\n";
        $code = $six_digit_random_number = random_int(100000, 999999);
        // Контент передаваемый в сообщени
        $email_content = "Добрый день\n";
        $email_content .= "Данный email был указан для для привязки на сайте dsmessage.ru\n\n";
        $email_content .= "Код подтвержления:\n\n";
        $email_content .= "$code\n";

        $email_content .= "Игнорируйте данное сообщение если это были не вы\n";
        // Отправка сообщения
        if (mail($recipient, $subject, $email_content)) {
            // Отправить код (200) если сообщение отправлено.
            $result = '<p>Вам на email отправлен код для подтверждения</p> 
            <div id = inf>
                <input id = verefyCode type = text>
                <a href="#" id = checkCode class="fciA navItem"><span class="fciSpan">Подтвердить</span></a>
            </div>
            <div class = errors>   
            </div>
            ';

        } else {
            // Вернуть код (500) при ошибке отправки сообщения.
            $result = 'При отправке кода возникла ошибка, проверте правильность введенного email, или попробуйте в другой раз';
            $code = 'None';
        }
        $array = array('result' => $result, 'code' => $code);
        header('Content-type: application/json');
        echo json_encode($array);
?>