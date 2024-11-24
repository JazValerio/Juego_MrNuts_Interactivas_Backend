<?php 
    require 'db.php';
     if($_GET){
        // Reference: https://medoo.in/api/where
        $player =$database->select("tb_players","*",[
            "id_player"=>$_GET["id"]
        ]);
     }
    

    if($_POST){
        // Reference: https://medoo.in/api/delete
        $database->delete("tb_players",[
            "id_player"=>$_POST["id"] 
        ]);

        header("Location: ./players.php");
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
<body>
    <header class="header-section">
        <h1 class="title">Delete Player</h1>
    </header>
    <section class="admin-section">
     <h2>Are you sure you want to delete this player, and his score?</h2>
    <h3><?php echo $player[0]["player_name"]; ?></h3>
    <form action="./deletePlayer.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $player[0]["id_player"]; ?>">
        <input class="form-btn" type="submit" value="Delete">
        <input class="form-btn" type="button" value="No" onclick="window.history.back()">
    </form>
    </section>
</body>
</html>