<?php

require_once "./model/requests.profil.php";

function profilController(PDO $pdo): void
{
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?page=signin");
        exit;
    }

    $action = $_GET['action'] ?? 'read';

    if ($action === 'upload-image') {
        uploadProfileImageController($pdo);
        return;
    }

    if ($action === 'update-info') {
        updateProfileInfoController($pdo);
        return;
    }

    $role = detectRole();
    $id = getSessionAccountId($role);

    if ($id <= 0) {
        http_response_code(403);
        die("Session invalide (id manquant)");
    }

    $profile = ($role === 'craftman')
        ? getCraftmanProfileById($pdo, $id)
        : getUserProfileById($pdo, $id);

    if (!$profile) {
        http_response_code(404);
        die("Profil introuvable");
    }

    $profileImageUrl = buildProfileImageUrl($profile['profile_image'] ?? null);

    require "./view/layout/header.php";
    require "./view/pages/profil.php";
    require "./view/layout/footer.php";
}

/* ===========================
   ROLE / SESSION
=========================== */

function detectRole(): string
{
    if (function_exists('isCraftman') && isCraftman()) return 'craftman';
    if (function_exists('isUser') && isUser()) return 'user';

    $t = $_SESSION['user']['type'] ?? $_SESSION['user']['role'] ?? null;
    return ($t === 'craftman') ? 'craftman' : 'user';
}

function getSessionAccountId(string $role): int
{
    if (!isset($_SESSION['user'])) return 0;

    if ($role === 'craftman') {
        return (int)($_SESSION['user']['craftman_id'] ?? $_SESSION['user']['id'] ?? 0);
    }

    return (int)($_SESSION['user']['user_id'] ?? $_SESSION['user']['id'] ?? 0);
}

/* ===========================
   IMAGE PATH
=========================== */

function buildBasePath(): string
{
    $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    return ($base === '/' ? '' : $base);
}

function buildProfileImageUrl(?string $dbPath): string
{
    $base = buildBasePath();

    if (!empty($dbPath)) {
        return $base . '/' . ltrim($dbPath, '/') . '?v=' . time();
    }

    return $base . '/assets/img/logo_artisite.jpeg';
}

/* ===========================
   UPDATE INFO CONTROLLER
=========================== */

function updateProfileInfoController(PDO $pdo): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        die("Méthode non autorisée");
    }

    $role = detectRole();
    $id = getSessionAccountId($role);

    if ($id <= 0) {
        http_response_code(403);
        die("Session invalide");
    }

    if ($role === 'craftman') {

        $company_name = trim($_POST['company_name'] ?? '');
        $siret = trim($_POST['siret'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($company_name === '' || $siret === '') {
            die("Entreprise et SIRET obligatoires");
        }

        if (!updateCraftmanInfo($pdo, $id, $company_name, $siret, $description)) {
            die("Erreur DB (craftman)");
        }

    } else {

        $username = trim($_POST['username'] ?? '');
        $phone_number = trim($_POST['phone_number'] ?? '');

        if ($username === '') {
            die("Username obligatoire");
        }

        if (!updateUserInfo($pdo, $id, $username, $phone_number)) {
            die("Erreur DB (user)");
        }
    }

    header("Location: index.php?page=profil");
    exit;
}

/* ===========================
   UPLOAD IMAGE
=========================== */

function uploadProfileImageController(PDO $pdo): void
{
    if (!isset($_FILES['profile_image'])) die("Image manquante");

    $role = detectRole();
    $id = getSessionAccountId($role);

    $file = $_FILES['profile_image'];
    if ($file['error'] !== UPLOAD_ERR_OK) die("Erreur upload");

    $allowedMime = ['image/jpeg', 'image/png', 'image/webp'];
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);

    if (!in_array($mime, $allowedMime, true)) die("Type interdit");

    $ext = match ($mime) {
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
    };

    $dir = __DIR__ . "/../uploads/profiles/$role/$id";
    if (!is_dir($dir)) mkdir($dir, 0755, true);

    $name = "profile_" . bin2hex(random_bytes(8)) . ".$ext";
    move_uploaded_file($file['tmp_name'], "$dir/$name");

    $path = "uploads/profiles/$role/$id/$name";

    ($role === 'craftman')
        ? updateCraftmanProfileImage($pdo, $id, $path)
        : updateUserProfileImage($pdo, $id, $path);

    header("Location: index.php?page=profil");
    exit;
}
