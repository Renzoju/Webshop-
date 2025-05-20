<?php
// Databaseverbinding
$pdo = new PDO('mysql:host=localhost;dbname=gymwebshop', 'root', '');

// Inlogfunctie
function login($email, $password) {
    global $pdo;

    // Gebruiker ophalen
    $stmt = $pdo->prepare('SELECT id, email, password FROM users WHERE email = :email LIMIT 1');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Wachtwoord controleren
    if ($user && $password === $user['password']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        return true;
    }
    return false;
}

// Inlogverzoek afhandelen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (login($email, $password)) {
        header('Location: /webshop/dev/cart.php');
        exit;
    } else {
        $error = 'Invalid email or password.';
        header('Location: /webshop/dev/login.php');
        exit;
    }
}
?>
