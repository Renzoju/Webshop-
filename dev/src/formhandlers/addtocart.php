<?php
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=gymwebshop;charset=utf8mb4', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check of product_id is meegestuurd
if (!isset($_POST['product_id'])) {
    header('Location: index.php');
    exit();
}

$product_id = intval($_POST['product_id']);

// Tijdelijke waarde voor user_id
$user_id = 1; // Gebruik een standaardwaarde totdat loginfunctionaliteit is toegevoegd

// Check of productgegevens zijn meegestuurd
$product_name = $_POST['product_name'] ?? 'Onbekend product';
$price = floatval($_POST['price'] ?? 0);
$image = $_POST['image'] ?? 'img/default.jpg';

// Check of gebruiker al een openstaande cart heeft
$stmt = $pdo->prepare("SELECT id FROM cart WHERE user_id = :id");
$stmt->execute([':id' => $user_id]);
$cart = $stmt->fetch();
$cart_id = $cart ? $cart['id'] : 0;

// Als er nog geen cart is, maak er een
if (!$cart_id) {
    $stmt = $pdo->prepare("INSERT INTO cart (user_id) VALUES (:id)");
    $stmt->execute([':id' => $user_id]);
    $cart_id = $pdo->lastInsertId();
}

// Check of product al in cart zit
$stmt = $pdo->prepare("SELECT id, amount FROM cart WHERE id = :cart_id AND product_id = :product_id");
$stmt->execute([
    ':cart_id' => $cart_id,
    ':product_id' => $product_id
]);
$existing = $stmt->fetch();

if ($existing) {
    // Product zit al in cart → verhoog aantal
    $stmt = $pdo->prepare("UPDATE cart SET amount = amount + 1 WHERE id = :id");
    $stmt->execute([':id' => $existing['id']]);
} else {
    // Product zit nog niet in cart → voeg toe
    $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, product_name, price, amount, image, added_at) 
                           VALUES (:user_id, :product_id, :product_name, :price, 1, :image, NOW())");
    $stmt->execute([
        ':user_id' => $user_id,
        ':product_id' => $product_id,
        ':product_name' => $product_name,
        ':price' => $price,
        ':image' => $image
    ]);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();