<?php



/* --------------------------------------
            READ FONCTIONS
----------------------------------------*/
function getAllCraftmen(PDO $pdo) {
    $stmt = $pdo->prepare("Select craftman_id, craftman.company_name From craftman");
    $stmt -> execute();
    return $stmt->fetchAll();
}

function getCraftmanById(PDO $pdo, int $craftman_id){
    $stmt = $pdo->prepare("
    Select craftman_id, siret, description, company_name from craftman where craftman_id = ?");
    $stmt -> execute([$craftman_id]);
    return $stmt->fetchAll();
}