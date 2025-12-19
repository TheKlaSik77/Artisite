<?php



/* --------------------------------------
            READ FONCTIONS
----------------------------------------*/
function getAllCraftmen(PDO $pdo) {
    $stmt = $pdo->prepare("Select craftman.company_name From craftman");
    $stmt -> execute();
    return $stmt->fetchAll();
}

function getCraftmanById(PDO $pdo, int $id){
    $stmt = $pdo->prepare("
    Select craftman_id, siret, description, company_name");
    $stmt -> execute([$id]);
    return $stmt->fetchAll();
}