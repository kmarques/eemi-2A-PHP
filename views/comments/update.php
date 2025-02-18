<?php require_once "./layouts/header.php"; ?>
    <h2>Mettre à jour le produit #<?= $comment['id'] ?></h2>
    <!-- Formulaire d'ajout de tâches -->
    <form action="" method="post">
        <input name="name" value="<?= $comment['name'] ?>" placeholder="comment name"/>
        <input name="price" value="<?= $comment['price'] ?>" type="number" step="0.1" placeholder="Type a price"/>
        <input type="submit" value="Enregistrer"/>
    </form>
    
    <a href="/comments">Retour</a>
<?php require_once "./layouts/footer.php"; ?>