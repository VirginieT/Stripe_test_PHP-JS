<?php
if (isset($_POST['prix']) && !empty($_POST['prix'])) {
    require_once('vendor/autoload.php');
    $prix = $_POST['prix'];

    // On instancie Stripe
    \Stripe\Stripe::setApiKey('sk_test_51KsYzkEibdhyD3QRFR6yhVY13CUovNv8b9XzenRR8TDQ56aPlooKvVmG05u5zAnCTiEebPf1mB0w2q2QNRHKscYD00KwMmEu7t');

    // On donne l'intention de paiement
    $intent = \Stripe\PaymentIntent::create([
        'amount' => $prix * 100,
        'currency' => 'eur',
        // 'payment_method_types' => ['card'],
        // 'off_session' => true,
        // 'confirm' => true,
        // 'confirmation_method' => 'manual',
    ]);
    // echo '<pre>';
    // var_dump($intent);
    // echo '</pre>';
    // die();
}else{
    header('Location: index.php');
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paiement</title>
</head>

<body>
    <form method="post">
        <div id="errors"></div> <!-- Affiche les erreurs de paiement -->
        <input type="text" id="cardholder-name" placeholder="Titulaire de la carte">
        <div id="card-elements"></div> <!-- Affiche le formulaire de saisie des infos de la carte -->
        <div id="card-errors"></div> <!-- Affiche les erreurs relatives à la carte -->
        <button id="card-button" type="button" data-secret="<?= $intent['client_secret'] ?>">Procéder au paiement</button>

    </form>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="js/script.js"></script>
</body>
</html>
