<?session_start(); ?>
<!doctype html>
<html>
  <head>
    <title> Главная</title>
    <link rel = "stylesheet" href="../style.css">
    <meta http-equiv="Text-Language" content = "ru">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name = "author" content="Main: Roman Sarvirov, Disigner: Tim Romanenсo, Server  master: Egor Larchenkov">
    <meta name = "generator" content = "Atom">
    <meta name = "copyright" content = "Dark Side">
    <meta name = "copyright" content = "Roman Sarvirov, Tim Romanenсo">
    <meta name = "description" content = "Dark Side - Главная страница">
    <meta name = "keywords" content= "">

  </head>
  <?php /* Верхний колонтикул */ ?>
  <?php 
    require_once('../php/connect.php');
    $ID = $_SESSION['ID'];
    $query = "SELECT email FROM userInformation WHERE ID = $ID";
    $result = $mysqli->query($query);
    if($result){
      $email = $result->fetch_assoc();
    }
  ?>
  <body>
  <script src ='../js/jquery-1.12.4.min.js'> </script>

    <div class = 'top-panel'>
      <div class = 'info'>
        <i class="fa fa-home fa-2x"><ion-icon name="home"></ion-icon></i>
          <span class="nav-text">
            Главная
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
                    <a href="#">
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
                    <a href="../messages/">
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
  <?php /*----------*/ ?>
    <?php /* отображение информации */?>
    <?if(trim($email['email']) == 'No'){ ?>
      <link href = "../emailConfirm.css" rel = "stylesheet">
      <script src = '../js/emailVerefy.js'></script>
      <div id="openModal" class="modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Привязать Email</h3>
              <a href="#close" title="Close" class="close">×</a>
            </div>
            <div class="modal-body">    
              <p>Для безопасности и восстановления пароля, просим вас привязать свой Email к странице </p>
              <div id = inf>
                <input id = email type = email placeholder = 'exampl@site.com'> 
                <a href="#" id = sendEmail class="fciA navItem"><span class="fciSpan">Подтвердить</span></a>
              </div>
              <div class = errors> 
                
              </div>

            </div>
          </div>
        </div>
      </div>
    <? } ?>

    <div class = "center_p">
      
    </div>

    <div class = 'right-panel'>

    </div>
    </div>
    <div class="preloader">
		<div class="preloader__loader">
			<img src="../image/Loading.gif" alt="" />
		</div>

  <script src = '../js/Scripts.js'></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </body>
</html>