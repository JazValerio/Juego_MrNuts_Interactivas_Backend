<?php 
    require 'db.php';
    $items =$database->select("tb_players",[
        "[>]tb_countries"=>["id_country" => "id_country"]
    ],[
        "tb_players.id_player",
        "tb_players.player_name",
        "tb_players.score",
        "tb_countries.country_name",
        "tb_countries.country_code",
        "tb_players.player_photo"
    ]);
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
        <h1 class="title">List of Players</h1>
        <a href="./player.php"><input class="btn btn-login" type="button" value="Back"></a>
    </header>
    <section class="admin-section">
        <h2 class="subtitle text-center ">Players Registered</h2>
        <p>Here you can see all the players registered and manage them</p>
        <table border="1">
            <tr>
                <td>Player Name</td>
                <td>Player Score</td>
                <td>Country</td>
                <td>Player Photo</td>
                <td>Options</td>
              
            </tr>
            <?php 
                foreach($items as $item){
                    echo "<tr>";
                    echo "<td>{$item["player_name"]}</td>";
                    echo "<td>{$item["score"]}</td>";
                    echo "<td>{$item["country_name"]}</td>";
                    echo "<td><img src='./img/{$item["player_photo"]}' alt='img' style='width: 50px; height: 50px;'></td>";
                    echo "<td class='options'><a href='./updatePlayer.php?id={$item["id_player"]}'>Edit</a> | <a href='./deletePlayer.php?id={$item["id_player"]}'>Delete</a> </td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </section>

    <footer>
        <p class="text-center">&copy; 2024 Game Platform MrNuts.</p>
    </footer>
    
</body>
</html>