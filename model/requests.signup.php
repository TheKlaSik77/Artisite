<?php
declare(strict_types=1);

session_start();
require_once __DIR__ . '/utils/connection.php';

require_method("POST");

$accountType = require_account_type((string)($_POST["account_type"] ?? "customer"));

$password     = (string)($_POST["password"] ?? "");
$passwordConf = (string)($_POST["password_confirm"] ?? "");

$acceptedTerms = ((string)($_POST["accepted_terms"] ?? "")) === "1";

$errors = [];
if (!$acceptedTerms) $errors[] = "You must accept the terms";
if ($password === "" || $passwordConf === "") $errors[] = "Password required";
if ($password !== $passwordConf) $errors[] = "Passwords do not match";

if (!empty($errors)) {
    fail(400, "Errors:\n- " . implode("\n- ", $errors));
}

try {
    $pdo = pdo();

    $termsId = latest_terms_id($pdo);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // -----------------------------
    // CUSTOMER SIGNUP -> `user`
    // -----------------------------
    if ($accountType === "customer") {
        $username    = trim((string)($_POST["username"] ?? ""));
        $firstName   = trim((string)($_POST["first_name"] ?? ""));
        $lastName    = trim((string)($_POST["last_name"] ?? ""));
        $email       = trim((string)($_POST["email"] ?? ""));
        $phoneNumber = trim((string)($_POST["phone_number"] ?? ""));

        $errors = [];
        if ($username === "") $errors[] = "Username required";
        if ($firstName === "") $errors[] = "First name required";
        if ($lastName === "") $errors[] = "Last name required";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email";
        if ($phoneNumber === "") $errors[] = "Phone number required";

        if (!empty($errors)) {
            fail(400, "Errors:\n- " . implode("\n- ", $errors));
        }

        // uniqueness (email or username)
        $exists = (int) fetch_value(
            $pdo,
            "SELECT COUNT(*) FROM `user` WHERE email = :email OR username = :username",
            ["email" => $email, "username" => $username]
        );

        if ($exists > 0) {
            fail(409, "Email or username already exists.");
        }

        $stmt = $pdo->prepare("
            INSERT INTO `user`
                (username, last_name, first_name, email, phone_number, hashed_password, description, accepted_terms_of_use_id)
            VALUES
                (:username, :last_name, :first_name, :email, :phone_number, :hashed_password, :description, :accepted_terms_of_use_id)
        ");

        $stmt->execute([
            "username" => $username,
            "last_name" => $lastName,
            "first_name" => $firstName,
            "email" => $email,
            "phone_number" => $phoneNumber,
            "hashed_password" => $hashedPassword,
            "description" => null,
            "accepted_terms_of_use_id" => $termsId,
        ]);

        $_SESSION["logged_in"]    = true;
        $_SESSION["account_type"] = "customer";
        $_SESSION["user_id"]      = (int)$pdo->lastInsertId();
        $_SESSION["username"]     = $username;
        $_SESSION["email"]        = $email;

        redirect("/artisite/index.php?page=homepage");
    }

    // -----------------------------
    // CRAFTMAN SIGNUP -> `craftman`
    // -----------------------------
    if ($accountType === "craftman") {
        $siretRaw    = trim((string)($_POST["siret"] ?? ""));
        $siret       = normalize_siret($siretRaw);
        $companyName = trim((string)($_POST["company_name"] ?? ""));
        $description = trim((string)($_POST["description"] ?? ""));

        $errors = [];
        if ($siret === "") $errors[] = "SIRET required";
        if ($companyName === "") $errors[] = "Company name required";
        if ($description === "") $errors[] = "Description required";

        if (!empty($errors)) {
            fail(400, "Errors:\n- " . implode("\n- ", $errors));
        }

        require_valid_siret($siret);

        // SIRET unique
        $exists = (int) fetch_value(
            $pdo,
            "SELECT COUNT(*) FROM craftman WHERE siret = :siret",
            ["siret" => $siret]
        );

        if ($exists > 0) {
            fail(409, "SIRET already exists.");
        }

        $stmt = $pdo->prepare("
            INSERT INTO craftman
                (siret, company_name, description, hashed_password, validator_id)
            VALUES
                (:siret, :company_name, :description, :hashed_password, NULL)
        ");

        $stmt->execute([
            "siret" => $siret,
            "company_name" => $companyName,
            "description" => $description,
            "hashed_password" => $hashedPassword,
        ]);

        $_SESSION["logged_in"]    = true;
        $_SESSION["account_type"] = "craftman";
        $_SESSION["craftman_id"]  = (int)$pdo->lastInsertId();
        $_SESSION["company_name"] = $companyName;
        $_SESSION["siret"]        = $siret;

        redirect("/artisite/index.php?page=homepage");
    }

    fail(400, "Unknown account_type");

} catch (PDOException $e) {
    fail(500, "Internal server error.");
}
