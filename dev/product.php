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
    die("Database verbinding mislukt: " . $e->getMessage());
}

// Check of er een product_id is meegegeven
if (!isset($_GET['product_id'])) {
    die("Geen product geselecteerd.");
}

// Haal het product ID op
$product_id = (int) $_GET['product_id'];


$stmt = $pdo->prepare("SELECT * FROM product WHERE id = :id");
$stmt->execute([':id' => $product_id]);

// Haal het product op
$product = $stmt->fetch(PDO::FETCH_OBJ);

// Als het product niet bestaat
if (!$product) {
    die("Product niet gevonden.");
}
?>

<!-- HTML CARD -->
<div class="uk-grid">
   <section class="uk-width-1">
      <div class="uk-grid uk-card uk-card-default" style="max-width: 1200px; margin: 0 auto;">
         <section class="uk-width-1-2 uk-card-media-left">
            <div class="uk-card-media-top">
               <div class="uk-cover-container" style="height: 700px;">
                  <img src="img/<?= htmlspecialchars($product->image) ?>" alt="<?= htmlspecialchars($product->name) ?>" uk-cover>
               </div>
            </div>
         </section>
         <section class="uk-width-1-2 uk-card-body uk-flex uk-flex-column uk-flex-between">
            <div>
               <h1><?= htmlspecialchars($product->name) ?></h1>
               <p><?= htmlspecialchars($product->description) ?></p>
            </div>
            <div class="uk-flex uk-flex-between uk-flex-middle">
               <div class="price-block">
                  <p class="product-view__price uk-text-bold uk-text-danger uk-text-left uk-text-bolder">
                     &euro; <?= htmlspecialchars($product->price) ?>
                  </p>
               </div>
                  <div>
                    <form method="POST" action="src/formhandlers/addtocart.php">
                      <input type="hidden" name="product_id" value="<?= htmlspecialchars($product->id) ?>" />
                      <input type="hidden" name="product_name" value="<?= htmlspecialchars($product->name) ?>" />
                     <input type="hidden" name=" description" value="<?= htmlspecialchars($product->description) ?>" />
                      <input type="hidden" name="price" value="<?= htmlspecialchars($product->price) ?>" />
                      <input type="hidden" name="image" value="<?= htmlspecialchars($product->image) ?>" />
                      <button type="submit" class="uk-button uk-button-primary">
                        <span uk-icon="icon: cart"></span> In winkelwagen
                      </button>
                    </form>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </section>
</div>


<?php
include_once("templates/foot.inc.php");
?>