<?php 
    require 'db.php';

    $items = $database->select("tb_players",[
        "[>]tb_countries"=>["id_country" => "id_country"]
        ],
        [
            "tb_players.id_player",
            "tb_players.player_name",
            "tb_players.score",
            "tb_players.player_photo",
            "tb_countries.country_name"
        ],[
            "ORDER" => [
            "tb_players.score" => "DESC"
            ],
            "LIMIT" => 10
        ]);

        header('Content-Type: application/json');
        echo json_encode($items, JSON_PRETTY_PRINT);
?>