<?php



/* --------------------------------------
            READ FONCTIONS
----------------------------------------*/
function getAllCraftmen(PDO $pdo)
{
    $stmt = $pdo->prepare("
        SELECT 
            craftman.craftman_id,
            craftman.siret,
            craftman.email,
            craftman.description,
            craftman.validator_id,
            administrator.email AS validator_email,
            craftman.company_name
        FROM craftman
        LEFT JOIN administrator 
            ON craftman.validator_id = administrator.admin_id
    ");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getAllValidatedCraftmen(PDO $pdo)
{
    $stmt = $pdo->prepare("
        SELECT 
            craftman.craftman_id,
            craftman.siret,
            craftman.email,
            craftman.description,
            craftman.validator_id,
            administrator.email AS validator_email,
            craftman.company_name
        FROM craftman
        LEFT JOIN administrator 
            ON craftman.validator_id = administrator.admin_id
        where craftman.validator_id IS NOT NULL
    ");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getCraftmanById(PDO $pdo, int $craftman_id)
{
    $stmt = $pdo->prepare("
    Select craftman_id, siret, email, description, validator_id, company_name from craftman where craftman_id = ?");
    $stmt->execute([$craftman_id]);
    return $stmt->fetchAll();
}

/* --------------------------------------
            UPDATE FONCTIONS
----------------------------------------*/


function validateCraftman(PDO $pdo, int $craftman_id, int $admin_id)
{
    $stmt = $pdo->prepare("
        UPDATE craftman
        SET validator_id = ?
        WHERE craftman_id = ?
    ");
    $stmt->execute([$admin_id, $craftman_id]);
}
/* --------------------------------------
            DELETE FONCTIONS
----------------------------------------*/

function deleteCraftman(PDO $pdo, int $craftman_id): bool
{
    $stmt = $pdo->prepare("
        DELETE FROM craftman
        WHERE craftman_id = ?
    ");

    return $stmt->execute([$craftman_id]);
}