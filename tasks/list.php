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
//$tasks = [];

$filterOwner = $_GET["author"] ?? "";
$isCompleted = ($_GET["status"] ?? "") === "" ? null : filter_var($_GET["status"], FILTER_VALIDATE_BOOL);

$filteredTasks = array_filter($tasks, function ($taskData) use ($isCompleted, $filterOwner) {
    return ($isCompleted === null || $taskData['status'] === $isCompleted) && str_starts_with($taskData['author'], $filterOwner);
});
//$filteredTasks = array_filter($tasks, fn ($taskData) =>  $taskData['status'] === $isCompleted);
?>


<?php require_once "./layouts/header.php"; ?>
    <form>
        <h2>Filters</h2>
        <input type="text" placeholder="Search by author" name="author" value="<?= $_GET['author'] ?? '' ?>"/>
        Status :
            <label>Completed<input type="radio" name="status" value="1" <?= $isCompleted === true ? "checked" : ''?>/></label>
            <label>Not completed<input type="radio" name="status" value="0" <?= $isCompleted === false ? "checked" : ''?>/></label>
            <label>All <input type="radio" name="status" value="" <?= $isCompleted === null ? "checked" : ''?>/></label>
        <input type="submit" value="Filtrer"/>
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
            <?php if (!count($tasks)) : ?>
                <tr><td colspan="3">Aucune tâche</td></tr>
            <?php elseif (!count($filteredTasks)) : ?>
                <tr><td colspan="3">Aucune tâche correspondante aux filtres</td></tr>
            <?php else : ?>
                <?php foreach($filteredTasks as $taskName => $taskData) : ?>
                    <tr>
                        <td><?= $taskName ?></td>
                        <td><?= $taskData["author"] ?></td>
                        <td><?= $statusLocales[$taskData["status"]] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
<?php require_once "./layouts/footer.php"; ?>