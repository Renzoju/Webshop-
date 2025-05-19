<?php
include_once("templates/head.inc.php");

// Stap 1: Verbinden met database
$pdo = new PDO('mysql:host=localhost;dbname=gymwebshop', 'root', '');

// Stap 2: Winkelmandje ophalen met JOIN
$stmt = $pdo->prepare("
    SELECT 
        cart_items.id AS cart_item_id,
        cart_items.amount,
        product.id AS product_id,
        product.name AS product_name,
        product.description,
        product.price,
        product.image,
        (cart_items.amount * product.price) AS product_total
    FROM cart_items
    LEFT JOIN product ON product.id = cart_items.product_id
");
$stmt->execute();
$cart_items = $stmt->fetchAll(PDO::FETCH_OBJ);

// Stap 3: Bereken totaalbedrag en aantal artikelen
$cart_total_amount = 0;
$cart_total_cost = 0.0;

foreach ($cart_items as $item) {
    $cart_total_amount += intval($item->amount);
    $cart_total_cost += floatval($item->product_total);
}

$shipping_cost = 0.0; // Stel verzendkosten in
$order_total = $cart_total_cost + $shipping_cost;
?>

<main class="uk-container uk-padding">
    <div class="uk-grid">
        <section class="uk-width-2-3 uk-flex uk-flex-column uk-cart-gap">
            <?php if ($cart_total_amount > 0): ?>
                <?php foreach ($cart_items as $item): ?>
                    <div class="uk-card-default uk-card-small uk-flex uk-flex-between">
                        <div class="uk-card-media-left uk-width-1-5">
                            <img src="img/<?= htmlspecialchars($item->image) ?>" alt="<?= htmlspecialchars($item->product_name) ?>" class="product-image uk-align-center">
                        </div>
                        <div class="uk-card-body uk-width-4-5 uk-flex uk-flex-between">
                            <div class="uk-width-3-4 uk-flex uk-flex-column">
                                <h2><?= htmlspecialchars($item->product_name) ?></h2>
                                <p><?= htmlspecialchars(substr($item->description, 0, 120)) ?>...</p>
                                <div class="uk-flex uk-flex-between">
                                    <p class="uk-text-primary uk-text-bold">Prijs per stuk: &euro; <?= sprintf("%.2f", $item->price) ?></p>
                                    <p class="uk-text-primary uk-text-bold uk-margin-remove-top">Totaal: &euro; <?= sprintf("%.2f", $item->product_total) ?></p>
                                </div>
                            </div>
                            <div class="uk-width-1-4 uk-flex uk-flex-between uk-flex-middle uk-flex-center">
                                <div class="uk-width-3-4 uk-flex uk-flex-column uk-flex-middle">
                                    <input id="amount" class="uk-form-controls uk-form-width-xsmall uk-text-medium" name="amount" value="<?= $item->amount ?>" type="number" />
                                </div>
                                <div class="uk-width-1-4">
                                    <form action="src/formhandlers/removefromcart.php" method="POST">
                                        <input type="hidden" name="product_id" value="<?= $item->product_id ?>">
                                        <button type="submit" class="uk-link-cart-trash uk-flex uk-flex-column uk-flex-middle uk-text-danger uk-flex-1" style="border: none; background: none;">
                                            <span uk-icon="icon: trash"></span>
                                            <span class="uk-text-xsmall">Verwijder</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
            <?php else: ?>
                <div class="uk-card-default uk-card-small uk-flex uk-flex-between">
                    <div class="uk-card-body uk-width-4-5 uk-flex uk-flex-between">
                        <h3>Nog geen artikelen in de winkelwagen.</h3>
                    </div>
                </div>
            <?php endif; ?>
        </section>

        <section class="uk-width-1-3">
            <div class="uk-card uk-card-default uk-card-small">
                <div class="uk-card-header uk-align-center">
                    <h2>Overzicht</h2>
                </div>
                <div class="uk-card-body">
                    <div class="uk-flex uk-flex-between uk-flex-middle">
                        <p class="uk-width-1-2">Artikelen (<?= $cart_total_amount ?>)</p>
                        <p class="uk-width-1-2 uk-margin-remove-top uk-text-right">&euro; <?= sprintf("%.2f", $cart_total_cost) ?></p>
                    </div>
                    <div class="uk-flex uk-flex-between uk-flex-middle">
                        <p class="uk-width-1-2">Verzendkosten</p>
                        <p class="uk-width-1-2 uk-margin-remove-top uk-text-right">&euro; <?= sprintf("%.2f", $shipping_cost) ?></p>
                    </div>
                </div>
                <div class="uk-card-footer">
                    <div class="uk-flex uk-flex-between uk-flex-middle">
                        <p class="uk-width-1-2 uk-text-bold">Te betalen</p>
                        <p class="uk-width-1-2 uk-margin-remove-top uk-text-right uk-text-bold">&euro; <?= sprintf("%.2f", $order_total) ?></p>
                    </div>
                    <div class="uk-flex uk-flex-1 uk-flex-middle uk-flex-center uk-margin-medium-top">
                        <a href="order.php" class="uk-button uk-button-primary">Verder naar bestellen</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php
include_once("templates/foot.inc.php");
?>