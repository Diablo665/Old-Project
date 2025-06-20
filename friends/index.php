<?php 
    session_start();
    if(isset($_SESSION['ID'])){
        $ID = $_SESSION['ID'];
        
    require_once('../php/connect.php');
        
    $query = "SELECT * FROM userInformation";
    $result = $mysqli->query($query);
    
     
?>
<html>
    <head>
        <title> Друзья </title>
        <link rel = 'stylesheet' href = "profileStyle.css">
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
        <i class="fa fa-home fa-2x"><ion-icon name="people"></ion-icon></i>
          <span class="nav-text">
            Друзья
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
                    <a href="../messages/">
                       <i class="fa fa-comments fa-2x"><ion-icon name="chatbubbles"></ion-icon></i>
                        <span class="nav-text">
                            Сообщения
                        </span>
                    </a>
                    
                </li>
                <li class="has-subnav">
                    <a href="#">
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
        
        <div class = searchPanel> 
            <input type = text placeholder = "search">
            <ion-icon name="search"></ion-icon>
        </div>
         
        <div class = "chatList"> 
        <?php while($row = $result->fetch_assoc()){?>
            <div class = "chat-item">
                <div class="card-container">
	                <img class="round" src="../php/getImage.php?ID=<?php echo $row['ID']?>" alt="user">
	                <h3><?php echo $row['Name']. ' '. $row['Surname'] ?></h3>
	                <h6>---</h6>
	                <p>---</p>
	                <div class="buttons">
		                <button class="primary">
			                Написать
		                </button>
		                <button class="primary ghost">
			                В друзья
		                </button>
	                </div>
                </div>
            </div>
        <? }?> 
        </div>

        <div class="preloader">
		    <div class="preloader__loader">
			    <img src="../image/Loading.gif" alt="" />
		    </div>
        </div>

        <script src = "../js/jquery-1.12.4.min.js"></script>
        <script src = "../js/friends.js"> </script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> 
    </body>
</html>

<? }else{
    echo "Войдите в свой аккаунт для просмотра данной страницы";
    
}?>