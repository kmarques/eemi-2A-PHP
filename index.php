<?php

session_start();

// /index.php?page=list-tasks
// /index.php?page=list-products
function index()
{
    echo "<h1>Welcome to the best website of your life</h1>";
    if (!isset($_SESSION["visited"])) {
        echo "<br>First time visit";
        $_SESSION["visited"] = true;
    }
    if (isset($_SESSION['user'])) {
        echo "Hello again, {$_SESSION['user']['email']}";
    }
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

function editTasksFromFile()
{
    require_once "./tasks/edit.php";
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
function listComments()
{
    require_once "./repositories/comment.php";
    $comments = fetchComments($pdo);

    require_once "./views/comments/index.php";
}
function actionCreateComment()
{
    require_once "./repositories/comment.php";

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        ["name" => $name, "comment" => $price] = $_POST;
        $newComment = createComment($pdo, [
            "name" => $name,
            "comment" => $price
        ]);
    }

    require_once "./views/comments/create.php";
}
function actionUpdateComment(int $commentId)
{
    require_once "./repositories/comment.php";
    $comment = fetchComment($pdo, $commentId);

    if (!$comment) {
        echo "Comment {$commentId} not found";
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        ["name" => $name, "price" => $price] = $_POST;
        $comment = updateComment($pdo, $commentId, [
            "name" => $name,
            "price" => $price
        ]);
    }

    require_once "./views/comments/update.php";
}
function actionDeleteComment(int $commentId)
{
    require_once "./repositories/comment.php";
    $result = deleteComment($pdo, $commentId);
    if ($result) {
        echo "Comment {$commentId} deleted";
    } else {
        echo "Failed to delete comment {$commentId}";
    }
}

function actionRegister()
{
    require_once "./repositories/user.php";

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        ["email" => $email, "password" => $password] = $_POST;
        $newProduct = createUser($pdo, [
            "email" => $email,
            "password" => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    require_once "./views/security/index.php";
}

function actionLogout()
{
    session_destroy();
}

function actionLogin()
{
    require_once "./repositories/user.php";

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        ["email" => $email, "password" => $password] = $_POST;
        $user = login($pdo, [
            "email" => $email,
        ]);
        if (!$user) {
            echo "Invalid credentials";
            return;
        }
        if (!password_verify($password, $user['password'])) {
            echo "Invalid credentials";
            return;
        }
        $_SESSION["user"] = $user;
    }

    require_once "./views/security/index.php";
}

function actionUpdateProfile()
{
    require_once "./repositories/user.php";
    $user = fetchUser($pdo, $_SESSION['user']['id']);

    if (!$user) {
        echo "User {$_SESSION['user']['id']} not found";
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $user = updateUser($pdo, $_SESSION['user']['id'], $_POST);
    }

    require_once "./views/security/profile.php";
}

function protectedRoute(Closure $closure, $roles = ['USER'])
{
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
    } else {
        $closure();
    }
}


$action = $_SERVER['REQUEST_URI'];
$path = substr(strtok($action, '?'), 1);
$matches = [];

match (true) {
    $path === "" =>        index(),
    $path === "list-tasks" => listTasksFromFile(),
    $path ===  "products" =>        protectedRoute(fn () => listProducts()),
    $path ===  "products/create" =>        protectedRoute(fn () => actionCreateProduct(), ['ADMIN']),
    preg_match("/products\/(?<id>\d+)\/update/", $path, $matches) === 1 => protectedRoute(fn () => actionUpdateProduct($matches['id'])),
    preg_match("/products\/(?<id>\d+)\/delete/", $path, $matches) === 1 => protectedRoute(function () use ($matches) { actionDeleteProduct($matches['id']);}),
    $path ===  "comments" =>        protectedRoute(fn () => listComments()),
    $path ===  "comments/create" =>        protectedRoute(fn () => actionCreateComment(), ['ADMIN']),
    preg_match("/comments\/(?<id>\d+)\/update/", $path, $matches) === 1 => protectedRoute(fn () => actionUpdateComment($matches['id'])),
    preg_match("/comments\/(?<id>\d+)\/delete/", $path, $matches) === 1 => protectedRoute(function () use ($matches) { actionDeleteComment($matches['id']);}),
    $path === "register" => actionRegister(),
    $path === "login" => actionLogin(),
    $path === "logout" => actionLogout(),
    $path === "profile" => actionUpdateProfile(),
    default => (function () { echo "404"; })(),
};
