<?php 
    require '../db.php';

    if($_GET){
        $data= $database->select("tb_game_config","*",[
            "id_game_config"=>$_GET["id"]
        ]); 

        $response = $data[0]["game_data"];
        $respons = json_decode($response, true);

        header('Content-Type: application/json');
        echo json_encode($respons, JSON_PRETTY_PRINT);
    }
?>