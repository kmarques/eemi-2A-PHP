<?php require_once "./layouts/header.php"; ?>
    <h2>Créer un Commentaire</h2>
    <!-- Formulaire d'ajout de tâches -->
    <form action="" method="post">
        <input name="name" placeholder="comment name"/>
        <textarea name="comment" placeholder="Type a comment"></textarea>
        <input type="submit" value="Créer"/>
    </form>
    
    <a href="/comments">Retour</a>
<?php require_once "./layouts/footer.php"; ?>