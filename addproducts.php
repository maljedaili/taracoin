<?php require 'inc/header.php' ?>
<?php


$sqlCategory = 'SELECT * FROM categories';


$categories = $connect->query($sqlCategory)->fetchAll();


if (isset($_POST['product_submit']) && !empty($_POST['product_name']) && !empty($_POST['product_price']) && !empty($_POST['product_description']) && !empty($_POST['product_category'])) {


    $name = strip_tags($_POST['product_name']);
    $description = strip_tags($_POST['product_description']);
    $price = intval(strip_tags($_POST['product_price']));
    $category = strip_tags($_POST['product_category']);
    $user_id = $_SESSION['id'];

    if (is_int($price) && $price > 0) {
        try {
            $sth = $connect->prepare("INSERT INTO products
            (products_name,products_description,products_price, author, category)
            VALUES
            (:products_name,:products_description,:products_price, :author, :category)");
            $sth->bindValue(':products_name', $name);
            $sth->bindValue(':products_description', $description);
            $sth->bindValue(':products_price', $price);
            $sth->bindValue(':author', $user_id);
            $sth->bindValue(':category', $category);

            $sth->execute();

            echo "Votre article a bien été ajouté";

            header('Location: products.php');
        } catch (PDOException $error) {
            echo 'Erreur: ' . $error->getMessage();
        }
    }
}
?>

<main class="px-3">
    <div class="row">
        <div class="col-12">
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="InputName">Nom de l'article</label>
                    <input type="text" class="form-control" id="InputName" placeholder="Nom de votre article" name="product_name" required>
                </div>
                <div class="form-group">
                    <label for="InputDescription">Description de l'article</label>
                    <textarea class="form-control" id="InputDescription" rows="3" name="product_description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="InputPrice">Prix de l'article</label>
                    <input type="number" min="1" max="999999" class="form-control" id="InputPrice" placeholder="Prix de votre article en €" name="product_price" required>
                </div>
                <div class="form-group">
                    <label for="InputCategory">Catégorie de l'article</label>
                    <select class="form-control" id="InputCategory" name="product_category" required>
                        <?php
                       
                        foreach ($categories as $category) {
                        ?>
                            <option value="<?php echo $category['categories_id']; ?>">
                                <?php echo $category['categories_name']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <hr>
                <button type="submit" class="btn btn-success" name="product_submit">Save</button>
            </form>
        </div>
    </div>
</main>
