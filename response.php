<?php
    //var_dump($_POST);
    require 'db.php';

    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT, ['cost' => 12]);

    // Reference: https://medoo.in/api/insert
    $database->insert("tb_users",[
        "username"=> $_POST["name"],
        "password"=>$pass,
        "email"=>$_POST["email"],
    ]);
    header("Location:./admin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
       echo "<h1>User added successfully</h1>";
    ?>
</body>
</html>