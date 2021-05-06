<?php require 'inc/header.php' ?>
<?php

if (!empty($_SESSION)) {
    $user_id = $_SESSION['id'];

    $sqlUser = "SELECT * FROM users WHERE id = '{$user_id}'";

    $resultUser = $connect->query($sqlUser);

    if ($user = $resultUser->fetch(PDO::FETCH_ASSOC)) {
?>

        <main class="px-3">
            <div class="row">
                <div class="col-8">
                    <h3>WELCOME <?php echo $user['username']; ?>
                    </h3>
                    <p>You have the ROLE_USER role <?php echo $user['role']; ?></p>
                </div>
                <div class="col-3 offset-1">
                    <a href="products.php" class="btn btn-primary my-2">  SEE your Products</a>
                      
                      
                    </button>
                    <a href="addproducts.php" class="btn btn-primary my-2"> ADD Product </a>
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
