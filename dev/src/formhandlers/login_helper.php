<?php
// Stap 1: Verbinden met database
$pdo = new PDO('mysql:host=localhost;dbname=gymwebshop', 'root', '');

function login($username, $password) {
    global $pdo; // Assuming $pdo is your PDO connection

    $stmt = $pdo->prepare('SELECT id, username, password FROM users WHERE username = :username LIMIT 1');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password === $user['password']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        return true;
    }
    return false;
}

// Example usage:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (login($username, $password)) {
        header('Location: /cart.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
        header('Location: /login.php');
        exit;
    }
}
?>