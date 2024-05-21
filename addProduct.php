<?php
    include('api.php');

    $allCategorie=getAllCategories();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifier si tous les champs requis sont présents
        $requiredFields = ["title", "price", "description", "image", "categorie"];
        $missingFields = [];
    
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                $missingFields[] = $field;
            }
        }
    
        if (empty($missingFields)) {
            // Filtrer et valider les données
            $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
            $description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
            $image = filter_var($_POST['image'], FILTER_SANITIZE_URL);
            $categorie = htmlspecialchars($_POST['categorie'], ENT_QUOTES, 'UTF-8');
    
            // Valider le prix comme un nombre à virgule flottante
            if (filter_var($_POST['price'], FILTER_VALIDATE_FLOAT) !== false) {
                $price = $_POST['price'];
            } else {
                $price = false;
            }
    
            if ($title && $price && $description && $image && $categorie) {
                // Appeler la fonction d'ajout de produit
                addProduct($title, $price, $description, $image, $categorie);
            } else {
                echo "Certaines données ne sont pas valides.";
            }
        } else {
            echo "Les champs suivants sont manquants: " . implode(", ", $missingFields);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="title">titre:</label>
        <input type="text" name="title" id="title">
        <br>
        <label for="price">prix:</label>
        <input type="number" name="price" id="price">
        <br>
        <label for="description">description:</label>
        <input type="text" name="description" id="decription">
        <br>
        <label for="image">image:</label>
        <input type="text" name="image" id="image">
        <br>
        <?php
            foreach ($allCategorie as $c) {
                echo'
                    <input type="radio" name="categorie" id="'.$c.'" value="'.$c.'">
                    <label for="'.$c.'">: '.$c.'</label><br>
                ';
            }
        ?>
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>