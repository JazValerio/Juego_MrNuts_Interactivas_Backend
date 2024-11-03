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
</head>
<body>
    <h1>List of players</h1>
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