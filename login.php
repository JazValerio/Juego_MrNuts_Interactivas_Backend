
<?php 

    $is_valid=true;

    require 'db.php';
    if($_POST){
    
        $user =  $database->select("tb_users","*",[
            "username"=>$_POST["name"] 
        ]);

        if(count($user) > 0){
            if(password_verify($_POST["password"],$user[0]["password"])){
                session_start();
                $_SESSION["username"] = $user[0]["username"];
                header("Location: ./admin.php");
                $is_valid = true;
            }else{
                $is_valid = false;
            }
        }else{
           $is_valid = false;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Juego_MrNuts/css/main.css">
</head>

<!--fonts-->
<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=ADLaM+Display&display=swap" rel="stylesheet">
</head>

<body>
  <header class="header-section">
    <div class="logo logo-header" href="index.html"></div>
    <nav>
      <ul class="top-nav">
        <li>
          <a class="nav-list-item" href="Juego_MrNuts/index.html">
            <i class="icon-home"><img src="./Juego_MrNuts/img/home.png" alt="home"></i>
            <span>Inicio</span>
          </a>
        </li>
        <li>
          <a class="nav-list-item" href="login.php">
            <i class="icon-register"><img src="./Juego_MrNuts/img/file-text.png" alt="register"></i>
            <span>Login</span>
          </a>
        </li>
        <li>
          <a class="nav-list-item" href="Juego_MrNuts/game.html">
            <i class="icon-game"><img src="./Juego_MrNuts/img/game.png" alt="game"></i>
            <span>Juego</span>
          </a>
        </li>
        <li>
          <a class="nav-list-item" href="Juego_MrNuts/ranking.html">
            <i class="icon-ranking"><img src="./Juego_MrNuts/img/calendar.png" alt=""></i>
            <span>Ranking</span>
          </a>
        </li>
      </ul>
    </nav>
  </header>
  <div class="login-section pdb2">
    <div class="black-box">
      <h2 class="title-login pdb2">Login</h2>

      <form action="./login.php" method="POST">
        <div class="input-group pdb2" >
          <label class="label" for="Username">Username</label>
          <input class="input" type="text" name="name">
        </div>
        <div class="input-group pdb2">
          <label class="label" for="password">Password</label>
          <input class="input" type="password" name="password">
        </div>
        <div>
            <input class="btn btn-login " type="submit" value="Login">
        </div>
        
      </form>

      <?php 
          if(!$is_valid){
              echo "<p class='error-message'>Username or Password Invalid</p>";
          }
      ?>

    </div>
  </div>
  <footer class="footer-section text-white">
    <div class="footer-text">
      <h2>Mr.Nuts</h2>
      <p>Taller del inventor</p>
      <p>&copy; 2024</p>
    </div>
    <!--<div class="footer-icons">
      <a href="#"><i class="icon"><img src="./Juego_MrNuts_Interactivas/img/map-pin.png" alt="location"></i></a>
      <a href="#"><i class="icon"></i><img src="./Juego_MrNuts_Interactivas/img/git.png" alt="git"></a>
      <a href="#"><i class="icon"></i><img src="./Juego_MrNuts_Interactivas/img/mail.png" alt="mail"></a>
    </div>-->

  </footer>
</body>

</html>