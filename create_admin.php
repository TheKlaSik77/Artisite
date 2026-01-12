<?php
// ⚠️ SUPPRIME CE FICHIER APRÈS UTILISATION ⚠️

// Connexion à la base
require_once "./model/utils/connexion.php";

// === CONFIG ADMIN ===
$username = "admin";
$email = "admin@artisite.fr";
$phone_number = "0612234556";
$password = "1234"; 

// Hash du mot de passe
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insertion en base
$stmt = $pdo->prepare("
    INSERT INTO administrator (username, email, phone_number, hashed_password)
    VALUES (?, ?, ?, ?)
");

try {
    $stmt->execute([
        $username,
        $email,
        $phone_number,
        $hashed_password
    ]);

    echo "<h2>✅ Admin créé avec succès</h2>";
    echo "<p><strong>Username :</strong> $username</p>";
    echo "<p><strong>Email :</strong> $email</p>";
    echo "<p><strong>Mot de passe initial :</strong> $password</p>";
    echo "<p style='color:red;'>
        ⚠️ Supprime ce fichier immédiatement après utilisation
    </p>";

} catch (PDOException $e) {
    echo "<h2>❌ Erreur</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}

