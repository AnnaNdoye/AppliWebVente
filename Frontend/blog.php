<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notre Blog - DécoÉlégance</title>
    <link rel="stylesheet" href="css/blog.css">
</head>
<body>
    <!-- Header identique à la page d'accueil -->
    <header class="header">
        <div class="container">
            <a href="Pageaccueil.php" class="logo">DécoÉlégance</a>
            <nav>
                <ul class="nav">
                    <li><a href="accueilClient.php">Accueil</a></li>
                    <li><a href="produit.php">Produits</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="realisation.php">Réalisations</a></li>
                    <li><a href="blog.php"  style="color:  #ff8c00;">Blog</a></li>
                    <li><a href="about.php">À propos</a></li>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="panier.php">Panier</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
            <div class="contact-header">
                <span style="color: #666;">📞 77 777 77</span>
                <a href="#contact" class="btn">Rendez-vous</a>
            </div>
        </div>
    </header>

    <main>
        <!-- Page Header avec le même style que le hero -->
        <section class="page-header">
            <div class="container">
                <h1>Notre Blog Déco</h1>
                <p>Retrouvez ici nos articles, astuces et les dernières tendances pour embellir votre intérieur avec élégance.</p>
            </div>
        </section>

        <!-- Section de filtres et recherche -->
        <section class="blog-posts">
            <div class="container">
                <div class="blog-filters">
                    <div class="filter-container">
                        <div class="search-box">
                            <input type="search" placeholder="Rechercher un article...">
                        </div>
                        <div class="category-filters">
                            <button class="filter-btn active">Tous</button>
                            <button class="filter-btn">Tendances</button>
                            <button class="filter-btn">Astuces</button>
                            <button class="filter-btn">Guides</button>
                            <button class="filter-btn">Inspiration</button>
                        </div>
                    </div>
                </div>

                <h2 class="section-title">Articles Récents</h2>
                <p class="section-subtitle">Découvrez nos derniers conseils et inspirations pour créer des intérieurs exceptionnels.</p>

                <div class="blog-grid">
                    <article class="blog-post-card">
                        <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Tendances été 2025">
                        <div class="blog-content">
                            <h2>Les Tendances Déco de l'Été 2025 à ne pas manquer</h2>
                            <p class="post-meta">Publié le 2025-07-15 par L'équipe DécoÉlégance</p>
                            <p>Plongez dans les couleurs vibrantes, les matières naturelles et les motifs audacieux qui définissent l'été 2025. Découvrez comment intégrer ces nouvelles tendances dans votre décoration.</p>
                            <a href="#" class="read-more">Lire la suite</a>
                        </div>
                    </article>

                    <article class="blog-post-card">
                        <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Optimiser petits espaces">
                        <div class="blog-content">
                            <h2>5 Astuces Ingénieuses pour Optimiser les Petits Espaces</h2>
                            <p class="post-meta">Publié le 2025-07-10 par L'équipe DécoÉlégance</p>
                            <p>Découvrez comment transformer chaque recoin de votre appartement en un espace fonctionnel et esthétique. Des solutions créatives pour maximiser votre espace de vie.</p>
                            <a href="#" class="read-more">Lire la suite</a>
                        </div>
                    </article>

                    <article class="blog-post-card">
                        <img src="https://www.thespruce.com/thmb/8lFgCMGtKd91DCIX30DZOTpYT2w=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/how-to-clean-wood-furniture-5181301-hero-a713271737af4f639c859b5084f0da7d.jpg" alt="Entretien meubles">
                        <div class="blog-content">
                            <h2>Guide Complet : Entretenir ses Meubles pour une Durée de Vie Maximale</h2>
                            <p class="post-meta">Publié le 2025-07-01 par L'équipe DécoÉlégance</p>
                            <p>Apprenez les gestes simples pour conserver la beauté de vos meubles en bois, métal ou tissu. Des conseils d'experts pour préserver vos investissements déco.</p>
                            <a href="#" class="read-more">Lire la suite</a>
                        </div>
                    </article>

                    <article class="blog-post-card">
                        <img src="https://images.unsplash.com/photo-1556912173-46c336c7fd55?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Couleurs 2025">
                        <div class="blog-content">
                            <h2>Palette de Couleurs 2025 : Comment Créer une Harmonie Parfaite</h2>
                            <p class="post-meta">Publié le 2025-06-25 par L'équipe DécoÉlégance</p>
                            <p>Maîtrisez l'art des associations de couleurs avec notre guide complet. Créez des ambiances uniques grâce aux palettes tendance de cette année.</p>
                            <a href="#" class="read-more">Lire la suite</a>
                        </div>
                    </article>

                    <article class="blog-post-card">
                        <img src="https://images.unsplash.com/photo-1560185007-cde436f6a4d0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Éclairage design">
                        <div class="blog-content">
                            <h2>L'Art de l'Éclairage : Transformer l'Ambiance de vos Pièces</h2>
                            <p class="post-meta">Publié le 2025-06-20 par L'équipe DécoÉlégance</p>
                            <p>Découvrez comment l'éclairage peut métamorphoser vos espaces. Techniques professionnelles et conseils pratiques pour un éclairage d'exception.</p>
                            <a href="#" class="read-more">Lire la suite</a>
                        </div>
                    </article>

                    <article class="blog-post-card">
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Déco minimaliste">
                        <div class="blog-content">
                            <h2>Minimalisme Chic : Moins c'est Plus dans la Décoration</h2>
                            <p class="post-meta">Publié le 2025-06-15 par L'équipe DécoÉlégance</p>
                            <p>Adoptez l'art du minimalisme sans sacrifier l'élégance. Des principes simples pour créer des intérieurs épurés mais chaleureux.</p>
                            <a href="#" class="read-more">Lire la suite</a>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer identique à la page d'accueil -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h4>DécoÉlégance</h4>
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
                    <p>📞 77 123 45 67</p>
                    <p>📧 contact@decoelegance.fr</p>
                    <p>📍 123 Rue faidherbe<br>Dakar Senegal</p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2024 DécoÉlégance. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        // Script pour les filtres
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Script pour la recherche
        document.querySelector('.search-box input').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            document.querySelectorAll('.blog-post-card').forEach(card => {
                const title = card.querySelector('h2').textContent.toLowerCase();
                const content = card.querySelector('p:last-of-type').textContent.toLowerCase();
                if (title.includes(searchTerm) || content.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>