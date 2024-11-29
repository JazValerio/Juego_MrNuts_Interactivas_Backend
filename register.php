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
   
        <h2>Complete the form to register a new user</h2>
        <p class="pdb2"> Here you can register a new Adimn user, who will be able to manage the game configs and its players</p>

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

    <footer>
        <p class="text-center">&copy; 2024 Game Platform MrNuts.</p>
    </footer>
    
</body>
</html>