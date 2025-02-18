<?php

require_once './lib/db.php';

function createUser(PDO $pdo, array $userData): array
{
    $keys = implode(', ', array_keys($userData));
    $preparedKeys = implode(
        ', ',
        array_map(
            fn ($key) => ":{$key}",
            array_keys($userData)
        )
    );
    $statement = $pdo->prepare("INSERT INTO users ({$keys}) VALUES ({$preparedKeys})");
    $statement->execute($userData);

    $newUserId = $pdo->lastInsertId();
    $newUser = $pdo->query("SELECT * FROM users WHERE id = {$newUserId}")->fetch();

    return $newUser;
}

function login(PDO $pdo, array $credentials): array|false
{
    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $statement->bindParam('email', $credentials['email']);
    $statement->execute();
    $user = $statement->fetch();
    return $user;
}

function fetchUsers(PDO $pdo): array
{
    $statement = $pdo->query("SELECT * FROM users");
    return $statement->fetchAll();
}

function fetchUser(PDO $pdo, int $userId): array|false
{
    $statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $statement->bindParam('id', $userId);
    $statement->execute();

    return $statement->fetch();
}

function deleteUser(PDO $pdo, int $userId): bool
{
    $statement = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $statement->bindParam('id', $userId);
    $statement->execute();
    $return = $statement->rowCount();
    return $return === 1;
}

function updateUser(PDO $pdo, int $userId, array $newUserData): ?array
{
    $sets = implode(
        ', ',
        array_map(
            fn ($key) => "{$key} = :{$key}",
            array_keys($newUserData)
        )
    );
    $statement = $pdo->prepare("UPDATE users SET {$sets} WHERE id = :id");
    $statement->execute(array_merge(['id' => $userId], $newUserData));

    if ($statement->rowCount()) {
        return $pdo->query("SELECT * FROM users WHERE id = {$userId}")->fetch();
    }
}
