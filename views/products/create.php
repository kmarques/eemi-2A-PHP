<?php require_once "./layouts/header.php"; ?>
    <h2>Créer un produit</h2>
    <!-- Formulaire d'ajout de tâches -->
    <form action="" method="post">
        <input name="name" placeholder="Product name"/>
        <input name="price" type="number" step="0.1" placeholder="Type a price"/>
        <input type="submit" value="Créer"/>
    </form>
    
    <table>
        <caption>Liste des produits</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as$product) : ?>
                <tr>
                    <td><?= $product["id"] ?></td>
                    <td><?= $product["name"] ?></td>
                    <td><?= $product["price"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php require_once "./layouts/footer.php"; ?>