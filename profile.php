<?php require 'inc/header.php' ?>
<?php
//! Récupérer toutes les infos relatives à l'utilisateur connecté depuis la base de données. En ce moment dans le token de session on possède l'id de l'utilisateur, son username et son email. Il faut éventuellement récupérer tout le reste depuis la base de données.

if (!empty($_SESSION)) {
    //? 1. On insère l'id de session dans une variable qui va servir pour une requête SQL si il y a un utilisateur connecté
    $user_id = $_SESSION['id'];

    //? 2. On réalise une requête SQL de récupération de données (SELECT) qui utilise l'id de l'utilisateur connecté pour récupérer toutes sa ligne dans la BDD
    $sqlUser = "SELECT * FROM users WHERE id = '{$user_id}'";

    //? 3. On effectue la requête via PDO sur la base de données.
    $resultUser = $connect->query($sqlUser);

    //? 4. On récupère les données avec un fetch, en précisant que l'on souhaite obtenir les données sous forme de tableau associatif (PDO::FETCH_ASSOC)
    if ($user = $resultUser->fetch(PDO::FETCH_ASSOC)) {
        // $user = $connect->query($sql)->fetch(PDO::FETCH_ASSOC);
?>

        <main class="px-3">
            <div class="row">
                <div class="col-8">
                    <!-- //* Affichage des infos username et role récupérées depuis la BDD -->
                    <h3>Bienvenue <?php echo $user['username']; ?>
                    </h3>
                    <p>Vous possédez le role <?php echo $user['role']; ?></p>
                </div>
                <div class="col-3 offset-1">
                    <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#exampleModal">
                        Voir mes articles publiés
                    </button>
                    <a href="addproducts.php" class="btn btn-primary my-2"> Ajouter un article </a>
                    <?php
                    if ($user['role'] === 'ROLE_ADMIN') {
                        echo '<a href="admin.php" class="btn btn-success my-2"> Accéder à l\'espace administrateur </a>';
                    }
                    ?>
                </div>
            </div>
        </main>
    <?php
    } else {
        echo " Erreur de connexion, veuillez vous reconnecter";
        session_destroy();
    }
} else {
    ?>
    <main class="px-3">
        <p class="lead">Vous ne pouvez pas accéder à votre profil sans vous connecter</p>
        <p class="lead">
            <a href="login.php" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Se connecter</a>
        </p>
    </main>
<?php
}
?>
