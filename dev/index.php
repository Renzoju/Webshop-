<?php
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
?>
<?php
include_once("templates/head.inc.php");
?>

 <!-- cards -->
<section class="uk-width-expand@m">
        <div class="uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid>
          <div>
            <a class="uk-card uk-card-default uk-card-hover uk-card-small" href="product.html">
              <div class="uk-card-media-top">
                <img src="img/white-chicken.jpg" alt="Witte kip">
              </div>
              <div class="uk-card-body">
                <p>Een ideale kip voor beginnende wedstrijd deelnemer.</p>
                <p class="uk-text-danger uk-text-bold uk-text-right">&euro; 19,95</p>
              </div>
            </a>
          </div>
        

<?php
include_once("templates/foot.inc.php");     