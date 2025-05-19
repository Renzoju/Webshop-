<?php
$pdo = new PDO('mysql:host=localhost;dbname=gymwebshop;charset=utf8mb4', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    $stmt = $pdo->prepare("DELETE FROM cart_items WHERE product_id = :id");
    $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
}

header( "Location: ../../cart.php");
exit;
?>
