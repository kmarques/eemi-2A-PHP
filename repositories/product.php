<?php

require_once './lib/db.php';

function createProduct(PDO $pdo, array $productData): array
{
    $pdo->query("INSERT INTO products (name, price) VALUES ('{$productData['name']}', {$productData['price']})");
    $newProductId = $pdo->lastInsertId();
    $newProduct = $pdo->query("SELECT * FROM products WHERE id = {$newProductId}")->fetch();

    return $newProduct;
}

function fetchProducts(PDO $pdo): array
{
    $statement = $pdo->query("SELECT * FROM products");
    return $statement->fetchAll();
}

function fetchProduct(PDO $pdo, int $productId): array|false
{
    $statement = $pdo->query("SELECT * FROM products WHERE id={$productId}");
    return $statement->fetch();
}

function deleteProduct(PDO $pdo, int $productId): bool
{
    $return = $pdo->query("DELETE FROM products WHERE id = {$productId}");
    $return = $return->rowCount();
    return $return === 1;
}

function updateProduct(PDO $pdo, int $productId, array $newProductData): ?array
{
    $sets = [];
    foreach ($newProductData as $key => $value) {
        switch ($key) {
            case 'name':
                $sets[] = "{$key} = '{$value}'";
                break;
            default:
                $sets[] = "{$key} = {$value}";
                break;
        }
    }
    $sets = implode(', ', $sets);
    $return = $pdo->query("UPDATE products SET {$sets} WHERE id = {$productId}");

    if ($return->rowCount()) {
        return $pdo->query("SELECT * FROM products WHERE id = {$productId}")->fetch();
    }
}
