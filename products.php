<?php require 'inc/header.php' ?>
<?php

$sqlProducts = "SELECT p.*, u.username, c.categories_name FROM products AS p LEFT JOIN users AS u ON p.author = u.id LEFT JOIN categories AS c ON p.category = c.categories_id";

$products = $connect->query($sqlProducts)->fetchAll(PDO::FETCH_ASSOC);
?>
<section >
<?php
        foreach ($products as $product) {
        ?>
    
    <div class="columns">
        <ul class="price">
            
            <li class="header"><?php echo $product['products_name']; ?></li>
            
            <figure class="image is-4by3"> 
                <img src="assets/img/pic13.jpg" alt="">  
                <p class="card-text"><?php echo $product['products_description']; ?> </p>    
            <li class="grey"><?php echo $product['products_price']; ?>
                <li><?php echo $product['categories_name']; ?></li>
                <li><?php echo $product['created_at']; ?></li>
                
            </li>
            <li class="grey"><a href="product.php?id=<?php echo $product['products_id']; ?>" class="btn">Display article</a></li>
            <li class="grey"><a href="editproducts.php?id=<?php echo $product['products_id']; ?>" class="btn"> Edit article</a></li>
                      
     </ul>

    </div>
        <?php
        }
        ?>
  
    </section>


