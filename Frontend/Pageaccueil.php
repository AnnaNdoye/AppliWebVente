<?php
require_once '../Backend/fonction.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DécoÉlégance - Votre Expert en Décoration</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <a href="#" class="logo">DécoÉlégance</a>
            <nav>
                <ul class="nav">
                    <li><a href="#accueil">Accueil</a></li>
                    <li><a href="#produits">Produits</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="mon-compte.php">S'identifier</a></li>
                </ul>
            </nav>
            <div class="contact-header">
                <span style="color: #666;">📞 77 777 77</span>
                <a href="#contact" class="btn">Rendez-vous</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="accueil" class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Transformez votre <span class="highlight">espace de vie</span></h1>
                <p>DécoÉlégance vous accompagne dans tous vos projets de décoration et d'aménagement. Découvrez notre collection d'articles raffinés et nos services personnalisés.</p>
                
                <div class="hero-buttons">
                    <a href="#produits" class="btn">Découvrir nos produits</a>
                    <a href="#contact" class="btn btn-outline">Prendre rendez-vous</a>
                </div>

                <div class="stats">
                    <div class="stat">
                        <div class="stat-number">500+</div>
                        <div class="stat-text">Projets réalisés</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">15 ans</div>
                        <div class="stat-text">D'expérience</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">98%</div>
                        <div class="stat-text">Clients satisfaits</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="produits" class="section products">
        <div class="container">
            <h2 class="section-title">Notre Collection</h2>
            <p class="section-subtitle">Découvrez notre sélection d'articles de décoration soigneusement choisis pour transformer votre intérieur avec élégance.</p>
            
            <div class="product-grid">
                <div class="product-card">
                    <div class="product-icon">🛋️</div>
                    <h3 class="product-title">Coussins & Textiles</h3>
                    <p class="product-description">Collection de coussins décoratifs et textiles d'ameublement</p>
                    <div class="product-price">À partir de 5000</div>
                    <ul class="product-features">
                        <li>Coussins décoratifs</li>
                        <li>Plaids luxueux</li>
                        <li>Housses personnalisées</li>
                    </ul>
                    <button class="btn" onclick="openModal('Commander des coussins et textiles')">Commander</button>
                </div>

                <div class="product-card">
                    <div class="product-icon">🪟</div>
                    <h3 class="product-title">Rideaux & Voilages</h3>
                    <p class="product-description">Rideaux sur mesure et voilages élégants</p>
                    <div class="product-price">À partir de 50 000</div>
                    <ul class="product-features">
                        <li>Rideaux sur mesure</li>
                        <li>Voilages modernes</li>
                        <li>Stores d'intérieur</li>
                    </ul>
                    <button class="btn" onclick="openModal('Commander des rideaux et voilages')">Commander</button>
                </div>

                <div class="product-card">
                    <div class="product-icon">🖼️</div>
                    <h3 class="product-title">Tableaux & Art</h3>
                    <p class="product-description">Œuvres d'art et tableaux décoratifs</p>
                    <div class="product-price">À partir de 30 000</div>
                    <ul class="product-features">
                        <li>Tableaux modernes</li>
                        <li>Photographies d'art</li>
                        <li>Cadres personnalisés</li>
                    </ul>
                    <button class="btn" onclick="openModal('Commander des tableaux et art')">Commander</button>
                </div>

                <div class="product-card">
                    <div class="product-icon">🪑</div>
                    <h3 class="product-title">Mobilier Design</h3>
                    <p class="product-description">Meubles et accessoires de décoration</p>
                    <div class="product-price">À partir de 30 000</div>
                    <ul class="product-features">
                        <li>Meubles design</li>
                        <li>Luminaires</li>
                        <li>Objets décoratifs</li>
                    </ul>
                    <button class="btn" onclick="openModal('Commander du mobilier design')">Commander</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="section">
        <div class="container">
            <h2 class="section-title">Nos Services</h2>
            <p class="section-subtitle">De la simple consultation au projet complet, nos experts vous accompagnent à chaque étape de votre transformation d'intérieur.</p>
            
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">🎨</div>
                    <h3 class="product-title">Conseil en Décoration</h3>
                    <p class="product-description">Accompagnement personnalisé pour définir votre style</p>
                    <div class="product-price">À partir de 60 000 CFA</div>
                    <button class="btn" onclick="openBookingModal('Conseil en Décoration')">Réserver</button>
                </div>

                <div class="service-card">
                    <div class="service-icon">🏠</div>
                    <h3 class="product-title">Aménagement Complet</h3>
                    <p class="product-description">Conception et réalisation complète de votre projet</p>
                    <div class="product-price">Sur devis</div>
                    <button class="btn" onclick="openBookingModal('Aménagement Complet')">Réserver</button>
                </div>

                <div class="service-card">
                    <div class="service-icon">🎉</div>
                    <h3 class="product-title">Décoration Événementielle</h3>
                    <p class="product-description">Mise en scène pour vos événements</p>
                    <div class="product-price">À partir de 100 000 CFA</div>
                    <button class="btn" onclick="openBookingModal('Décoration Événementielle')">Réserver</button>
                </div>

                <div class="service-card">
                    <div class="service-icon">🚗</div>
                    <h3 class="product-title">Visite à Domicile</h3>
                    <p class="product-description">Déplacement chez vous pour un diagnostic</p>
                    <div class="product-price">50 000 CFA</div>
                    <button class="btn" onclick="openBookingModal('Visite à Domicile')">Réserver</button>
                </div>
            </div>
        </div>
    </section>

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
            <div class="footer-grid">
                <div class="footer-section">
                    <h4>DécoAura</h4>
                    <p>Votre partenaire de confiance pour transformer vos espaces de vie avec élégance et raffinement depuis 15 ans.</p>
                </div>

                <div class="footer-section">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="#services">Conseil en décoration</a></li>
                        <li><a href="#services">Aménagement complet</a></li>
                        <li><a href="#services">Décoration événementielle</a></li>
                        <li><a href="#services">Visite à domicile</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Produits</h4>
                    <ul>
                        <li><a href="#produits">Coussins & Textiles</a></li>
                        <li><a href="#produits">Rideaux & Voilages</a></li>
                        <li><a href="#produits">Tableaux & Art</a></li>
                        <li><a href="#produits">Mobilier Design</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Contact</h4>
                    <p>📞 77 777 77 77</p>
                    <p>📧 contact@decoelegance.fr</p>
                    <p>📍 123 Rue faidherbe<br>Dakar Senegal</p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2024 DécoAura. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Modal pour commandes -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3 id="modalTitle">Commande</h3>
            <p>Merci pour votre intérêt ! Nous vous contacterons dans les plus brefs délais pour finaliser votre commande.</p>
            <button class="btn" onclick="closeModal()">Fermer</button>
        </div>
    </div>

    <!-- Modal pour réservations -->
    <div id="bookingModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeBookingModal()">&times;</span>
            <h3 id="bookingModalTitle">Réservation</h3>
            <form onsubmit="submitBooking(event)">
                <div class="form-group">
                    <label>Date souhaitée</label>
                    <input type="date" required>
                </div>
                <div class="form-group">
                    <label>Heure préférée</label>
                    <select required>
                        <option value="">Choisir une heure</option>
                        <option value="9h">9h00</option>
                        <option value="10h">10h00</option>
                        <option value="11h">11h00</option>
                        <option value="14h">14h00</option>
                        <option value="15h">15h00</option>
                        <option value="16h">16h00</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nom complet</label>
                    <input type="text" required>
                </div>
                <div class="form-group">
                    <label>Téléphone</label>
                    <input type="tel" required>
                </div>
                <button type="submit" class="btn">Confirmer</button>
            </form>
        </div>
    </div>

<script src="js/script.js"></script>

</body>
</html>