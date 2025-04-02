<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cda_task_manager2";

    // Créer la connexion à la base de données
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Checker la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>