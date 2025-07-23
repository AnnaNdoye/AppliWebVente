<?php
require_once '../Backend/fonction.php';

// Rediriger si déjà connecté
if (estConnecte()) {
    header('Location: accueilClient.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte - Déco Élégance</title>
    <link rel="stylesheet" href="css/style.css">
  
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo"><a href="Pageaccueil.php">Déco Élégance</a></div>
            <ul class="nav">
                <li><a href="Pageaccueil.php">Accueil</a></li>
            </ul>
        </div>
    </header>

    <main>
        <section class="page-header">
            <div class="container">
                <h1 class="fade-in">Connectez-vous ou créer un Compte</h1>
            </div>
        </section>

        <section class="account-section container">
            <?php afficherMessage(); ?>
            
            <div class="account-tabs">
                <button class="tab-button active" data-tab="login">Connexion</button>
                <button class="tab-button" data-tab="register">Inscription</button>
            </div>

            <div id="login" class="tab-content active fade-in">
                <h2>Se connecter à votre compte</h2>
                <form class="auth-form" method="POST">
                    <input type="hidden" name="action" value="connexion">
                    
                    <label for="login-email">Email:</label>
                    <input type="email" name="email" id="login-email" required placeholder="votre@email.com">

                    <label for="login-password">Mot de passe:</label>
                    <input type="password" name="mot_de_passe" id="login-password" required placeholder="••••••••">

                    <button type="submit">Se connecter</button>
                    <a href="#">Mot de passe oublié ?</a>
                </form>
            </div>

            <div id="register" class="tab-content hidden">
                <h2>Créer un nouveau compte</h2>
                <form class="auth-form" method="POST">
                    <input type="hidden" name="action" value="inscription">
                    
                    <label for="register-name">Nom complet:</label>
                    <input type="text" name="nom_complet" id="register-name" required placeholder="Votre nom complet">

                    <label for="register-email">Email:</label>
                    <input type="email" name="email" id="register-email" required placeholder="votre@email.com">

                    <label for="register-email">Email:</label>
                    <input type="adresse" name="adresse" id="register-adresse" required placeholder="Adresse">

                    <label for="register-numero">Numéro de téléphone:</label>
                    <input type="tel" name="telephone" id="register-numero" required placeholder="771234567">

                    <label for="register-password">Mot de passe:</label>
                    <input type="password" name="mot_de_passe" id="register-password" required placeholder="••••••••">

                    <label for="register-confirm-password">Confirmer le mot de passe:</label>
                    <input type="password" name="confirmer_mot_de_passe" id="register-confirm-password" required placeholder="••••••••">

                    <button type="submit">S'inscrire</button>
                </form>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Déco Élégance. Tous droits réservés.</p>
        </div>
    </footer>

    <script>
        // Gestion des onglets
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetTab = this.getAttribute('data-tab');

                    // Retirer la classe active de tous les boutons et contenus
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => {
                        content.classList.remove('active');
                        content.classList.add('hidden');
                    });

                    // Ajouter la classe active au bouton cliqué
                    this.classList.add('active');

                    // Afficher le contenu correspondant
                    const targetContent = document.getElementById(targetTab);
                    if (targetContent) {
                        targetContent.classList.add('active');
                        targetContent.classList.remove('hidden');
                    }
                });
            });
        });
    </script>
</body>
</html>