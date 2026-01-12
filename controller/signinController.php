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
    $siret = trim($_POST['siret'] ?? '');
    $password = $_POST['password'] ?? '';

    blockBackslashes([$email, $siret, $password]);

    if ($email !== '' && $siret !== '') {
        die("Veuillez renseigner soit l’email soit le SIRET, pas les deux.");
    }
    if ($email === '' && $siret === '') {
        die("Veuillez renseigner soit l’email soit le SIRET");
    }

    if ($email !== '') {
        $user = getUser($pdo, $email);

        if ($user && password_verify($password, $user['hashed_password'])) {
            $_SESSION['user'] = [
                'id' => (int)$user['user_id'],
                'role' => 'user',
                'email' => $user['email']
            ];
        } else {
            $admin = getAdmin($pdo, $email);

            if (!$admin || !password_verify($password, $admin['hashed_password'])) {
                die("Identifiants incorrects");
            }

            $_SESSION['user'] = [
                'id' => (int)$admin['admin_id'],
                'role' => 'admin',
                'email' => $admin['email']
            ];
        }

    } else {
        $craftman = getCraftman($pdo, $siret);

        if (!$craftman || !password_verify($password, $craftman['hashed_password'])) {
            die("Identifiants incorrects");
        }

        $_SESSION['user'] = [
            'id' => (int)$craftman['craftman_id'],
            'role' => 'craftman',
            'siret' => $craftman['siret']
        ];
    }

    session_regenerate_id(true);

    header("Location: index.php?page=home");
    exit;
}
