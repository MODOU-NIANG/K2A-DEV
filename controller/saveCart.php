<?php
require_once 'Product.php';
require_once 'Commande.php';
require_once 'LigneCommande.php';
require_once 'User.php';
require_once 'Mailer.php';
require_once 'SMSService.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // 🔹 Initialisation du service SMS
        $smsService = new SMSService(
            'MlXHORnGGOOtBa97gz07TYRN5PH7qWRA',
            'o2iL5kgRuKYmwEdS',
            '+221771752617',
            'K2A'
        );

        if (isset($_POST['products'])) {
            $products = $_POST['products'];
            $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;

            // 🔹 Calcul du total si non envoyé ou incorrect
            $total_price = 0;
            foreach ($products as $p) {
                if (isset($p['price'], $p['quantity'])) {
                    $total_price += floatval($p['price']) * intval($p['quantity']);
                }
            }

            // Si le total du POST est vide ou à 0, on utilise celui calculé
            if (empty($_POST['total_price']) || $_POST['total_price'] == 0) {
                $_POST['total_price'] = $total_price;
            }

            // 🔹 Création utilisateur si nécessaire
            if (!$user_id) {
                $user = new User();
                $user_id = $user->createUser(
                    $_POST['nom'],
                    $_POST['prenom'],
                    $_POST['telephone'],
                    $_POST['email'],
                    $_POST['adresse']
                );
            }

            // 🔹 Création de la commande
            $commande = new Commande();
            $commande_id = $commande->createCommande($user_id, $_POST['total_price']);
            if (!$commande_id) {
                throw new Exception("Erreur lors du traitement de la commande.");
            }

            // 🔹 Enregistrement des produits et mise à jour du stock
            foreach ($products as $product) {
                $ligneCommande = new LigneCommande();
                $ligneCommande->createLigneCommande($commande_id, $product['reference'], $product['quantity']);

                $prodObj = new Product();
                $prodObj->decrementStock($product['reference'], $product['quantity']);
            }

            // 🔹 Préparation des e-mails
            $mailer = new Mailer();
            $dateCommande = date('Y-m-d H:i:s');

            // Emails administrateurs
            $adminEmail1 = '';
            $adminEmail2 = 'contact@k2afiltration.com';
            $subjectAdmin = 'Nouvelle commande effectuée - K2A FILTRATION';
            $subjectUser  = 'Confirmation de votre commande - K2A FILTRATION';

            // 🔹 Corps mail Admin
            ob_start();
            ?>
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <style>
                    body { font-family: Arial, sans-serif; color: #333; }
                    .container { width: 80%; margin: 0 auto; background: #f9f9f9; border: 1px solid #ddd; border-radius: 10px; padding: 20px; }
                    .header { text-align: center; margin-bottom: 20px; }
                    .header img { max-width: 150px; }
                    h2 { color: #004080; }
                    hr { border: 0; border-top: 1px solid #ccc; }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <img src="https://www.k2afiltration.com/images/logo_k2A1.png" alt="Logo K2A">
                        <h2>Nouvelle commande sur K2A Filtration</h2>
                    </div>
                    <p><strong>Client :</strong> <?= htmlspecialchars($_POST['nom'] . ' ' . $_POST['prenom']) ?></p>
                    <p><strong>Email :</strong> <?= htmlspecialchars($_POST['email']) ?></p>
                    <p><strong>Téléphone :</strong> <?= htmlspecialchars($_POST['telephone']) ?></p>
                    <p><strong>Adresse :</strong> <?= htmlspecialchars($_POST['adresse']) ?></p>
                    <p><strong>Date :</strong> <?= $dateCommande ?></p>
                    <hr>
                    <h3>Détails de la commande :</h3>
                    <?php foreach ($products as $p): ?>
                        <p><strong>Produit :</strong> <?= htmlspecialchars($p['name']) ?> (Réf : <?= htmlspecialchars($p['reference']) ?>)</p>
                        <p><strong>Quantité :</strong> <?= intval($p['quantity']) ?></p>
                        <p><strong>Prix :</strong> <?= number_format($p['price'], 0, ',', ' ') ?> CFA</p>
                        <hr>
                    <?php endforeach; ?>
                    <p><strong>Total :</strong> <span style="color:red;"><?= number_format($_POST['total_price'], 0, ',', ' ') ?> CFA</span></p>
                </div>
            </body>
            </html>
            <?php
            $bodyAdmin = ob_get_clean();

            // 🔹 Corps mail Utilisateur
            ob_start();
            ?>
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <style>
                    body { font-family: Arial, sans-serif; color: #333; }
                    .container { width: 80%; margin: 0 auto; background: #f9f9f9; border: 1px solid #ddd; border-radius: 10px; padding: 20px; }
                    .header { text-align: center; margin-bottom: 20px; }
                    .header img { max-width: 150px; }
                    h2 { color: #004080; }
                    hr { border: 0; border-top: 1px solid #ccc; }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <img src="https://www.k2afiltration.com/images/logo_k2A1.png" alt="Logo K2A">
                        <h2>Confirmation de votre commande</h2>
                    </div>
                    <p>Bonjour <?= htmlspecialchars($_POST['nom'] . ' ' . $_POST['prenom']) ?>,</p>
                    <p>Nous avons bien reçu votre commande passée le <?= $dateCommande ?>.</p>
                    <p><strong>Téléphone :</strong> <?= htmlspecialchars($_POST['telephone']) ?></p>
                    <p><strong>Adresse :</strong> <?= htmlspecialchars($_POST['adresse']) ?></p>
                    <h3>Détails de la commande :</h3>
                    <?php foreach ($products as $p): ?>
                        <p><strong>Produit :</strong> <?= htmlspecialchars($p['name']) ?> (Réf : <?= htmlspecialchars($p['reference']) ?>)</p>
                        <p><strong>Quantité :</strong> <?= intval($p['quantity']) ?></p>
                        <p><strong>Prix unitaire :</strong> <?= number_format($p['price'], 0, ',', ' ') ?> CFA</p>
                        <hr>
                    <?php endforeach; ?>
                    <p><strong>Total :</strong> <span style="color:red;"><?= number_format($_POST['total_price'], 0, ',', ' ') ?> CFA</span></p>
                    <p>Merci pour votre confiance et à bientôt sur <strong>K2A Filtration</strong>.</p>
                </div>
            </body>
            </html>
            <?php
            $bodyUser = ob_get_clean();

            // 🔹 Envoi des emails
            $mailer->sendEmail($adminEmail1, $subjectAdmin, $bodyAdmin);
            $mailer->sendEmail($adminEmail2, $subjectAdmin, $bodyAdmin);
            $mailer->sendEmail($_POST['email'], $subjectUser, $bodyUser);

            // 🔹 SMS confirmation
            $message = "Bonjour {$_POST['prenom']}, votre commande a bien été reçue. Merci pour votre confiance - K2A Filtration.";
            $smsService->envoyerSMS($_POST['telephone'], $message);

            // 🔹 Redirection après succès
            echo '<script>
                localStorage.clear();
                window.location.href = "../shoping-cart-success.php";
            </script>';
        }
    } catch (Throwable $e) {
        echo "<pre style='color:red;'>Erreur : {$e->getMessage()}<br>Fichier : {$e->getFile()}<br>Ligne : {$e->getLine()}</pre>";
        echo "<script>setTimeout(()=>{window.location.href='../shoping-cart';},5000);</script>";
    }
} else {
    header('Location: ../shoping-cart');
}
?>
