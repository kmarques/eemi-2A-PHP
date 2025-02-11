<?php require_once "./layouts/header.php"; ?>
    <h2>Listing des produits</h2>
    <a href="/products/create">Create</a>
    <table>
        <caption>Liste des produits</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as$product) : ?>
                <tr>
                    <td><?= $product["id"] ?></td>
                    <td><?= $product["name"] ?></td>
                    <td><?= $product["price"] ?></td>
                    <td>
                        <a href="/products/<?= $product['id']?>/update">Update</a>
                        <a href="/products/<?= $product['id']?>/delete">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php require_once "./layouts/footer.php"; ?>