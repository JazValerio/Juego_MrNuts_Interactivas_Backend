<?php 
    require 'db.php';
    $items = $database->select("tb_countries","*");

    if($_POST){
        // Reference: https://medoo.in/api/insert
        $database->insert("tb_players",[
            "player_name"=>$_POST["name"], 
            "score"=>$_POST["score"],
            "id_country"=>$_POST["contry"]
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
        <h1 class="title">Add player</h1>
        <a href="./admin.php"><input class="btn btn-login" type="button" value="Home"></a>
    </header>

    <a href="./players.php">List of players</a>
    <form action="./player.php" method="POST">
        <input type="text" name="name">
        <input type="number" name="score">
        <select name="contry" id="country">

            <?php 
                foreach($items as $key => $value){
                    echo '<option value="'.$value["id_country"].'">'.$value["country_name"].'</option>';
                }
            ?>
            
        </select>
        <input type="submit" value="Submit">
    </form>
</body>
</html>