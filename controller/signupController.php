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


function renderSignupWithError(string $msg): void
{
    if (session_status() === PHP_SESSION_NONE)
        session_start();
    $_SESSION['signup_error'] = $msg;

    require "./view/layout/header.php";
    require "./view/pages/signup.php";
    require "./view/layout/footer.php";
    exit;
}


function isValidName(string $name): bool
{
    $name = trim($name);
    if ($name === '')
        return false;

    return (bool) preg_match("/^[\p{L}\s'-]+$/u", $name);
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
                die("Type d'inscription invalide");
            }
            break;

        // Page affichée après inscription craftman
        case 'pending':
            require "./view/layout/header.php";
            require "./view/pages/craftmen-pending.php";
            require "./view/layout/footer.php";
            break;

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

    $type = $_GET['type'] ?? '';
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

    $value = trim((string) $value);
    if ($field === 'email')
        $value = strtolower($value);
    if ($field === 'phone_number')
        $value = preg_replace('/\s+/', '', $value);
    if ($field === 'siret')
        $value = preg_replace('/\s+/', '', $value);

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
            if ($field === 'username')
                $exists = usernameExists($pdo, $value);
            if ($field === 'email')
                $exists = emailExists($pdo, $value);
            if ($field === 'phone_number')
                $exists = phoneExists($pdo, $value);
        } else {
            if ($field === 'siret')
                $exists = siretExists($pdo, $value);
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
        die("Mauvaise requête");
    }

    $username = $_POST['username'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $first_name = $_POST['first_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone_number = $_POST['phone_number'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    blockBackslashes([
        $username,
        $last_name,
        $first_name,
        $email,
        $phone_number,
        $password,
        $password_confirm
    ]);


    if (!isValidName($first_name)) {
        renderSignupWithError("Prénom invalide (pas de chiffres).");
    }
    if (!isValidName($last_name)) {
        renderSignupWithError("Nom invalide (pas de chiffres).");
    }

    if ($password !== $password_confirm) {
        renderSignupWithError("Les mots de passe ne correspondent pas.");
    }

    $emailNorm = strtolower(trim($email));
    $phoneNorm = preg_replace('/\s+/', '', $phone_number);

    if (usernameExists($pdo, $username)) {
        renderSignupWithError("Pseudo déjà utilisé.");
    }
    if (emailExists($pdo, $emailNorm)) {
        renderSignupWithError("Email déjà utilisé.");
    }
    if (phoneExists($pdo, $phoneNorm)) {
        renderSignupWithError("Téléphone déjà utilisé.");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    insertUser($pdo, $username, $last_name, $first_name, $emailNorm, $phoneNorm, $hashed_password);

    $user_id = getUserIdByEmail($pdo, $emailNorm);
    if (!$user_id) {
        renderSignupWithError("Erreur serveur: utilisateur introuvable après création.");
    }

    CreateCartForUser($pdo, (int) $user_id);

    header("Location: index.php?page=homepage");
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

    $email = $_POST['email'] ?? '';
    $company_name = $_POST['company_name'] ?? '';
    $siret = $_POST['siret'] ?? '';
    $description = $_POST['description'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    blockBackslashes([
        $email,
        $company_name,
        $siret,
        $description,
        $password,
        $password_confirm
    ]);


    if ($password !== $password_confirm) {
        renderSignupWithError("Les mots de passe ne correspondent pas.");
    }

    $siretNorm = preg_replace('/\s+/', '', $siret);


    if (siretExists($pdo, $siretNorm)) {
        renderSignupWithError("SIRET déjà utilisé.");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    insertCraftman($pdo, $email, $company_name, $siretNorm, $description, $hashed_password);

    header("Location: index.php?page=homepage");
    exit;
}
