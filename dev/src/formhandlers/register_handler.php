<?php

echo "<pre>";
print_r($_POST);


if (
    empty($_POST['firstname']) ||
    empty($_POST['lastname']) ||
    empty($_POST['username']) ||
    empty($_POST['e-mail']) ||
    empty($_POST['password'])
) {
    die("Vul alle velden in.");
}

$firstname = htmlentities($_POST['firstname']);
$lastname = htmlentities($_POST['lastname']);
$username = htmlentities($_POST['username']);
$email = htmlentities($_POST['e-mail']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$dsn = 'mysql:host=localhost;dbname=gymwebshop;';
$pdo = new PDO($dsn, 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, username, email, password) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$firstname, $lastname, $username, $email, $password]);

header('Location: ../../login.php?success=1');
exit();


