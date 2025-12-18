<?php
session_start();

/* Security: only allow POST */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?page=homepage');
    exit;
}

/* Clear session data */
$_SESSION = [];

/* Destroy session */
session_destroy();

/* Delete session cookie */
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

/* Redirect */
header("Location: index.php?page=homepage");
exit;
