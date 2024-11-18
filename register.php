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
    <section class="admin-section">
   
        <P>Complete the form to register a new user</P>
        <form action="./response.php" method="POST">
            <label for="name">Username</label>
            <input type="text" name="name">
            <label for="password">Password</label>
            <input type="password" name="password">
            <label for="email">Email</label>
            <input type="text" name="email">
            <input class="form-btn" type="submit" value="submit data" >
        </form>
    </section>
    
</body>
</html>