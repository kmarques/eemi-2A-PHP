<?php

function printTitle($msg)
{
    echo $msg . PHP_EOL;
}

printTitle("Exo1");

$tasks = ["Faire les courses", "Faire le ménage", "Faire la vaisselle"];

// Implémentation simple
echo "V1\n";
foreach ($tasks as $task) {
    echo $task . PHP_EOL;
}
echo "V2\n";
echo implode(PHP_EOL, $tasks).PHP_EOL;


printTitle("Exo2");
$tasks = ["Faire les courses" => ["status" => false], "Faire le ménage" => ["status" => true], "Faire la vaisselle" => ["status" => false]];
foreach ($tasks as $taskName => $taskData) {
    echo $taskName
        . (
            $taskData["status"] === true
            ? " Completed"
            : " Not completed"
        ) . PHP_EOL;
}

echo "V2\n";
$statusLocales = [
    true => "Completed",
    false => "Not completed"
];
foreach ($tasks as $taskName => $taskData) {
    echo $taskName . " "
        . $statusLocales[$taskData["status"]]
        . PHP_EOL;
}

printTitle("Exo 3");
$isCompleted = false;
echo "V1\n";
foreach ($tasks as $taskName => $taskData) {
    // "" == false => true
    // "" == false => true
    // "" == false => true
    // "" != false => false

    // "" === false => false
    // "" !== false => true

    if ($taskData['status'] != $isCompleted) {
        continue;
    }
    echo $taskName . " "
        . $statusLocales[$taskData["status"]]
        . PHP_EOL;
}

echo "V2\n";
$filteredTasks = array_filter($tasks, function ($taskData) use ($isCompleted) {
    return $taskData['status'] === $isCompleted;
});
//$filteredTasks = array_filter($tasks, fn ($taskData) =>  $taskData['status'] === $isCompleted);

foreach ($filteredTasks as $taskName => $taskData) {
    echo $taskName . " "
        . $statusLocales[$taskData["status"]]
        . PHP_EOL;
}
printTitle("Exo 4/5/6/7");
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

if (!count($tasks)) {
    echo "Aucune tâche";
    exit(0);
}

$filterOwner = "dsf";
$isCompleted = false;

$filteredTasks = array_filter($tasks, function ($taskData) use ($isCompleted, $filterOwner) {
    return $taskData['status'] === $isCompleted && str_starts_with($taskData['author'], $filterOwner);
});
//$filteredTasks = array_filter($tasks, fn ($taskData) =>  $taskData['status'] === $isCompleted);

if (!count($filteredTasks)) {
    echo "Aucune tâche correspondante aux filtres";
    exit(0);
}

foreach ($filteredTasks as $taskName => $taskData) {
    echo $taskName . " "
        . $statusLocales[$taskData["status"]]
        . PHP_EOL;
}
