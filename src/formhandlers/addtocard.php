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
$hoeveelheid = isset($_POST['hoeveelheid']) ? intval($_POST['hoeveelheid']) : 1;
$gebruiker_id = 1; // tijdelijk vast, later via login sessie

// Product ophalen
$stmt = $pdo->prepare("SELECT * FROM producten WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) {
    echo "Product niet gevonden!";
    exit();
}

// Check of het product al in winkelmand zit
$stmt = $pdo->prepare("SELECT * FROM winkelmand WHERE gebruiker_id = ? AND product_id = ?");
$stmt->execute([$gebruiker_id, $product_id]);
$cart_item = $stmt->fetch();

if ($cart_item) {
    // Product bestaat al -> hoeveelheid ophogen
    $new_amount = $cart_item['hoeveelheid'] + $hoeveelheid;
    $update = $pdo->prepare("UPDATE winkelmand SET hoeveelheid = ? WHERE gebruiker_id = ? AND product_id = ?");
    $update->execute([$new_amount, $gebruiker_id, $product_id]);
} else {
    // Product nog niet in mandje -> nieuwe toevoegen
    $insert = $pdo->prepare("INSERT INTO winkelmand (gebruiker_id, product_id, product_naam, prijs, hoeveelheid, afbeeldingen, toegevoegd_op)
        VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $insert->execute([
        $gebruiker_id,
        $product['id'],
        $product['product_naam'], // let op juiste kolomnaam
        $product['prijs'],
        $hoeveelheid,
        $product['afbeeldingen']
    ]);
}

// Redirect naar winkelmand
header('Location: cart.php');
exit();
?>
