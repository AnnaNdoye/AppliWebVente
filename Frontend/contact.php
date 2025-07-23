<?php
require_once '../Backend/fonction.php';
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
            <a href="index.php" class="logo">DécoÉlégance</a>
            <nav>
                <ul class="nav">
                    <li><a href="index.php#accueil">Accueil</a></li>
                    <li><a href="index.php#produits">Produits</a></li>
                    <li><a href="index.php#services">Services</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="mon-compte.php">S'identifier</a></li>
                </ul>
            </nav>
            <div class="contact-header">
                <span style="color: #666;">📞 77 777 77</span>
                <a href="#contact" class="btn">Rendez-vous</a>
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
                </div>

                <form class="contact-form" method="POST" action="">
                    <h3 style="margin-bottom: 30px; color: #333;">Écrivez-nous</h3>
                    
                    <?php afficherMessage(); ?>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label for="firstname">Prénom *</label>
                            <input type="text" id="firstname" name="firstname" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Nom *</label>
                            <input type="text" id="lastname" name="lastname" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="tel" id="phone" name="phone">
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
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" placeholder="Décrivez-nous votre besoin..."></textarea>
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