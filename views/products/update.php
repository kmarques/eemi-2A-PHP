<?php require_once "./layouts/header.php"; ?>
    <h2>Mettre à jour le produit #<?= $product['id'] ?></h2>
    <!-- Formulaire d'ajout de tâches -->
    <form action="" method="post">
        <input name="name" value="<?= $product['name'] ?>" placeholder="Product name"/>
        <input name="price" value="<?= $product['price'] ?>" type="number" step="0.1" placeholder="Type a price"/>
        <input type="submit" value="Enregistrer"/>
    </form>
    
    <a href="/products">Retour</a>
<?php require_once "./layouts/footer.php"; ?>