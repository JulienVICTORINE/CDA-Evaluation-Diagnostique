<?php
    include("db.php");

    // vérifie l'existance de la donnée pour ajouter une tache
    if (isset($_POST['name'])) {
        $name = $_POST['name']; // valeur de l'input avec name="name"
        $sql = "INSERT INTO task (name) VALUES ('$name')";
        $conn->query($sql);
    }

    if (isset($_POST['update'])) {
        $name = $_POST['update'];  // valeur de l'input
        $id = $_POST['id'];
        $sql = "UPDATE task SET name='$name' WHERE id=$id";
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
            <?php
                if ($tasks->num_rows > 0) {
                    // output data of each row
                    while ($row = $tasks->fetch_assoc()) {
                        ?>
                        <li id="<?php echo $row["id"] ?>">
                            <?php echo $row["name"] ?> <button class="edit" id="edit<?php echo $row["id"] ?>">
                                <img height="10px" src="edit.svg" />
                            </button><a href="delete.php?id=<?php echo $row["id"] ?>"><button>x</button></a>
                        </li>
                        <script>
                            let li <?php $row["id"] ?> = document.getElementById(<?php $row["id"] ?>);
                            let editbutton <?php $row["id"] ?> = document.getElementById("edit <?php $row["id"] ?>");
                            editbutton <?php $row["id"] ?>.addEventListener("click", ()=>{
                                form1.style.display = "none";
                                li<?=$row["id"] ?>.innerHTML = `<form method="post">
                                <input type="hidden" name="id" value="<?=$row["id"]?>"/>
                                <input type="text" name="update" value="<?=$row["name"]?>"  />
                                <button>Update</button>
                                </form> `;
                            });
                            </script>
                            
                    <?php
                        }
                }
                ?>
            <!-- <li>Courses <button>x</button></li>
            <li>Vaisselles <button>x</button></li>     -->
        </ul>
    </div>
</body>
</html>