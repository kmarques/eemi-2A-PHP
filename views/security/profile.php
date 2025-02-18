<?php require_once "./layouts/header.php"; ?>
    <h2>Mettre à jour mon profil #<?= $user['email'] ?></h2>
    <!-- Formulaire d'ajout de tâches -->
    <form action="" method="post">
        <input name="email" value="<?= $user['email'] ?>" placeholder="Email"/>
        <input type="submit" value="Enregistrer"/>
    </form>
    
    <a href="/">Retour</a>
<?php require_once "./layouts/footer.php"; ?>