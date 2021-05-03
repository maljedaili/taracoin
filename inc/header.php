<?php require 'inc/config.php'; ?>

<!DOCTYPE HTML>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title>Le Chouette Coin</title>
    <link href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css";>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<header>
    <nav id="nav">
        
         <ul>
			<li class="current"><a href="index.php">Home</a></li>
			<li><a href="left-sidebar.html">Produits</a></li>
			<li><a href="login.php">Se connecter</a></li>
            <!-- //? Affichage conditionnel du bouton se connecter/ page de profil -->
            <?php
                    //? Vérification des variables des sessions : si elle n'existent pas, alors afficher un bouton se connecter
                    if (empty($_SESSION)) {
                    ?>
                        <a class="nav-link" href="login.php">Se connecter</a>
                    <?php
                        //? Si elles existent, afficher un bouton qui redirige vers la page de profil et un bouton de déconnexion
                    } else {
                    ?>
                        <!-- //? J'affiche le nom de l'utilisateur connecté qui est stocké en token de session dans le bouton -->
                        <a class="nav-link" href="profile.php"><?php echo $_SESSION['username']; ?></a>
                        <!-- //? Pour me déconnecter j'envoie une requête GET avec l'info logout qui permet de se déconnecter de n'importe où. -->
                        <a class="nav-link" href="?logout">Se déconnecter</a>
                    <?php
                    }
                    ?>
            
		</ul>
        </nav>
	
