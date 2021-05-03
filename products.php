<?php require 'inc/header.php' ?>
<?php
//! Affichage de tous les produits. Il faudra une requête SQL qui récupère tous les produits, et qui les affiche dans des cartes séparées.

//? Création de ma requête SQL. Vu que j'ai des colonne qui font référence à d'autres tables, je dois ajouter des jointures sur category et author.
$sqlProducts = "SELECT p.*, u.username, c.categories_name FROM products AS p LEFT JOIN users AS u ON p.author = u.id LEFT JOIN categories AS c ON p.category = c.categories_id";

//? Le résultat de ma requête est affiché dans un tableau associatif à l'aide du chaînage de méthodes.
$products = $connect->query($sqlProducts)->fetchAll(PDO::FETCH_ASSOC);
?>
<main class="px-3">
    <div class="row">
        <?php
        //? Je veux afficher tous mes produits, selon le même modèle, donc je fais une boucle, et j'insère les données dynamiques dans une carte sur laquelle je ferais une boucle. Résultat: J'obtiens autant de cartes que de produits, et toutes les cartes respectent le même format HTML.
        foreach ($products as $product) {
        ?>
            <div class="card mx-2 text-white bg-info" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $product['products_name']; ?>
                    </h5>
                    <p class="card-text"><?php echo $product['products_description']; ?>
                    </p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?php echo $product['products_price']; ?>
                            €</li>
                    </ul>
                    <p><?php echo $product['categories_name']; ?></p>
                    <p><?php echo $product['created_at']; ?></p>
                    <!-- //? Je veux ajouter une page de détails, donc je crée un lien qui utiliseras une requête GET contenant l'id de mon produit pour afficher la page de détails du produit en question. -->
                    <a href="product.php?id=<?php echo $product['products_id']; ?>" class="card-link btn btn-primary">Afficher article</a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</main>

<?php require 'inc/footer.php' ?>