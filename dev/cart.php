<?php
include_once("templates/head.inc.php");

// Stap 1: Verbinden met database
$pdo = new PDO('mysql:host=localhost;dbname=gymwebshop', 'root', '');

// Stap 2: Winkelmandje ophalen
$stmt = $pdo->prepare("SELECT * FROM winkelmand");
$stmt->execute();
$cart_items = $stmt->fetchAll(PDO::FETCH_OBJ);

// Stap 3: Totaalprijs berekenen
$totaal = 0;
foreach ($cart_items as $item) {
    $totaal += $item->prijs * $item->hoeveelheid;
}
?>

<main class="uk-container uk-padding">
    <div class="uk-grid">
        <section class="uk-width-2-3 uk-flex uk-flex-column uk-cart-gap">
            <?php foreach($cart_items as $cart_item): ?>
            <div class="uk-card-default uk-card-small uk-flex uk-flex-between">
                <div class="uk-card-media-left uk-width-1-5">
                    <img src="img/<?= htmlspecialchars($cart_item->afbeeldingen) ?>" alt="<?= htmlspecialchars($cart_item->product_naam) ?>" class="product-image uk-align-center">
                </div>
                <div class="uk-card-body uk-width-4-5 uk-flex uk-flex-between">
                    <div class="uk-width-3-4 uk-flex uk-flex-column">
                        <h2><?= htmlspecialchars($cart_item->product_naam) ?></h2>
                        <p class="uk-margin-remove-top">Beschrijving kort</p> <!-- Hier kan nog productbeschrijving -->
                        <div class="uk-flex uk-flex-between">
                            <p class="uk-text-primary uk-text-bold">Prijs per stuk: &euro; <?= sprintf("%.2f", $cart_item->prijs) ?></p>
                            <p class="uk-text-primary uk-text-bold uk-margin-remove-top">Totaal: &euro; <?= sprintf("%.2f", $cart_item->prijs * $cart_item->hoeveelheid) ?></p>
                        </div>
                    </div>
                    <div class="uk-width-1-4 uk-flex uk-flex-between uk-flex-middle uk-flex-center">
                        <div class="uk-width-3-4 uk-flex uk-flex-column uk-flex-middle">
                            <input id="amount" class="uk-form-controls uk-form-width-xsmall uk-text-medium" name="amount" value="<?= $cart_item->hoeveelheid ?>" type="number" /> 
                        </div>
                        <div class="uk-width-1-4">
                            <a href="#" class="uk-link-cart-trash uk-flex uk-flex-column uk-flex-middle uk-text-danger uk-flex-1">
                                <span uk-icon="icon: trash"></span>
                                <span class="uk-text-xsmall">Verwijder</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </section>

        <section class="uk-width-1-3">
            <div class="uk-card uk-card-default uk-card-small">
                <div class="uk-card-header uk-align-center">
                    <h2>Overzicht</h2>
                </div>
                <div class="uk-card-body">
                    <div class="uk-flex uk-flex-between uk-flex-middle">
                        <p class="uk-width-1-2">Artikelen (<?= count($cart_items) ?>)</p>
                        <p class="uk-width-1-2 uk-margin-remove-top uk-text-right">&euro; <?= sprintf("%.2f", $totaal) ?></p>
                    </div>
                    <div class="uk-flex uk-flex-between uk-flex-middle">
                        <p class="uk-width-1-2">Verzendkosten</p>
                        <p class="uk-width-1-2 uk-margin-remove-top uk-text-right">&euro; 0.00</p>
                    </div>
                </div>
                <div class="uk-card-footer">
                    <div class="uk-flex uk-flex-between uk-flex-middle">
                        <p class="uk-width-1-2 uk-text-bold">Te betalen</p>
                        <p class="uk-width-1-2 uk-margin-remove-top uk-text-right uk-text-bold">&euro; <?= sprintf("%.2f", $totaal) ?></p>
                    </div>
                    <div class="uk-flex uk-flex-1 uk-flex-middle uk-flex-center uk-margin-medium-top">
                        <a href="order.html" class="uk-button uk-button-primary">
                            Verder naar bestellen
                         </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php
include_once("templates/foot.inc.php");
?>
