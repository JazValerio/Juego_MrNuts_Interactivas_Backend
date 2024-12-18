<?php 
    require '../db.php';

    $configs = $database->select("tb_game_config","*");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game-Config</title>
    <link rel="stylesheet" href="../Juego_MrNuts/css/main.css">
</head>
<body>
    <header class="header-section">
        <h1 class="title">Game Configs</h1>
        <a href="../admin.php"><input class="btn btn-login" type="button" value="Home"></a>
    </header>

    <section class="admin-section">
        <H2 class="subtitle text-center ">List of Configs for the Game</H2>
        <p class="pdb2"> Here you can see all the configs for the game and create a new one to personalize the game</p>

        <table border="1">
            <tr>
                <th>Id</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>

            <?php 
            foreach ($configs as $config) {
                echo "<tr>";
                    echo "<td> GC- {$config["id_game_config"] }</td>";
                    echo "<td>" . $config["created_at"] . "</td>";
                    echo "<td>" . $config["updated_at"] . "</td>";
                    echo "<td class='options'>
                            <a target='_blank' href='./api.php?id=" . $config["id_game_config"] . "'>View</a> 
                            <a href='./edit.php?id=" . $config["id_game_config"] . "'>Edit</a> 
                            <a href='./delete.php?id=" . $config["id_game_config"] . "'>Delete</a>
                    </td>";

                echo "</tr>";
            } 
            ?>
        </table>
        <a class="nav-list-item "  href="./add.php">Create a New JSON</a>
    </section>

    <footer>
    <p class="text-center">&copy; 2024 Game Platform MrNuts.</p>
    </footer>
    
</body>
</html>