<?php
require_once './model/requests.signin.php';

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

function signinProcessController($pdo)
{
    $email = trim($_POST['email'] ?? '');
    $siret = trim($_POST['siret'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($email !== '' && $siret !== '') {
        die("Veuillez renseigner soit l’email soit le SIRET, pas les deux.");
    }
    if ($email === '' && $siret === '') {
        die("Veuillez renseigner soit l’email soit le SIRET");
    }

    if ($email !== '') {
        $user = getUser($pdo, $email);

        if (!$user || !password_verify($password, $user['hashed_password'])) {
            $admin = getAdmin($pdo, $email);
            if (!$admin || !password_verify($password, $admin['hashed_password'])) {
                die("Identifiants incorrects");
            } else {
                $_SESSION['user'] = [
                    'id' => $user['user_id'],
                    'role' => 'admin',
                    'email' => $user['email']
                ];
                
            }
        } else {
            $_SESSION['user'] = [
                'id' => $user['user_id'],
                'role' => 'user',
                'email' => $user['email']
            ];
        }


    } elseif ($siret !== '') {
        $craftman = getCraftman($pdo, $siret);

        if (!$craftman || !password_verify($password, $craftman['hashed_password'])) {
            die("Identifiants incorrects");
        }

        $_SESSION['user'] = [
            'id' => $craftman['craftman_id'],
            'role' => 'craftman',
            'siret' => $craftman['siret']
        ];
    }

    session_regenerate_id(true);

    header("Location: index.php?page=home");
    exit;

}