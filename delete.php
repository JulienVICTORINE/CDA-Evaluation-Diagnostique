<?php
    include("db.php");

    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $sql = "DELETE FROM task WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
            $script_dir = dirname($_SERVER['SCRIPT_NAME']);
            header('Location: '.$script_dir);
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
?>