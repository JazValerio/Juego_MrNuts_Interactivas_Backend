<?php
    $title = "Update data";

    require 'db.php';

    if($_GET){
        // Reference: https://medoo.in/api/where
        $user =$database->select("tb_users","*",[
            "id_user"=>$_GET["id"]
        ]);

    }

    if($_POST){
        // Reference: https://medoo.in/api/update
        $database->update("tb_users",[
            "username"=>$_POST["name"],
            "email"=>$_POST["email"]
        ],[
            "id_user"=>$_POST["id"]
        ]);

        header("Location: ./list.php");
    }
    
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update data</title>
</head>
<body>
    <h1><?php echo $title; ?></h1>
    <form action="./update.php" method="POST">
        <input type="text" name="name" value="<?php echo $user[0]["username"]; ?>">
        <input type="password" name="password" value="123">
        <input type="text" name="email" value="<?php echo $user[0]["email"]; ?>">
        <input type="hidden" name="id" value="<?php echo $user[0]["id_user"]; ?>">
        <input type="submit" value="submit data" >
    </form>
</body>
</html>