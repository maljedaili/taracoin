<?php require 'inc/header.php'; ?>

<?php

$id = $_GET['id'];

$sqlProduct = "SELECT p.*, u.username, c.categories_name FROM products AS p LEFT JOIN users AS u ON p.author = u.id LEFT JOIN categories AS c ON p.category = c.categories_id WHERE p.products_id = {$id} ";

$product = $connect->query($sqlProduct)->fetch(PDO::FETCH_ASSOC);
?>
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
