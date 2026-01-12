<?php



/* --------------------------------------
            READ FONCTIONS
----------------------------------------*/
function getAllCraftmen(PDO $pdo)
{
    $stmt = $pdo->prepare("Select craftman_id, siret, email, description, validator_id, company_name From craftman");
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

function getCraftmanByStatus(PDO $pdo, bool $has_validator)
{
    if ($has_validator == true) {
        $stmt = $pdo->prepare("
    Select craftman_id, siret, email, description, validator_id, company_name from craftman where validator_id IS NOT NULL");
    } else {
        $stmt = $pdo->prepare("
    Select craftman_id, siret, email, description, validator_id, company_name from craftman where validator_id IS NULL");
    }

    $stmt->execute();
    return $stmt->fetchAll();
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