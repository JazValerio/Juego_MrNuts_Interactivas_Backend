<?php 
    require 'db.php';

    $items = $database->select("tb_countries","*");

    function generateRandomString($length = 10) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    if($_POST){

        if(isset($_FILES["image"])){

            $errors=array();
            $file_name = $_FILES["image"]["name"];
            $file_size =$_FILES["image"]["size"];
            $file_tmp =$_FILES["image"]["tmp_name"];
            $file_type =$_FILES["image"]["type"];
            $file_ext= strtolower(end(explode('.',$file_name)));

            $allowed_ext=array("png","jpg","jpeg");

            if(in_array($file_ext,$allowed_ext)===false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                echo $errors[0];
            }

            if($file_size > 2097152){
                $errors[]='File size must be excately 2 MB';
                echo $errors[0];
            }

            if(empty($errors)){
                $filenameRa = "player- ".generateRandomString(). "." . $file_ext;
                move_uploaded_file($file_tmp,"./img/".$filenameRa);

                 // Reference: https://medoo.in/api/insert
                $database->insert("tb_players",[
                    "player_name"=>$_POST["name"], 
                    "score"=>$_POST["score"],
                    "id_country"=>$_POST["contry"],
                    "player_photo"=>$filenameRa
                ]);

                header("Location: ./players.php");
            }
        }
       
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
    <form action="./player.php" method="POST" enctype="multipart/form-data">
        <img id="preview" src="./img/previewImage.png" alt="preview" style="width: 100px; height: 100px"><!-- arreglar -->
        <input type="file" name="image" onchange="previewFile(this)">
        <label for="name">Name</label>
        <input type="text" name="name">
        <label for="score">Score</label>
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
    <script>
        function previewFile(input) {
            let reader = new FileReader();
            if (input.files && input.files[0]) {
                reader.onload = function(){
                    let preview = document.getElementById('preview');
                    preview.src = reader.result;
                }
                 reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>