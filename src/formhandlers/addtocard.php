<?php
require_once 'includes/database.php';
session_start(); 

// Check of het een POST is
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: index.php');
    exit();
}

// Check of product_id er is
if (!isset($_POST['product_id']) || !is_numeric($_POST['product_id'])) {
    header('Location: index.php');
    exit();
}

// Variabelen
$product_id = intval($_POST['product_id']);
$amount = isset($_POST['amount']) ? intval($_POST['amount']) : 1;
$gebruiker_id = 1; // tijdelijk vast, later via login sessie

// Product ophalen
$stmt = $pdo->prepare("SELECT * FROM product WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) {
    echo "Product niet gevonden!";
    exit();
}

// Check of het product al in winkelmand zit
$stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
$stmt->execute([$user_id, $product_id]);
$cart_item = $stmt->fetch();

if ($cart_item) {
    // Product bestaat al -> hoeveelheid ophogen
    $new_amount = $cart_item['amount'] + $amount;
    $update = $pdo->prepare("UPDATE cart SET amount = ? WHERE user_id = ? AND product_id = ?");
    $update->execute([$new_amount, $user_id, $product_id]);
} else {
    // Product nog niet in mandje -> nieuwe toevoegen
    $insert = $pdo->prepare("INSERT INTO cart (user_id, product_id, product_name, price, amount, image, added_at)
        VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $insert->execute([
        $gebruiker_id,
        $product['id'],
        $product['product_name'], // let op juiste kolomnaam
        $product['price'],
        $amount,
        $product['image']
    ]);
}

// Redirect naar winkelmand
header('Location: cart.php');
exit();
?>
