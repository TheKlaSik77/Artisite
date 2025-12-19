<?php

function isLoggedIn(): bool
{
    return isset($_SESSION['user']);
}

function getCurrentUser(): ?array
{
    return $_SESSION['user'] ?? null;
}

function hasRole(string $role): bool
{
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === $role;
}

function isUser(): bool
{
    return hasRole('user');
}

function isCraftman(): bool
{
    return hasRole('craftman');
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: index.php?page=login');
        exit;
    }
}