<?php require 'inc/header.php' ?>
<?php


$id = $_GET['id'];

$sqlProduct = "SELECT p.*, u.username, c.categories_name FROM products AS p LEFT JOIN users AS u ON p.author = u.id LEFT JOIN categories AS c ON p.category = c.categories_id WHERE p.products_id = {$id}";

$product = $connect->query($sqlProduct)->fetch(PDO::FETCH_ASSOC);

?>

<?php

$sqlCategory = 'SELECT * FROM categories';


$categories = $connect->query($sqlCategory)->fetchAll();



if (isset($_POST['product_submit']) && !empty($_POST['product_name']) && !empty ($_POST['product_description']) && !empty($_POST['product_category'])){
    
    
    $name = strip_tags($_POST['product_name']);
    $description = strip_tags($_POST ['product_name']);
    $price = intval(strip_tags ($_POST ['product_price']));
    $category = strip_tags($_POST['product_category']);
    $user_id = $_SESSION['id'];
    
    
    if ( is_int($price) && $price >0){
        try{

            $sth = $connect->prepare("UPDATE products
            SET
            products_name=:products_name,products_description=:products_description,products_price=:products_price, category=:category WHERE products_id=:id");

            $sth->bindValue(':products_name', $name);
            $sth->bindvalue(':products_description', $description);
            $sth->bindvalue(':products_price', $price);
            $sth->bindvalue(':category', $category);
            $sth->bindvalue(':id' , $id);

            $sth->execute();

            echo " Your article has been updated";

            header('Location:product.php?id='.$id); 
            
        } catch ( PDOException $error) {
            echo 'Erreur :' . $error ->getMessage();
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
                    <input type="text" class="form-control" id="InputName" placeholder="Nom de votre article" name="product_name" value="<?php echo $product['products_name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="InputDescription">Description de l'article</label>
                    <textarea class="form-control" id="InputDescription" rows="3" name="product_description" required><?php echo $product['products_description']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="InputPrice">Prix de l'article</label>
                    <input type="number" min="1" max="999999" class="form-control" id="InputPrice" placeholder="Prix de votre article en €" name="product_price" value=<?php echo $product['products_price']; ?> required>
                </div>
                <div class="form-group">
                    <label for="InputCategory">Catégorie de l'article</label>
                    <select class="form-control" id="InputCategory" name="product_category" required>
                                <?php echo $product['category']; ?>"><?php echo $product['categories_name']; ?></option> -->
                        <?php
                        foreach ($categories as $category) {
                        ?>
                            <option <?php echo $category['categories_id'] === $product['category'] ? 'selected' : ''; ?> value="<?php echo $category['categories_id']; ?>">
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