<?php 
    require 'db.php';

    date_default_timezone_set('America/Costa_Rica');

    if(isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 
    'application/json') !== false) {

        $data= json_decode(file_get_contents('php://input'), true);

        $database->insert("tb_tracking",[
            "length" => $data["length"],
            "device_type" => $data["browser"],
            "screen_size" => $data["screen"],
            "level" => $data["level"],
            "has_closed_browser" => $data["closed"],
            "date" => date("Y-m-d H:i:s"),
            "score" => $data["score"]
        ]);
        $message = "Data received successfully.";

        echo json_encode($message);

    }

?>


