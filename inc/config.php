<?php

try {
    $connect = new PDO("mysql:host=localhost;dbname=le_chouette_coin", 'root', '');
    // Définir le mode d'erreur de PDO sur Exception
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    session_start();
} catch (PDOException $error) {

    echo 'Erreur: ' . $error->getMessage();
    // echo "Erreur: { $error->getMessage() }";

}

//? Si je reçois une requête GET avec l'info 'logout', alors je dois supprimer la session et rediriger vers la page d'Accueil
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
}
