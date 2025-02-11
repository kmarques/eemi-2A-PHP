<?php require_once "./layouts/header.php"; ?>
    <h2>Créer un produit</h2>
    <!-- Formulaire d'ajout de tâches -->
    <form action="" method="post">
        <input name="name" placeholder="Product name"/>
        <input name="price" type="number" step="0.1" placeholder="Type a price"/>
        <input type="submit" value="Créer"/>
    </form>
    
    <a href="/products">Retour</a>
<?php require_once "./layouts/footer.php"; ?>