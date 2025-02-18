<?php

require_once './lib/db.php';

function createComment(PDO $pdo, array $commentData): array
{
    $pdo->query("INSERT INTO comments (name, comment) VALUES ('{$commentData['name']}', '{$commentData['comment']}')");
    $newCommentId = $pdo->lastInsertId();
    $newComment = $pdo->query("SELECT * FROM comments WHERE id = {$newCommentId}")->fetch();

    return $newComment;
}

function fetchComments(PDO $pdo): array
{
    $statement = $pdo->query("SELECT * FROM comments");
    return $statement->fetchAll();
}

function fetchComment(PDO $pdo, int $commentId): array|false
{
    $statement = $pdo->query("SELECT * FROM comments WHERE id={$commentId}");
    return $statement->fetch();
}

function deleteComment(PDO $pdo, int $commentId): bool
{
    $return = $pdo->query("DELETE FROM comments WHERE id = {$commentId}");
    $return = $return->rowCount();
    return $return === 1;
}

function updateComment(PDO $pdo, int $commentId, array $newCommentData): ?array
{
    $sets = [];
    foreach ($newCommentData as $key => $value) {
        switch ($key) {
            case 'name':
            case 'comment':
                $sets[] = "{$key} = '{$value}'";
                break;
            default:
                $sets[] = "{$key} = {$value}";
                break;
        }
    }
    $sets = implode(', ', $sets);
    $return = $pdo->query("UPDATE comments SET {$sets} WHERE id = {$commentId}");

    if ($return->rowCount()) {
        return $pdo->query("SELECT * FROM comments WHERE id = {$commentId}")->fetch();
    }
}
