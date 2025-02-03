<?php
$statusLocales = [
    true => "Completed",
    false => "Not completed"
];
$tasks = [
    "Faire les courses" => [
        "status" => false, "author" => "fcjkzledfnzl"
    ],
    "Faire le ménage" => [
        "status" => true, "author" => "dsferqfgq"
    ],
    "Faire la vaisselle" => [
        "status" => false, "author" => "fcrgehb"
    ],
    "Faire ses devoirs" => [
        "status" => false, "author" => "dsrgehb"
    ]
];

// TP: Algo qui ajoute une nouvelle tâche à la précédente liste de tâches
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $newTaskTitle = trim($_POST['title']);
    $newTaskAuthor = trim($_POST['author']);
    $tasks[$newTaskTitle] = [
        "status" => false, "author" => $newTaskAuthor
    ];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de tâches</title>
</head>
<body>
    <h2>Créer une tâche</h2>
    <!-- Formulaire d'ajout de tâches -->
    <form action="" method="post">
        <input name="title" placeholder="Type a title"/>
        <input name="author" placeholder="Type an author"/>
        <input type="submit" value="Créer"/>
    </form>
    
    <table>
        <caption>Liste des tâches</caption>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($tasks as $taskName => $taskData) : ?>
                <tr>
                    <td><?= $taskName ?></td>
                    <td><?= $taskData["author"] ?></td>
                    <td><?= $statusLocales[$taskData["status"]] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>