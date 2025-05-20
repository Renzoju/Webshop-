<?php
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=gymwebshop;charset=utf8mb4', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Dummy user_id (vervang dit met echte login later)
$user_id = 1;

// Stap 1: Check of product_id is meegestuurd
if (!isset($_POST['product_id'])) {
    header('Location: index.php');
    exit();
}

$product_id = intval($_POST['product_id']);

// Stap 2: Kijk of er al een cart bestaat voor deze gebruiker
$stmt = $pdo->prepare("SELECT id FROM cart WHERE user_id = :user_id AND ordered = 0 LIMIT 1");
$stmt->execute([':user_id' => $user_id]);
$cart = $stmt->fetch();
$cart_id = $cart ? $cart['id'] : null;

// Stap 3: Geen cart? Maak een nieuwe aan
if (!$cart_id) {
    $stmt = $pdo->prepare("INSERT INTO cart (user_id) VALUES (:user_id)");
    $stmt->execute([':user_id' => $user_id]);
    $cart_id = $pdo->lastInsertId();
}

// Check of product al in cart_items zit
$stmt = $pdo->prepare("SELECT id, amount FROM cart_items WHERE cart_id = :cart_id AND product_id = :product_id");
$stmt->execute([
    ':cart_id' => $cart_id,
    ':product_id' => $product_id
]);
$existing = $stmt->fetch();

// Stap 5:= Toevoegen of bijwerken
if ($existing) {
    // Product zit al in winkelmand → aantal verhogen
    $stmt = $pdo->prepare("UPDATE cart_items SET amount = amount + 1, updated_at = NOW() WHERE id = :id");
    $stmt->execute([':id' => $existing['id']]);
} else {
    // Product nog niet in winkelmand → toevoegen
    $stmt = $pdo->prepare("INSERT INTO cart_items (cart_id, product_id, amount, created_at) 
                           VALUES (:cart_id, :product_id, 1, NOW())");
    $stmt->execute([
        ':cart_id' => $cart_id,
        ':product_id' => $product_id
    ]);
}

// Redirect terug naar vorige pagina
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
