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
</head>
<body>
    <a href="./index.php"><input type="button" value="Home"></a>
    <p>Hi, <?php echo "<strong>".$_SESSION["username"]. "</strong >"; ?></p>
    <h1>Users registered</h1>
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
    
    
</body>
</html>