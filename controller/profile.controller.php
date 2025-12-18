<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require_once __DIR__ . '/../model/requests.profile.php';

$host = "127.0.0.1";
$db   = "artisite";
$user = "root";
$pass = "";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass, [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

if (empty($_SESSION['logged_in'])) {
  header("Location: /Artisite/index.php?page=signin");
  exit;
}

$model = new ProfileModel($pdo);
$accountType = $_SESSION['account_type'] ?? 'customer';

if ($accountType === 'customer') {
  $userId = (int)($_SESSION['user_id'] ?? 0);
  if ($userId <= 0) { http_response_code(401); exit("Missing user_id."); }

  $profile = $model->getCustomerById($userId);
  if (!$profile) { http_response_code(404); exit("Customer not found."); }

  $name = trim(($profile['first_name'] ?? '') . ' ' . ($profile['last_name'] ?? ''));
  if ($name === '') $name = $profile['username'] ?? 'Utilisateur';

  $viewData = [
    'name'   => $name,
    'email'  => $profile['email'] ?? '',
    'phone'  => $profile['phone_number'] ?? '',
    'extra1' => '—',
    'extra2' => 'Compte client',
  ];
} elseif ($accountType === 'craftman') {
  $craftmanId = (int)($_SESSION['craftman_id'] ?? 0);
  if ($craftmanId <= 0) { http_response_code(401); exit("Missing craftman_id."); }

  $profile = $model->getCraftmanById($craftmanId);
  if (!$profile) { http_response_code(404); exit("Craftman not found."); }

  $viewData = [
    'name'   => $profile['company_name'] ?? 'Artisan',
    'email'  => 'SIRET : ' . ($profile['siret'] ?? ''),
    'phone'  => '',
    'extra1' => 'Statut : ' . (!empty($profile['validator_id']) ? 'Validé' : 'En attente'),
    'extra2' => 'Compte artisan',
  ];
} else {
  http_response_code(400);
  exit("Unknown account_type.");
}

require __DIR__ . '/../view/pages/profile.php';
