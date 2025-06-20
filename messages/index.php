<?php
  session_start();
  $message = false;
  require_once('../php/connect.php');
  if(isset($_SESSION['ID'])){ 
    $ID = $_SESSION['ID'];
    
    $query = "SELECT * FROM userMessageList WHERE ID = $ID";
    $resultMessageList = $mysqli->query($query);


  if(isset($_GET['msg'])){
    
    $message = true;
    $messageTo = $_GET['msg'];
    
    $query = "SELECT *  FROM userMesssage WHERE (messageFrom = $ID AND MessageTo = $messageTo) OR (messageFrom = $messageTo AND MessageTo = $ID)";
    $getMessage = $mysqli->query($query);
    $getUserInformation = "SELECT * FROM userInformation WHERE ID = $messageTo";
    $getInfo = $mysqli->query($getUserInformation);
    $info = $getInfo->fetch_assoc();

  }
  
?>

<html>
    <head>
        <title> Общение </title>
        <link rel = 'stylesheet' href = 'messageStyle(1).css'>
        <link rel = "stylesheet" href="../style.css">
        
        <meta http-equiv="Text-Language" content = "ru">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name = "author" content="Main: Roman Sarvirov, Disigner: Tim Romanenсo, Server  master: Egor Larchenkov">
        <meta name = "generator" content = "Atom">
        <meta name = "copyright" content = "Dark Side">
        <meta name = "copyright" content = "Roman Sarvirov, Tim Romanenсo, Egor Larchenkov">
        <meta name = "description" content = "Dark Side - Главная страница">
        <meta name = "keywords" content= "">

    </head>
    <body  link = #000000 vlink = #000000 alink=#000000>
    <div class = 'top-panel'>
      <div class = 'info'>
        <i class="fa fa-home fa-2x"><ion-icon name="chatbubbles"></ion-icon></i>
          <span class="nav-text">
            Сообщения
          </span>
      </div>

      <div class = 'info'> 
        <i class="fa fa-home fa-2x"><ion-icon name="notifications"></ion-icon></i>
        <div class="top-image">
            <img src="../php/getImage.php" alt="" class="top-pic">
        </div>
      </div> 

    </div>

    <div class="area"></div><nav class="main-menu">
            <ul>
                <li>
                    <a href="../main/">
                        <i class="fa fa-home fa-2x"><ion-icon name="home"></ion-icon></i>
                        <span class="nav-text">
                           Главная
                        </span>
                    </a>
                  
                </li>
                <li class="has-subnav">
                    <a href="../profile/">
                        <i class="fa fa-globe fa-2x"><ion-icon name="person"></ion-icon></i>
                        <span class="nav-text">
                            Профиль
                        </span>
                    </a>
                    
                </li>
                <li class="has-subnav">
                    <a href="#">
                       <i class="fa fa-comments fa-2x"><ion-icon name="chatbubbles"></ion-icon></i>
                        <span class="nav-text">
                            Сообщения
                        </span>
                    </a>
                    
                </li>
                <li class="has-subnav">
                    <a href="../friends/">
                       <i class="fa fa-camera-retro fa-2x"><ion-icon name="people"></ion-icon></i>
                        <span class="nav-text">
                            Друзья
                        </span>
                    </a>
                   
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-film fa-2x"></i>
                        <span class="nav-text disable">
                            Музыка
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-book fa-2x"></i>
                        <span class="nav-text disable">
                           Фото
                        </span>
                    </a>
                </li>
                <li>
                   <a href="#">
                       <i class="fa fa-cogs fa-2x"></i>
                        <span class="nav-text disable">
                            Настройки
                        </span>
                    </a>
                </li>
                

            <ul class="logout">
                <li>
                   <a href="#">
                         <i class="fa fa-power-off fa-2x"></i>
                        <span class="nav-text">
                            Выйти
                        </span>
                    </a>
                </li>  
            </ul>
        </nav>

    <div class = messageConteine>
      <div class = leftMenu> 
        <div class = chatPanel>
          <span> Чаты </span>
          <div class = tools>
            <ion-icon name="search"></ion-icon>
            <ion-icon name="add"></ion-icon>
          </div>
        </div>
        <div class = 'chatListType'>
          <button class="primary ghost">
			      Все
		      </button>
          <button class="primary ghost">
			      Группы
		      </button>
          <button class="primary ghost">
			      Чаты
		      </button>
        </div>
        <div class = "chatList">
        
          <div  class = "messageBlock" id = MessageNone> 
            У вас пока нет диалогов
          </div>
          
        </div>

      </div>

      
      <div class = centerMenu> 
        <div class = messageBlock> 
          <div class = 'textImg' id = "<?php if($message){echo $messageTo;}?>"> 
            <div id = friendsImage class = 'imageUS'> 
              <?php if($message){ echo "<img src = '../php/getImage.php?ID=$messageTo' class = image>";}?>
            </div>
            <h4 id = "none"><?php if($message){ echo $info["Name"]. " " . $info["Surname"];} ?> <br><span> </span></h4>        
          </div>     
        </div>
        <!-- чат -->

        <div id = chatBox class = chatBox>
          <?php if($message && $getMessage->num_rows > 0){ 
            
           } else{ echo "<div class = 'message NoMessage'>Начните диалог 
            <ion-icon style='top: 15; color: width: 50; height: 50; position: absolute; font-size:40px' name='chatbubbles-outline' role= 'img' class='md hydrated' aria-label='chatbubbles outline'></ion-icon>
            </div>";}?>
        </div>
              <!-- Сама строка сообщения -->
        <div id = stat style = "color: #fff; text-align: center; font-size: 16px; display:none;"></div>
        <div class = chatInput style = '<?php if(!$message){echo "display:none";}?> '>
          <ion-icon name="happy-outline"></ion-icon> 
          <ion-icon name="attach-outline"></ion-icon>
          <input id = UserInputMessage type = "text" placeholder = 'Напишите свое сообщение...'>
          <ion-icon name="send-sharp" id = enter onclick = sendMessage()></ion-icon>
        </div>
      </div>

      <div class = rightMenu> 
        <div class = chatPanel>
          <div class = specailPanel>
            <button class="primary ghost">
			        Закрепленные
		        </button>
            <button class="primary ghost">
			        Скрытые
		        </button>
          </div>

          <div class = specailChat>
            <div class = specailContent>

            </div>
            <div class = upgrade>
              <div class = content>
                <span> Настройки чата: </span>
                <span> Выберите цвет или фото для чата </span>
              </div>
            </div>
          </div>   
        </div>
      </div>

      </div>
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> 
    </div>
    <div class="preloader">
		<div class="preloader__loader">
			<img src="../image/Loading.gif" alt="" />
		</div>
	</div>
    <script src = "../js/jquery-1.12.4.min.js"></script>
    <script src = "../js/msg.js"></script>
    </body>


</html>

<?php
  }else{
    echo "Error please sign in";
    // Error (Please sign in)
  }
?>