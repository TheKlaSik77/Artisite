<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

function getUserConnectionData(): array
{
  $isLoggedIn  = !empty($_SESSION['logged_in']);
  $accountType = $_SESSION['account_type'] ?? null;

  return [
    'isLoggedIn'       => $isLoggedIn,
    'isCraftman'       => $isLoggedIn && $accountType === 'craftman',
    'showAuthButtons'  => !$isLoggedIn,
    'displayName'      => $_SESSION['username']
      ?? $_SESSION['company_name']
      ?? 'Profil',
  ];
}
