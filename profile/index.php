<?php
require_once('../php/connect.php');
session_start();

if (isset($_SESSION['ID'])) {
    $ID = $_SESSION['ID'];
    $query = $mysql->prepare("SELECT * FROM UserInformation WHERE ID = '$id'");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $information = $result->fetch_assoc();

?>



<html>
    <head> 
        <title> Профиль </title>
        <link rel = "stylesheet" href="../style.css">
        <link rel = "stylesheet" href="Profile.css">


        <meta http-equiv="Text-Language" content = "ru">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name = "author" content="Main: Roman Sarvirov, Disigner: Tim Romanenсo, Server  master: Egor Larchenkov">
        <meta name = "generator" content = "Atom">
        <meta name = "copyright" content = "Dark Side">
        <meta name = "copyright" content = "Roman Sarvirov, Tim Romanenсo, Egor Larchenkov">
        <meta name = "description" content = "Dark Side - Главная страница">
        <meta name = "keywords" content= "">
    </head>
    <body>

    <div class = 'top-panel'>
      <div class = 'info'>
        <i class="fa fa-home fa-2x"><ion-icon name="person"></ion-icon></i>
          <span class="nav-text">
            Профиль
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
                    <a href="#">
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
        <br>

        <?php /*---------------*/ ?>

        <?php /* Левое меню информации */ ?>
        <div class = 'add-post'>     
            <div class = 'post-added-text'>
                <textarea id = 'post-text'></textarea>
                <div class = 'post-added-bt'>
                    <ion-icon id = 'attach' name="attach-outline"></ion-icon>
                    <ion-icon id = 'smiles' name="happy-outline"></ion-icon>
                </div>
            </div> 
                <a href="#"  id = 'post-add' class="button-add">Опубликовать</a>
        </div>

        <div class="postPlase">
            <!--<div class = 'contener'>
                <div class = 'post-header'>
                    <div class = 'post-header-image'>
                        <img src="../php/getImage.php" alt="">
                    </div>
                    <div class = 'post-header-info'>
                        <div class = 'name'>
                            <span class = 'name-text'> Dark Side</span>
                            <span class = 'time'>20:51 </span>
                            <ion-icon name="ellipsis-horizontal"></ion-icon>
                        </div>
                        <div class = 'content-type'>
                            Новая запись
                        </div>
                    </div>
                </div>
                <div class = 'post-content'>
                    <div class = 'post-content-text'>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a libero id nunc mattis scelerisque vel in nulla. Sed iaculis pharetra auctor. Sed non enim rutrum, semper massa at, elementum libero. Nulla a consectetur dolor. Morbi a justo id felis bibendum auctor vitae ac metus. Integer laoreet lacinia leo nec laoreet. Vivamus sed leo vitae augue scelerisque ultrices. Ut sed iaculis tortor, nec iaculis mauris. Donec ullamcorper mauris nec fermentum rhoncus. Fusce feugiat tristique nibh nec pharetra. Sed ullamcorper egestas fermentum. Suspendisse lobortis eget nibh eget condimentum. Morbi gravida feugiat lacus in porttitor. Morbi quis semper leo. Morbi at condimentum eros. Donec tempor viverra molestie.
                    Nunc tincidunt iaculis ex, quis lacinia eros venenatis non. Maecenas nec urna felis. Duis egestas ultricies mauris nec condimentum. Aliquam erat volutpat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis dictum tellus nec lacus rutrum rhoncus. Nunc facilisis nisi id.
                    </div>
                    <div class = 'post-content-image'>
                        <div class = 'col1'>
                            <div class = 'postImage'><img src="../php/getImage.php" alt=""></div>
                            <div class = 'postImage'><img src="../php/getImage.php" alt=""></div>
                            <div class = 'postImage'><img src="../php/getImage.php" alt=""></div>
                        </div>
                        <div class = 'col2'>
                            <div class = 'postImage'><img src="../php/getImage.php" alt=""></div>
                            <div class = 'postImage'><img src="../php/getImage.php" alt=""></div>
                            <div class = 'postImage'><img src="../php/getImage.php" alt=""></div>
                        </div>
                    </div>
                    <div class = 'post-content-attach'>

                    </div>
                </div>
            </div>-->
        </div>

        <section class="main">
            <div class = 'edit-panel'>

            </div>

            <div class="profile-card">
              <div class="image">
                <img src="../php/getImage.php" alt="" class="profile-pic">
              </div>
              <div class="data">
                <h2><?php echo $information['Name']. ' '. $information['Surname'] ?></h2>
                <span></span>
              </div>
              <div class="row">
                <div class="info">
                  <h3>Друзья</h3>
                  <span>0</span>
                </div>
                <div class="info">
                  <h3>Записи</h3>
                  <span>0</span>
                </div>
              </div>
              <div class="buttons">
                <? if(isset($_GET['ID']) && (isset($_SESSION['ID']) && $_SESSION['ID'] != $_GET['ID'])){?>
                <a href="#" id = 'send-message' class="btn">Написать</a>
                <a href="#" id = 'add-friends' class="btn">В друзья</a>
                <? }else{?>
                <a href="#" id = 'add-post-btn' class="btn">Новая запись</a>
                <a href="#"  id = 'update-info-btn' class="btn">Редактировать</a>
                <? }?>
              </div>
              <ion-icon class = 'open-more-info' name="chevron-down-circle"></ion-icon>

              <div class="moreInfo">
                <span> Дополнительная информация отсутствует </span>
              </div>
            </div>
        </section>

        <div class="preloader">
		<div class="preloader__loader">
			<img src="../image/Loading.gif" alt="" />
		</div>
	</div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src = "../js/jquery-1.12.4.min.js"></script>
    <script src = "../js/profile.js"></script>
    </body>
</html>

<?php
    }else{
?>
<html> 
    <head> <title> Error </title> </head> <body background = "../image/profile.jpg"><div style = "color: #f00; font-size: 15px"> Войдите в свой аккаунт для просмотра страницы профиля </div></body>
</html>

<?php }?>