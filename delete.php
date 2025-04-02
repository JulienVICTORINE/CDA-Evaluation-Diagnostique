<!-- Supprimer une tâche dans une BDD en fonction de son ID -->

<?php
    // Connexion à la base de données
    include("db.php");

    // Vérifie si le paramètre ID est présent dans l'URL
    // s'il existe, il est récupéré et stocké dans la variable $id
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $sql = "DELETE FROM task WHERE id=$id";

        if ($conn->query($sql) === TRUE) { // si suppression est réussie
            echo "Record deleted successfully";
            // redirection vers la page d'origine
            $script_dir = dirname($_SERVER['SCRIPT_NAME']);
            header('Location: '.$script_dir);
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
?>