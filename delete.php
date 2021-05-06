<?php require 'inc/header.php';

$id = $_POST['id'];

$token = $_POST['csrf_token'];


if (isset($_POST['delete']) && hash_equals($token, $_POST['csrf_token'])) {
    try {
        $sth = $connect->prepare("DELETE FROM users WHERE id =:id");
        $sth->bindValue(':id', $id);

        $result = $sth->execute();
        if ($result) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            echo "Il ya eu un problème avec votre requête, contactez le support";
        }
    } catch (PDOException $error) {
        echo 'Erreur: ' . $error->getMessage();
    }
}
?>