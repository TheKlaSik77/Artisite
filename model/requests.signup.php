<?php
declare(strict_types=1);

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(405);
  exit("Method not allowed");
}

$username    = trim($_POST["username"] ?? "");
$firstName   = trim($_POST["first_name"] ?? "");
$lastName    = trim($_POST["last_name"] ?? "");
$email       = trim($_POST["email"] ?? "");
$phoneNumber = trim($_POST["phone_number"] ?? "");

$password     = (string)($_POST["password"] ?? "");
$passwordConf = (string)($_POST["password_confirm"] ?? "");

$acceptedTerms = ($_POST["accepted_terms"] ?? "") === "1";

$errors = [];
if ($username === "") $errors[] = "Username required";
if ($firstName === "") $errors[] = "First name required";
if ($lastName === "") $errors[] = "Last name required";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email";
if ($phoneNumber === "") $errors[] = "Phone number required";
if (!$acceptedTerms) $errors[] = "You must accept the terms";
if ($password === "" || $passwordConf === "") $errors[] = "Password required";
if ($password !== $passwordConf) $errors[] = "Passwords do not match";

if (!empty($errors)) {
  http_response_code(400);
  exit("Errors:\n- " . implode("\n- ", $errors));
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


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


  $termsId = (int)$pdo->query("SELECT MAX(terms_of_use_id) AS id FROM terms_of_use")->fetch()["id"];
  if ($termsId <= 0) $termsId = 1;


  $check = $pdo->prepare("SELECT COUNT(*) FROM user WHERE email = :email OR username = :username");
  $check->execute(["email" => $email, "username" => $username]);
  if ((int)$check->fetchColumn() > 0) {
    http_response_code(409);
    exit("Email or username already exists.");
  }

  $stmt = $pdo->prepare("
    INSERT INTO user
      (username, last_name, first_name, email, phone_number, hashed_password, description, accepted_terms_of_use_id)
    VALUES
      (:username, :last_name, :first_name, :email, :phone_number, :hashed_password, :description, :accepted_terms_of_use_id)
  ");

  $stmt->execute([
    "username" => $username,
    "last_name" => $lastName,
    "first_name" => $firstName,
    "email" => $email,
    "phone_number" => $phoneNumber,
    "hashed_password" => $hashedPassword,
    "description" => null,
    "accepted_terms_of_use_id" => $termsId,
  ]);

  echo "OK: user created (user_id = " . htmlspecialchars((string)$pdo->lastInsertId()) . ")";

} catch (PDOException $e) {
  http_response_code(500);
  echo "DB error: " . htmlspecialchars($e->getMessage());
}
