<?php

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
    require_once "./repositories/product.php";
    $products = fetchProducts($pdo);

    $total = 0;
    foreach ($products as $product) {
        $total += $product['price'];
    }

    require_once "./views/products/index.php";
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
        $newProduct = createProduct($pdo, [
            "name" => $name,
            "price" => $price
        ]);
    }

    require_once "./views/products/create.php";
}
function actionUpdateProduct(int $productId)
{
    require_once "./repositories/product.php";
    $product = fetchProduct($pdo, $productId);

    if (!$product) {
        echo "Product {$productId} not found";
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        ["name" => $name, "price" => $price] = $_POST;
        $product = updateProduct($pdo, $productId, [
            "name" => $name,
            "price" => $price
        ]);
    }

    require_once "./views/products/update.php";
}

function actionDeleteProduct(int $productId)
{
    require_once "./repositories/product.php";
    $result = deleteProduct($pdo, $productId);
    if ($result) {
        echo "Product {$productId} deleted";
    } else {
        echo "Failed to delete product {$productId}";
    }
}


$action = $_SERVER['REQUEST_URI'];
$path = substr(strtok($action, '?'), 1);
$matches = [];

match (true) {
    $path === "" =>        index(),
    $path === "list-tasks" => listTasksFromFile(),
    $path ===  "products" =>        listProducts(),
    $path ===  "products/create" =>        actionCreateProduct(),
    preg_match("/products\/(?<id>\d+)\/update/", $path, $matches) === 1 => actionUpdateProduct($matches['id']),
    preg_match("/products\/(?<id>\d+)\/delete/", $path, $matches) === 1 => actionDeleteProduct($matches['id']),
    default => (function () { echo "404"; })(),
};
