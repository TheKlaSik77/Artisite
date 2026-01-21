<?php

function logoutController()
{
    // On s’assure que la session est bien démarrée
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Vide la session
    $_SESSION = [];

    // Détruit la session côté serveur
    session_destroy();

    // Supprime le cookie de session (bonne pratique)
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }

    // Redirection vers l’accueil
    header("Location: index.php?page=homepage");
    exit;
}
