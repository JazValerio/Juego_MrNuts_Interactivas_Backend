<?php 
    require 'db.php';
    $items =$database->select("tb_players",[
        "[>]tb_countries"=>["id_country" => "id_country"]
    ],[
        "tb_players.player_name",
        "tb_players.score",
        "tb_countries.country_name",
        "tb_countries.country_code"
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

    <table border="1">
        <tr>
            <td>Player Name</td>
            <td>Player Score</td>
            <td>Country</td>
        </tr>
        <?php //revisar
            foreach($items as $item){
                echo "<tr>";
                echo "<td>{$item["player_name"]}</td>";
                echo "<td>{$item["score"]}</td>";
                echo "<td>{$item["country_name"]}</td>";
                echo "</tr>";
            }
        ?>
    </table>
    
</body>
</html>