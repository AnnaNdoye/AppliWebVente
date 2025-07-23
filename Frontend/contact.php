<?php
require_once '../Backend/fonction.php';

// Vérifier si le client est connecté
if (!estConnecte()) {
    header('Location: mon-compte.php');
    exit();
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = contact_recup(
        $_SESSION['client_id'],
        $_POST['firstname'] ?? '',
        $_POST['lastname'] ?? '',
        $_POST['email'] ?? '',
        $_POST['phone'] ?? '',
        $_POST['service'] ?? '',
        $_POST['message'] ?? ''
    );
    
    if ($result['success']) {
        $_SESSION['message'] = $result['message'];
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = $result['message'];
        $_SESSION['message_type'] = 'error';
    }
    
    header('Location: contact.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous - DécoÉlégance</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <a href="accueilClient.php" class="logo">DécoÉlégance</a>
            <nav>
                <ul class="nav">
                    <li><a href="accueilClient.php">Accueil</a></li>
                    <li><a href="produit.php">Produits</a></li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="realisation.html">Réalisations</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="about.html">À propos</a></li>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="panier.php">Panier</a></li>
                    <li><a href="contact.php"  style="color:  #ff8c00;" >Contact</a></li>
                </ul>
            </nav>
            <div class="contact-header">
                <span style="color: #333;">Bonjour <?php echo htmlspecialchars($_SESSION['client_nom']); ?></span>
            </div>
        </div>
    </header>

    <!-- Contact Section -->
    <section id="contact" class="section contact">
        <div class="container">
            <h2 class="section-title">Contactez-nous</h2>
            <p class="section-subtitle">Prêt à transformer votre intérieur ? Notre équipe est à votre disposition pour discuter de votre projet.</p>
            
            <div class="contact-grid">
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">📞</div>
                        <div>
                            <h4>Téléphone</h4>
                            <p>77 123 45 67</p>
                            <small>Appel gratuit</small>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">📧</div>
                        <div>
                            <h4>Email</h4>
                            <p>contact@decoaura.com</p>
                            <small>Réponse sous 24h</small>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">📍</div>
                        <div>
                            <h4>Showroom</h4>
                            <p>123 Rue faidherbe<br>Dakar Senegal</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">🕒</div>
                        <div>
                            <h4>Horaires</h4>
                            <p>Lun-Ven: 9h-18h<br>Sam: 10h-17h</p>
                        </div>
                    </div>

                    <!-- Section Réseaux Sociaux -->
                    <div class="contact-item">
                        <div class="contact-icon">🌐</div>
                        <div>
                            <h4>Suivez-nous</h4>
                            <div class="social-media">
                                <a href="https://facebook.com/decoelegance" target="_blank" class="social-link">
                                    <img src="images/facebook.png" alt="Facebook" class="social-icon">
                                </a>
                                <a href="https://instagram.com/decoelegance" target="_blank" class="social-link">
                                    <img src="images/instagram.png" alt="Instagram" class="social-icon">
                                </a>
                                <a href="https://tiktok.com/@decoelegance" target="_blank" class="social-link">
                                    <img src="images/tiktok.png" alt="TikTok" class="social-icon">
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Informations du client -->
                    <div class="contact-item">
                        <div class="contact-icon">👤</div>
                        <div>
                            <h4>Vos informations</h4>
                            <p><strong>Nom:</strong> <?php echo htmlspecialchars($_SESSION['client_nom']); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['client_email']); ?></p>
                            <p><strong>Téléphone:</strong> <?php echo htmlspecialchars($_SESSION['client_telephone']); ?></p>
                            <?php if (!empty($_SESSION['client_adresse'])): ?>
                            <p><strong>Adresse:</strong> <?php echo htmlspecialchars($_SESSION['client_adresse']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <form class="contact-form" method="POST" action="">
                    <h3 style="margin-bottom: 30px; color: #333;">Écrivez-nous</h3>
                    
                    <?php afficherMessage(); ?>
                    
                    <!-- Champs pré-remplis avec les informations du client -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label for="firstname">Prénom *</label>
                            <input type="text" id="firstname" name="firstname" 
                                   value="<?php echo htmlspecialchars(explode(' ', $_SESSION['client_nom'])[0]); ?>" 
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Nom *</label>
                            <input type="text" id="lastname" name="lastname" 
                                   value="<?php echo htmlspecialchars(substr($_SESSION['client_nom'], strpos($_SESSION['client_nom'], ' ') + 1)); ?>" 
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" 
                               value="<?php echo htmlspecialchars($_SESSION['client_email']); ?>" 
                               readonly style="background-color: #f5f5f5;">
                        <small>Email associé à votre compte (non modifiable)</small>
                    </div>

                    <div class="form-group">
                        <label for="phone">Téléphone *</label>
                        <input type="tel" id="phone" name="phone" 
                               value="<?php echo htmlspecialchars($_SESSION['client_telephone']); ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="service">Type de service *</label>
                        <select id="service" name="service" required>
                            <option value="">Choisissez un service</option>
                            <option value="conseil">Conseil en décoration</option>
                            <option value="amenagement">Aménagement complet</option>
                            <option value="evenementiel">Décoration événementielle</option>
                            <option value="visite">Visite à domicile</option>
                            <option value="produits">Achat de produits</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" rows="5" 
                                  placeholder="Décrivez-nous votre besoin..." required></textarea>
                    </div>

                    <button type="submit" class="btn" style="width: 100%;">Envoyer le message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-bottom">
                <p>&copy; 2024 DécoÉlégance. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

</body>
</html>