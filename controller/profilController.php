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

    // Build a PUBLIC image url that works even if the project is inside a subfolder (ex: /Artisite)
    $profileImageUrl = buildProfileImageUrl($profile['profile_image'] ?? null);

    require "./view/layout/header.php";
    require "./view/pages/profil.php";
    require "./view/layout/footer.php";
}

function detectRole(): string
{
    if (function_exists('isCraftman') && isCraftman()) return 'craftman';
    if (function_exists('isUser') && isUser()) return 'user';

    $t = $_SESSION['user']['type'] ?? $_SESSION['user']['role'] ?? null;
    if ($t === 'craftman') return 'craftman';

    return 'user';
}

function getSessionAccountId(string $role): int
{
    if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) return 0;

    if ($role === 'craftman') {
        return (int)($_SESSION['user']['craftman_id'] ?? $_SESSION['user']['id'] ?? 0);
    }

    return (int)($_SESSION['user']['user_id'] ?? $_SESSION['user']['id'] ?? 0);
}

/**
 * Returns the web-visible "base path" of the app.
 * Example:
 * - If script is /Artisite/index.php -> returns /Artisite
 * - If script is /index.php -> returns ""
 */
function buildBasePath(): string
{
    $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    return ($base === '/' ? '' : $base);
}

/**
 * Returns a displayable URL:
 * - if DB has "uploads/profiles/user/19/abc.jpg" -> "<base>/uploads/profiles/user/19/abc.jpg?v=..."
 * - else -> "<base>/assets/img/logo_artisite.jpeg"
 */
function buildProfileImageUrl(?string $dbPath): string
{
    $base = buildBasePath();

    if (!empty($dbPath)) {
        return $base . '/' . ltrim($dbPath, '/') . '?v=' . time(); // cache-buster
    }

    return $base . '/assets/img/logo_artisite.jpeg';
}

function uploadProfileImageController(PDO $pdo): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        die("Méthode non autorisée");
    }

    if (!isset($_SESSION['user'])) {
        header("Location: index.php?page=signin");
        exit;
    }

    $role = detectRole();
    $id = getSessionAccountId($role);

    if ($id <= 0) {
        http_response_code(403);
        die("Session invalide (id manquant)");
    }

    if (!isset($_FILES['profile_image'])) {
        die("Image manquante");
    }

    $file = $_FILES['profile_image'];

    $err = $file['error'] ?? UPLOAD_ERR_NO_FILE;
    if ($err !== UPLOAD_ERR_OK) {
        die("Erreur upload image (code $err)");
    }

    $tmp  = $file['tmp_name'] ?? '';
    $size = (int)($file['size'] ?? 0);

    $allowedMime = ['image/jpeg', 'image/png', 'image/webp'];
    $maxSizeBytes = 5 * 1024 * 1024;
    $finfo = new finfo(FILEINFO_MIME_TYPE);

    if ($size <= 0 || $size > $maxSizeBytes) {
        die("Fichier trop gros (max 5MB)");
    }

    $mime = $finfo->file($tmp);
    if (!in_array($mime, $allowedMime, true)) {
        die("Type interdit (jpeg/png/webp uniquement)");
    }

    $ext = match ($mime) {
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/webp' => 'webp',
        default      => 'bin',
    };

    // uploads/profiles/<role>/<id>/
    $baseDir = __DIR__ . "/../uploads/profiles/" . $role . "/" . $id;

    if (!is_dir($baseDir)) {
        if (!mkdir($baseDir, 0755, true)) {
            die("Impossible de créer le dossier d'upload");
        }
    }

    $filename = "profile_" . bin2hex(random_bytes(12)) . "." . $ext;
    $destAbs = $baseDir . "/" . $filename;

    if (!move_uploaded_file($tmp, $destAbs)) {
        die("Impossible de déplacer le fichier");
    }

    $relativePath = "uploads/profiles/" . $role . "/" . $id . "/" . $filename;

    $ok = ($role === 'craftman')
        ? updateCraftmanProfileImage($pdo, $id, $relativePath)
        : updateUserProfileImage($pdo, $id, $relativePath);

    if (!$ok) {
        die("Erreur DB lors de la sauvegarde du chemin");
    }

    header("Location: index.php?page=profil");
    exit;
}
