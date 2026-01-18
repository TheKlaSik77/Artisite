<?php
require_once './model/requests.signin.php';

function blockBackslashes(array $values): void
{
    foreach ($values as $v) {
        if (is_string($v) && strpos($v, '\\') !== false) {
            http_response_code(400);
            die('Backslash interdit');
        }
    }
}

function signinController(PDO $pdo)
{
    $action = $_GET['action'] ?? 'read';

    switch ($action) {

        case 'read':
            require "./view/layout/header.php";
            require "./view/pages/signin.php";
            require "./view/layout/footer.php";
            break;

        // ✅ Page affichée si craftman pas validé
        case 'not_validated':
            require "./view/layout/header.php";
            require "./view/pages/craftmen-not-validated.php";
            require "./view/layout/footer.php";
            break;

        case 'login':
            signinProcessController($pdo);
            break;

        default:
            require "./view/pages/404.php";
            break;
    }
}

function signinProcessController(PDO $pdo)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        require "./view/pages/404.php";
        return;
    }

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    blockBackslashes([$email, $password]);

    if ($email === '') {
        die("Veuillez renseigner l'email.");
    }

    $email = trim($_POST['email'] ?? '');
    $is_craftman = $_POST['is_craftman'] ?? "0";
    $password = $_POST['password'] ?? '';

    // ---------------- USER / ADMIN ----------------
    if ($is_craftman === "0") {

        $user = getUser($pdo, $email);

        if ($user && password_verify($password, $user['hashed_password'])) {
            $_SESSION['user'] = [
                'id' => (int)$user['user_id'],
                'role' => 'user',
                'email' => $email
            ];
        } else {
            $admin = getAdmin($pdo, $email);

            if (!$admin || !password_verify($password, $admin['hashed_password'])) {
                die("Identifiants incorrects");
            }

            $_SESSION['user'] = [
                'id' => $admin['admin_id'],
                'role' => 'admin',
                'email' => $admin['email']
            ];
        }

    // ---------------- CRAFTMAN ----------------
    } else {

        $craftman = getCraftman($pdo, $email);

        if (!$craftman || !password_verify($password, $craftman['hashed_password'])) {
            die("Identifiants incorrects");
        }

        // Bloquer si pas validé (validator_id NULL)
        if ($craftman['validator_id'] === null) {
            header("Location: index.php?page=signin&action=not_validated");
            exit;
        }

        $_SESSION['user'] = [
            'id' => (int)$craftman['craftman_id'],
            'role' => 'craftman',
            'email' => $craftman['email']
        ];
    }

    session_regenerate_id(true);
    header("Location: index.php?page=home");
    exit;
}
