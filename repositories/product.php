<?php

require_once './lib/db.php';

$products = [
    [
        "id" => uniqid(),
        "name" => "Banane",
        "price" => 1.5,
    ],
    [
        "id" => uniqid(),
        "name" => "Pomme",
        "price" => 2,
    ],
    [
        "id" => uniqid(),
        "name" => "Poire",
        "price" => 2.5,
    ],
    [
        "id" => uniqid(),
        "name" => "Fraise",
        "price" => 3,
    ],
];

function createProduct(&$products, $product)
{
    $product['id'] = uniqid();
    array_push($products, $product);

    return $product;
}
