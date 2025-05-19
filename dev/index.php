<?php

include_once("templates/head.inc.php");

try {
  $dsn = 'mysql:host=localhost;dbname=gymwebshop;';
  $username = 'root';
  $password = '';
  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ];

  $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
  die("Database connection failed: " . $e->getMessage());
}

$sql = "SELECT * FROM product";
$stmt = $pdo->query($sql);
if ($stmt === false) {
  die("Query failed: " . implode(", ", $pdo->errorInfo()));
}

$product = $stmt->fetchAll(PDO::FETCH_ASSOC);

include_once("templates/head.inc.php");
?>


<!-- CARD Section -->

<section class="uk-section uk-section-small">
  <div class="uk-container">
    <div class="uk-grid-match uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid>
      <?php foreach ($product as $product): ?>
        <div>
          <a href="product.php?product_id=<?= $product['id'] ?>"
            class="uk-card uk-card-default uk-card-hover uk-display-block uk-overflow-hidden">
            <div class="uk-card-media-top">
              <div class="uk-cover-container" style="aspect-ratio: 4 / 3;">
                <img src="img/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>"
                  uk-cover>
              </div>
            </div>
            <div class="uk-card-body">
              <p class="uk-text-bold uk-margin-small-bottom"><?= htmlspecialchars($product['description']) ?></p>
              <p class="uk-text-danger uk-text-bold uk-text-right">
                &euro; <?= number_format($product['price'], 2, ',', '.') ?>
              </p>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
include_once("templates/foot.inc.php");
?>