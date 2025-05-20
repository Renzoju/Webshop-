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




include_once('templates/head.inc.php');
?>

<form method="POST" action="src/formhandlers/register_handler.php" name="register" class="uk-width-1-1 uk-flex uk-flex-center uk-form-horizontal">
    <div class="uk-card uk-card-default uk-width-4-5 uk-padding-small">
        <div class="uk-position-medium uk-position-top-center">
            <div class="uk-card-header uk-flex uk-gap">
                <h2 class="uk-text-uppercase uk-margin-remove-top">Registreren</h2>
            </div>
        </div>
        <div class="uk-card-body uk-flex uk-flex-between uk-card-body-gap">
            <div class="uk-position-medium uk-position-top-center">

                <div class="uk-alert-danger" uk-alert>
                    <a href class="uk-alert-close" uk-close></a>
                    <p>Algemene foutmelding als tijdens de registratie iets niet goed gegaan is</p>
                </div>
    
            </div>
        </div>
        <div class="uk-card-body uk-flex uk-flex-between uk-card-body-gap">
            <div class="uk-container">
                <div>
                    <label class="uk-form-label">Voornaam*</label>
                    <div class="uk-form-controls">
                        <input type="text" name="firstname" class="uk-input"  placeholder="Voornaam...">
                        <p class="uk-text-danger uk-text-xsmall uk-text-italic uk-margin-remove-vertical">Bericht als
                            dit veld niet ingevuld is</p>
                    </div>
                </div>
                <div>
                    <label class="uk-form-label">Achternaam*</label>
                    <div class="uk-form-controls">
                        <input type="text" name="lastname" class="uk-input" placeholder="Achternaam...">
                        <p class="uk-text-danger uk-text-xsmall uk-text-italic uk-margin-remove-vertical">Bericht als
                            dit veld niet ingevuld is</p>
                    </div>
                    <div>
                        <label class="uk-form-label">Gebruikersnaam*</label>
                        <div class="uk-form-controls">
                            <input type="text" name="username" class="uk-input"
                                placeholder="Gebruikersnaam...">
                            <p class="uk-text-danger uk-text-xsmall uk-text-italic uk-margin-remove-vertical">Bericht
                                als dit veld niet ingevuld is</p>
                        </div>
                        <div>
                            <label class="uk-form-label">E-mail*</label>
                            <div class="uk-form-controls">
                                <input type="text" name="e-mail" class="uk-input" 
                                    placeholder="E-mail...">
                                <p class="uk-text-danger uk-text-xsmall uk-text-italic uk-margin-remove-vertical">
                                    Bericht als dit veld niet ingevuld is</p>
                            </div>
                            <div>
                                <label class="uk-form-label">Wachtwoord*</label>
                                <div class="uk-form-controls">
                                    <input type="text" name="password" class="uk-input"
                                        placeholder="Wachtwoord...">
                                    <p class="uk-text-danger uk-text-xsmall uk-text-italic uk-margin-remove-vertical">
                                        Bericht als dit veld niet ingevuld is</p>
                                </div>
                                <div>
                                    <label class="uk-form-label">Bevestig Wachtwoord*</label>
                                    <div class="uk-form-controls">
                                        <input type="text" name="password_confirm" class="uk-input"
                                            placeholder="Bevestig Wachtwoord...">
                                        <p
                                            class="uk-text-danger uk-text-xsmall uk-text-italic uk-margin-remove-vertical">
                                            Bericht als dit veld niet ingevuld is</p>
                                    </div>
                                </div>


                                <div class="uk-card-body uk-flex uk-flex-between uk-card-body-gap"></div>
                            </div>
                            <div class="uk-card-footer uk-flex uk-flex-between">
                                <a href="login.php" class="">Inloggen</a>
                                <input class="uk-button uk-button-primary" type="submit" value="regristreren">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</form>
<?php
include_once('templates/foot.inc.php');