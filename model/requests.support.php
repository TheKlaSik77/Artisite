<?php

function supportCreateTicket(PDO $pdo, string $subject, int $craftmanId, ?int $customerId): int
{
    $stmt = $pdo->prepare("
        INSERT INTO support_ticket(subject, craftman_id, customer_id, status)
        VALUES (:s, :craft, :cust, 'nouveau')
    ");
    $stmt->execute([
        ':s' => $subject,
        ':craft' => $craftmanId,
        ':cust' => $customerId
    ]);

    return (int)$pdo->lastInsertId();
}

function supportAddMessage(PDO $pdo, int $ticketId, string $senderRole, ?int $senderId, string $body): void
{
    $stmt = $pdo->prepare("
        INSERT INTO support_message(ticket_id, sender_role, sender_id, body)
        VALUES (:t, :role, :sid, :b)
    ");
    $stmt->execute([
        ':t' => $ticketId,
        ':role' => $senderRole,
        ':sid' => $senderId,
        ':b' => $body
    ]);

    // updated_at
    $pdo->prepare("UPDATE support_ticket SET updated_at = NOW() WHERE ticket_id = :t")
        ->execute([':t' => $ticketId]);
}

function supportGetTicketsForCustomer(PDO $pdo, int $customerId): array
{
    $stmt = $pdo->prepare("
        SELECT ticket_id, subject, status, created_at, updated_at, craftman_id
        FROM support_ticket
        WHERE customer_id = :cid
        ORDER BY COALESCE(updated_at, created_at) DESC
    ");
    $stmt->execute([':cid' => $customerId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function supportGetTicketsForCraftman(PDO $pdo, int $craftmanId): array
{
    $stmt = $pdo->prepare("
        SELECT ticket_id, subject, status, created_at, updated_at, customer_id
        FROM support_ticket
        WHERE craftman_id = :cid
        ORDER BY COALESCE(updated_at, created_at) DESC
    ");
    $stmt->execute([':cid' => $craftmanId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function supportGetTicket(PDO $pdo, int $ticketId): ?array
{
    $stmt = $pdo->prepare("
        SELECT *
        FROM support_ticket
        WHERE ticket_id = :t
        LIMIT 1
    ");
    $stmt->execute([':t' => $ticketId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
}

function supportGetMessages(PDO $pdo, int $ticketId): array
{
    $stmt = $pdo->prepare("
        SELECT sender_role, sender_id, body, created_at
        FROM support_message
        WHERE ticket_id = :t
        ORDER BY created_at ASC
    ");
    $stmt->execute([':t' => $ticketId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function supportUpdateStatus(PDO $pdo, int $ticketId, string $status): void
{
    $allowed = ['nouveau','en_cours','resolu'];
    if (!in_array($status, $allowed, true)) return;

    $stmt = $pdo->prepare("
        UPDATE support_ticket
        SET status = :s, updated_at = NOW()
        WHERE ticket_id = :t
    ");
    $stmt->execute([':s' => $status, ':t' => $ticketId]);
}

function supportGetAllTickets(PDO $pdo, ?string $status = null): array
{
    if ($status && in_array($status, ['nouveau','en_cours','resolu'], true)) {
        $stmt = $pdo->prepare("
            SELECT ticket_id, subject, status, created_at, updated_at, customer_id, craftman_id
            FROM support_ticket
            WHERE status = :s
            ORDER BY COALESCE(updated_at, created_at) DESC
        ");
        $stmt->execute([':s' => $status]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $pdo->query("
        SELECT ticket_id, subject, status, created_at, updated_at, customer_id, craftman_id
        FROM support_ticket
        ORDER BY COALESCE(updated_at, created_at) DESC
    ")->fetchAll(PDO::FETCH_ASSOC);
}
