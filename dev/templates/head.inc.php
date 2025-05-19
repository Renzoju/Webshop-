<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Webshop Stayfit</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.19.4/dist/css/uikit.min.css">
  <link rel="stylesheet" href="index.css">
</head>
<body>
  <nav class="uk-navbar-container uk-navbar-transparent" uk-navbar>
    <div class="uk-navbar-left">
      <button class="uk-button uk-button-default" style="color: black;">Shop <span class="uk-margin-small-left" style="color: black;">＋</span></button>
      <ul class="uk-navbar-nav uk-visible@m">
        <li><a href="#" style="color: black;">Het Plan</a></li>
        <li><a href="#" style="color: black;">Contact</a></li>
      </ul>
    </div>

    <div class="uk-navbar-center">
      <a href="/webshop/dev/index.php" class="uk-navbar-item uk-logo">
        <img src="img/logo.png" alt="Logo" style="height: 54px; object-fit: contain;">
      </a>
    </div>

      <div class="uk-navbar-right">
        <ul class="uk-navbar-nav uk-visible@m">
          <li><a href="#" style="color: black;">Zoek</a></li>
          <li><a href="#" style="color: black;">Log in</a></li>
          <li><a href="/webshop/dev/cart.php" style="color: black;">Mand</a></li>
        </ul>
        <a class="uk-navbar-toggle uk-hidden@m" uk-navbar-toggle-icon href="#offcanvas-nav" uk-toggle></a>
      </div>
    </nav>

  <div id="offcanvas-nav" uk-offcanvas="overlay: true">
    <div class="uk-offcanvas-bar">
      <button class="uk-offcanvas-close" type="button" uk-close></button>
      <ul class="uk-nav uk-nav-default">
        <li><a href="#" style="color: black;">Het Plan</a></li>
        <li><a href="#" style="color: black;">Contact</a></li>
        <li><a href="#" style="color: black;">Zoek</a></li>
        <li><a href="#" style="color: black;">Log in</a></li>
        <li><a href="/webshop/dev/cart.php" style="color: black;">Mand</a></li>
      </ul>
    </div>
  </div>
</body>
  