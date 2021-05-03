<?php require 'inc/header.php'; ?>

<!-- //! Affichage d'un produit en détails -->
<?php

//? J'insère la valeur de l'id de ma requête GET dans une variable qui va me servir à récupérer un produit depuis la BDD
$id = $_GET['id'];

//? Création de ma requête SQL. Vu que j'ai des colonnes qui font référence à d'autres tables, je dois ajouter des jointures sur category et author. Je rajoute aussi la condition WHERE products_id = {$id} afin de récupérer le produit souhaité
$sqlProduct = "SELECT p.*, u.username, c.categories_name FROM products AS p LEFT JOIN users AS u ON p.author = u.id LEFT JOIN categories AS c ON p.category = c.categories_id WHERE p.products_id = {$id} ";

//? Le résultat de ma requête est affiché dans un tableau associatif à l'aide du chaînage de méthodes.
$product = $connect->query($sqlProduct)->fetch(PDO::FETCH_ASSOC);
?>
<!-- //? Ici pas besoin de boucle, puisque je ne récupère qu'un seul produit. -->
<main class="px-3">
    <div class="row">
        <div class="col-12">
            <h1><?php echo $product['products_name']; ?>
            </h1>
            <p>Catégorie : <?php echo $product['categories_name']; ?>
            </p>
            <p><?php echo $product['products_description']; ?>
            </p>
            <p>Vendu par : <?php echo $product['username']; ?>
            </p>
            <p>Annonce publiée le : <?php echo $product['created_at']; ?>
            </p>
            <button class="btn btn-danger"><?php echo $product['products_price']; ?> € </button>
        </div>
    </div>
</main>

<?php require 'inc/footer.php'; ?>