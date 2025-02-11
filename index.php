<?php

require_once "./lib/db.php";

// /index.php?page=list-tasks
// /index.php?page=list-products
function index()
{
    echo "<h1>Welcome to the best website of your life</h1>";
}

function listTasks()
{
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

    if (!count($tasks)) {
        echo "Aucune tâche";
        exit(0);
    }

    $filterOwner = $_GET["author"] ?? "";
    $isCompleted = filter_var($_GET["status"] ?? "", FILTER_VALIDATE_BOOL) ?? false;

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
            . "<br>";
    }
}

function listTasksFromFile()
{
    $pageTitle = "Liste de tâches";



    require_once "./tasks/list.php";
}

function listProducts()
{
    $products = [
        "Banane" => 1.5,
        "Pomme" => 2,
        "Poire" => 2.5,
        "Fraise" => 3
    ];

    $total = 0;

    foreach ($products as $productName => $productPrice) {
        echo $productName . " "
            . $productPrice
            . "<br>";
        $total += $productPrice;
    }

    echo "Total: " . $total;
}

function editTasksFromFile()
{
    require_once "./tasks/edit.php";
}

function actionCreateProduct()
{
    require_once "./repositories/product.php";

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        ["name" => $name, "price" => $price] = $_POST;
        createProduct($products, [
            "name" => $name,
            "price" => $price
        ]);
    }

    require_once "./views/products/create.php";
}


$action = $_SERVER['REQUEST_URI'];

switch (substr(strtok($action, '?'), 1)) {
    case "list-tasks":
        listTasksFromFile();
        break;
    case "edit-tasks/(?<id>\d+)":
        editTasksFromFile();
        break;
    case "create-product":
        actionCreateProduct();
        break;
    case "list-products":
        listProducts();
        break;
    case "":
        index();
        break;
    default:
        echo "404";
        break;
}
