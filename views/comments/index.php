<?php require_once "./layouts/header.php"; ?>
    <h2>Listing des produits</h2>
    <a href="/comments/create">Create</a>
    <table>
        <caption>Liste des produits</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Comment</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($comments as$comment) : ?>
                <tr>
                    <td><?= $comment["id"] ?></td>
                    <td><?= $comment["name"] ?></td>
                    <td><?= htmlspecialchars($comment["comment"]) ?></td>
                    <td>
                        <a href="/comments/<?= $comment['id']?>/update">Update</a>
                        <a href="/comments/<?= $comment['id']?>/delete">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php require_once "./layouts/footer.php"; ?>