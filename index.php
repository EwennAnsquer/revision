<?php
    include('api.php');

    $products = getProducts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="http://localhost/BTS-2023-2024/revision/addProduct.php">Ajouter un produit</a>
    </nav>
    <main>
        <?php
            foreach ($products as $p) {
                ?>
                <div>
                    <?php 
                    foreach ($p as $key=>$v) {
                        if(!is_array($v)){
                            if($key == "image"){
                                echo "<img src='$v'></img>";
                            }else{
                                echo "<p>".$key.": ".$v."</p>";
                            }
                        }else{
                            foreach ($v as $t) {
                                echo "<p>".$t."</p>";
                            }
                        }
                    } ?>
                </div>
                <?php
            }
        ?>
    </main>
</body>
</html>