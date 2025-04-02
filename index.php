<?php
    include("db.php");

    // vérifie l'existance de la donnée pour ajouter une tache
    if (isset($_POST['name'])) {
        $name = $_POST['name']; // valeur de l'input avec name="name"
        $sql = "INSERT INTO task (name) VALUES ('$name')";
        $conn->query($sql);
    }

    // Afficher toutes les tâches
    $sql = "SELECT * FROM task";
    $tasks = $conn->query($sql);

    $conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main-container">
        <h1>Task Manager</h1>
        <form method="post" id="form1">
            <input type="text" placeholder="Nom de la tâche">
            <button>+</button>
        </form>
        <ul>
            <li>Courses <button>x</button></li>
            <li>Vaisselles <button>x</button></li>    
        </ul>
    </div>
</body>
</html>