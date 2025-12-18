<?php
declare(strict_types=1);

session_start();
require_once __DIR__ . '/utils/connection.php';

require_method("POST");

$accountType = require_account_type((string)($_POST["account_type"] ?? "customer"));
$password    = (string)($_POST["password"] ?? "");

if ($password === "") {
    fail(400, "Invalid password.");
}

try {
    $pdo = pdo();

    if ($accountType === "customer") {
        $email = trim((string)($_POST["email"] ?? ""));
        require_valid_email($email);

        $u = fetch_one(
            $pdo,
            "
            SELECT user_id, username, email, hashed_password
            FROM `user`
            WHERE email = :email
            LIMIT 1
            ",
            ["email" => $email]
        );

        if (!$u || !password_verify($password, (string)$u["hashed_password"])) {
            fail(401, "Email or password incorrect.");
        }

        $_SESSION["logged_in"]    = true;
        $_SESSION["account_type"] = "customer";
        $_SESSION["user_id"]      = (int)$u["user_id"];
        $_SESSION["username"]     = (string)$u["username"];
        $_SESSION["email"]        = (string)$u["email"];

        redirect("/artisite/index.php?page=homepage");
    }

    // craftman
    $siretRaw = trim((string)($_POST["siret"] ?? ""));
    $siret    = normalize_siret($siretRaw);
    require_valid_siret($siret);

    $c = fetch_one(
        $pdo,
        "
        SELECT craftman_id, siret, company_name, hashed_password, validator_id
        FROM craftman
        WHERE siret = :siret
        LIMIT 1
        ",
        ["siret" => $siret]
    );

    if (!$c || !password_verify($password, (string)$c["hashed_password"])) {
        fail(401, "SIRET or password incorrect.");
    }

    // Optional validation gate (keep commented if you don't want it yet)
    // if ($c["validator_id"] === null) {
    //     fail(403, "Compte artisan en attente de validation.");
    // }

    $_SESSION["logged_in"]    = true;
    $_SESSION["account_type"] = "craftman";
    $_SESSION["craftman_id"]  = (int)$c["craftman_id"];
    $_SESSION["company_name"] = (string)($c["company_name"] ?? "");
    $_SESSION["siret"]        = (string)$c["siret"];

    redirect("/artisite/index.php?page=homepage");

} catch (PDOException $e) {
    // Don't expose internal DB details to users
    fail(500, "Internal server error.");
}
