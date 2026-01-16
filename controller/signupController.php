<?php
require_once './model/requests.signup.php';

function signupController(PDO $pdo)
{
    $action = $_GET['action'] ?? 'read';

    switch ($action) {

        case 'add':
            $type = $_GET['type'] ?? '';

            if ($type === "craftman") {
                craftmanAddController($pdo);
            } elseif ($type === "user") {
                userAddController($pdo);
            } else {
                die("Type d'inscription invalide");
            }
            break;

        // 🔔 Page affichée après inscription craftman
        case 'pending':
            require "./view/layout/header.php";
            require "./view/pages/craftmen-pending.php";
            require "./view/layout/footer.php";
            break;

        case 'read':
        default:
            require "./view/layout/header.php";
            require "./view/pages/signup.php";
            require "./view/layout/footer.php";
            break;
    }
}

/* =========================
        USER SIGNUP
========================= */
function userAddController(PDO $pdo)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die("Mauvaise requête");
    }

    $username = trim($_POST['username'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $first_name = trim($_POST['first_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone_number = trim($_POST['phone_number'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $password_confirm = trim($_POST['password_confirm'] ?? '');

    if ($password !== $password_confirm) {
        die("Les mots de passe ne correspondent pas");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    insertUser($pdo, $username, $last_name, $first_name, $email, $phone_number, $hashed_password);

    $user_id = getUserIdByEmail($pdo, $email);
    CreateCartForUser($pdo, $user_id);

    header("Location: index.php?page=home");
    exit;
}

/* =========================
      CRAFTMAN SIGNUP
========================= */
function craftmanAddController(PDO $pdo)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die("Mauvaise requête");
    }

    $email = trim($_POST['email'] ?? '');
    $siret = trim($_POST['siret'] ?? null);
    $company_name = trim($_POST['company_name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $password_confirm = trim($_POST['password_confirm'] ?? '');

    if ($password !== $password_confirm) {
        die("Les mots de passe ne correspondent pas");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // validator_id = NULL => compte en attente de validation
    insertCraftman($pdo, $email, $company_name, $siret, $description, $hashed_password);

    // 🔁 Redirection vers page d'attente
    header("Location: index.php?page=signup&action=pending");
    exit;
}
