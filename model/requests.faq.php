<?php

function faqGetAllPublic(PDO $pdo): array
{
    $sql = "SELECT question_id, question, answer
            FROM faq
            ORDER BY question_id DESC";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function faqGetAllAdmin(PDO $pdo): array
{
    $sql = "SELECT question_id, question, answer, writer_administrator_id
            FROM faq
            ORDER BY question_id DESC";
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function faqCreate(PDO $pdo, string $question, string $answer, ?int $adminId): void
{
    $stmt = $pdo->prepare("
        INSERT INTO faq(question, answer, writer_administrator_id)
        VALUES (:q, :a, :admin)
    ");

    $stmt->execute([
        ':q' => $question,
        ':a' => $answer,
        ':admin' => ($adminId && $adminId > 0) ? $adminId : null
    ]);
}


function faqDelete(PDO $pdo, int $id): void
{
    $stmt = $pdo->prepare("DELETE FROM faq WHERE question_id = :id");
    $stmt->execute([':id' => $id]);
}
