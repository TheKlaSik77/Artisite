<?php
require_once './model/requests.signup.php';

function blockBackslashes(array $values): void
{
    foreach ($values as $v) {
        if (is_string($v) && strpos($v, '\\') !== false) {
            http_response_code(400);
            die('Backslash interdit');
        }
    }
}

function signupController(PDO $pdo)
{
    $action = $_GET['action'] ?? 'read';

    switch ($action) {
        case 'checkDuplicate':
            checkDuplicateController($pdo);
            exit;

        case 'add':
            $type = $_GET['type'] ?? '';
            if ($type === "craftman") {
                craftmanAddController($pdo);
            } elseif ($type === "user") {
                userAddController($pdo);
            } else {
                require "./view/pages/404.php";
            }
            break;

        case 'read':
        default:
            require "./view/layout/header.php";
            require "./view/pages/signup.php";
            require "./view/layout/footer.php";
            break;
    }
}

function checkDuplicateController(PDO $pdo): void
{
    header('Content-Type: application/json; charset=utf-8');

    $type  = $_GET['type']  ?? '';
    $field = $_GET['field'] ?? '';
    $value = $_GET['value'] ?? '';

    if (!in_array($type, ['user', 'craftman'], true)) {
        echo json_encode(['exists' => false, 'message' => 'Type invalide']);
        exit;
    }

    $allowedUserFields = ['username', 'email', 'phone_number'];
    $allowedCraftFields = ['siret'];

    if ($type === 'user' && !in_array($field, $allowedUserFields, true)) {
        echo json_encode(['exists' => false, 'message' => 'Champ invalide']);
        exit;
    }

    if ($type === 'craftman' && !in_array($field, $allowedCraftFields, true)) {
        echo json_encode(['exists' => false, 'message' => 'Champ invalide']);
        exit;
    }

    $value = trim((string)$value);
    if ($field === 'email') $value = strtolower($value);
    if ($field === 'phone_number') $value = preg_replace('/\s+/', '', $value);
    if ($field === 'siret') $value = preg_replace('/\s+/', '', $value);

    if (strpos($value, '\\') !== false) {
        echo json_encode(['exists' => false, 'message' => 'Backslash interdit']);
        exit;
    }

    if ($value === '') {
        echo json_encode(['exists' => false, 'message' => '']);
        exit;
    }

    try {
        $exists = false;

        if ($type === 'user') {
            if ($field === 'username') $exists = usernameExists($pdo, $value);
            if ($field === 'email') $exists = emailExists($pdo, $value);
            if ($field === 'phone_number') $exists = phoneExists($pdo, $value);
        } else {
            if ($field === 'siret') $exists = siretExists($pdo, $value);
        }

        echo json_encode([
            'exists' => $exists,
            'message' => $exists ? 'Déjà utilisé.' : 'Disponible.'
        ]);
        exit;
    } catch (Throwable $e) {
        echo json_encode(['exists' => false, 'message' => 'Erreur serveur']);
        exit;
    }
}

function userAddController(PDO $pdo)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        require "./view/pages/404.php";
        return;
    }

    $username = $_POST['username'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    blockBackslashes([
        $username,
        $last_name,
        $first_name,
        $email,
        $phone_number,
        $password,
        $password_confirm
    ]);

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

function craftmanAddController(PDO $pdo)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        require "./view/pages/404.php";
        return;
    }

    $company_name = $_POST['company_name'];
    $siret = $_POST['siret'];
    $description = $_POST['description'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    blockBackslashes([
        $company_name,
        $siret,
        $description,
        $password,
        $password_confirm
    ]);

    if ($password !== $password_confirm) {
        die("Les mots de passe ne correspondent pas");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    insertCraftman($pdo, $company_name, $siret, $description, $hashed_password);

    header("Location: index.php?page=home");
    exit;
}
