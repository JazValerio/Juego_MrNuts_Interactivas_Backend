<?php 
    require 'db.php';

    // Reference: https://medoo.in/api/where
    $users = $database->select("tb_users","*");
    session_start();
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
    <h1 class="title">Administration Panel</h1>
    <a href="./logout.php"><input class="btn btn-login" type="button" value="Log out"></a>
    </header>

    <section class="admin-section">
        <p class="subtitle text-center">Hi, <?php echo "<strong>".$_SESSION["username"]. "</strong >"; ?></p>
        
        <nav>
            <ul class="top-nav">
                <li><a class="nav-list-item" href="./register.php">Register new user</a></li>
                <li><a class="nav-list-item" href="./player.php">Manage players</a></li>
                <li><a class="nav-list-item" href="../editor/index.php">Game Configs</a></li>
            </ul>
        </nav>
        

        <section>
            <h2>Users registered</h2>
            <table border="1">
                <tr>
                    <td>Username</td>
                    <td>email</td>
                    <td>options</td>
                </tr>

                <?php
                    foreach ($users as $user) {
                        echo "<tr>";
                            echo "<td>" . $user["username"] . "</td>";
                            echo "<td>" . $user["email"] . "</td>";
                            echo "<td><a href='update.php?id=" . $user["id_user"] . "'>Update</a> | <a href='delete.php?id=" . $user["id_user"] . "'>Delete</a></td>";
                        echo "</tr>";
                    }
                ?>
                
            </table>
        </section>
        
    </section>
    
    
    
</body>
</html>