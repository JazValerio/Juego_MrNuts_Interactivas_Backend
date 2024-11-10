<?php
    $name = "Register user Form";

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Juego_MrNuts/css/main.css">
</head>


<body>
    <header class="header-section">
        <h1 class="title"><?php echo $name; ?></h1>
        <a href="./admin.php"><input class="btn btn-login" type="button" value="Home"></a>
    </header>

    
    <a href="./admin.php">Registered users</a>
    <form action="./response.php" method="POST">
        <input type="text" name="name">
        <input type="password" name="password">
        <input type="text" name="email">
        <input type="submit" value="submit data" >
    </form>
</body>
</html>