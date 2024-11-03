<?php
    $name = "REGISTRATION FORM";

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?php echo $name; ?></h1>
    <a href="./list.php">Registered users</a>
    <form action="./response.php" method="POST">
        <input type="text" name="name">
        <input type="password" name="password">
        <input type="text" name="email">
        <input type="submit" value="submit data" >
    </form>
</body>
</html>