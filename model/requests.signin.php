<?php
declare(strict_types=1);
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(405);
  exit("Method not allowed");
}

$email = trim($_POST["email"] ?? "");
$password = (string)($_POST["password"] ?? "");

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === "") {
  http_response_code(400);
  exit("Invalid email or password.");
}

$host = "127.0.0.1";
$db   = "artisite";
$user = "root";
$pass = "";
$charset = "utf8mb4";
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
  $pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);

  $stmt = $pdo->prepare("SELECT user_id, username, email, hashed_password FROM `user` WHERE email = :email LIMIT 1");
  $stmt->execute(["email" => $email]);
  $u = $stmt->fetch();

  if (!$u || !password_verify($password, $u["hashed_password"])) {
    http_response_code(401);
    exit("Email or password incorrect.");
  }

  $_SESSION["user_id"] = (int)$u["user_id"];
  $_SESSION["username"] = $u["username"];
  $_SESSION["email"] = $u["email"];
  $_SESSION["logged_in"] = true;

  header("Location: /artisite/index.php?page=homepage");
  exit;

} catch (PDOException $e) {
  http_response_code(500);
  exit("DB error: " . htmlspecialchars($e->getMessage()));
}
