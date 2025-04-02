<?php
    include("db.php");

    // vérifie l'existance de la donnée pour ajouter une tache
    if (isset($_POST['name'])) {  //s'assurer que l'utilisateur a bien soumis une tâche via un formulaire
        $name = $_POST['name']; // valeur de l'input avec name="name"
        $sql = "INSERT INTO task (name) VALUES ('$name')";
        $conn->query($sql);
    }

    // mise à jour d'une tahce existante
    if (isset($_POST['update'])) {
        $name = $_POST['update'];  // valeur de l'input 
        $id = $_POST['id']; // id de la tahce à modifier
        $sql = "UPDATE task SET name='$name' WHERE id=$id";
        $conn->query($sql);
    }


    // récupération et affichage de toutes les tâches
    $sql = "SELECT * FROM task";
    $tasks = $conn->query($sql); // $tasks contient le résultat sous forme d'un objet MySQLi, utilisable pour afficher les tâches avec une boucle while

    // Fermer la connexion à la base de données après l'exécution des requêtes
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
                if ($tasks->num_rows > 0) { // si la requête a renvoyé au moins une tâche
                    // output data of each row
                    while ($row = $tasks->fetch_assoc()) { //on va afficher chaque tâche une par une. C'est récupérer une ligne de la base de données sous forme de tableau associatif
                        ?>
                        <li id="<?php echo $row["id"] ?>">  <!-- chaque <li> a un id unique basé sur l'ID de la tâche -->
                            <?php echo $row["name"] ?> <button class="edit" id="edit<?php echo $row["id"] ?>"> <!-- bouton de modification pour éditer la tache -->
                                <img height="10px" src="edit.svg" />
                            </button><a href="delete.php?id=<?php echo $row["id"] ?>"><button>x</button></a> <!-- bouton de suppression qui redirige vers delete.php?id=id de la tache -->
                        </li>
                        <script>
                            let li<?=$row["id"]?> = document.getElementById("<?=$row["id"]?>");                            let editbutton <?php $row["id"] ?> = document.getElementById("edit <?php $row["id"] ?>");
                            editbutton <?=$row["id"] ?>.addEventListener("click", ()=>{
                                form1.style.display = "none";
                                li<?=$row["id"] ?>.innerHTML = `<form method="post">
                                <input type="hidden" name="id" value="<?=$row["id"]?>"/>
                                <input type="text" name="update" value="<?=$row["name"]?>"  />
                                <button>Update</button>
                                </form> `;
                            });
                        </script>

                        <!-- 
                            Quand on clique sur "Modifier", le formulaire principal est masqué
                            La tâche sélectionnée est remplacée par un formulaire pour modifier son nom
                            un champ "hidden" est ajouté pour conserver l'ID de la tâche
                        -->
                            
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