<?php
require_once '../Backend/fonction.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DécoLuxe - Nos Catégories</title>
    <style>
        :root {
            --gold: #d4af37;
            --light-gold: #f4e4bc;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #d4af37, #f4e4bc);
            color: #333;
            min-height: 100vh;
        }
        
        header {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 28px;
            font-weight: 700;
            color: var(--gold);
            text-decoration: none;
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin-left: 30px;
        }
        
        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        nav ul li a:hover {
            color: var(--gold);
        }
        
        .hero {
            text-align: center;
            padding: 60px 0 40px;
        }
        
        .hero h1 {
            font-size: 42px;
            margin-bottom: 20px;
            color: #333;
        }
        
        .hero p {
            font-size: 18px;
            color: #555;
            max-width: 700px;
            margin: 0 auto 30px;
        }
        
        .categories {
            padding: 40px 0;
        }
        
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }
        
        .category-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        
        .category-img {
            height: 200px;
            overflow: hidden;
        }
        
        .category-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        
        .category-card:hover .category-img img {
            transform: scale(1.05);
        }
        
        .category-info {
            padding: 20px;
        }
        
        .category-info h3 {
            font-size: 22px;
            margin-bottom: 10px;
            color: #333;
        }
        
        .category-info p {
            color: #666;
            margin-bottom: 15px;
            line-height: 1.5;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: linear-gradient(135deg, var(--gold), var(--light-gold));
            color: #333;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4);
        }
        
        footer {
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 40px 0;
            margin-top: 60px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
        }
        
        .footer-column h3 {
            color: var(--gold);
            margin-bottom: 20px;
            font-size: 18px;
        }
        
        .footer-column ul {
            list-style: none;
        }
        
        .footer-column ul li {
            margin-bottom: 10px;
        }
        
        .footer-column ul li a {
            color: #ddd;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-column ul li a:hover {
            color: var(--gold);
        }
        
        .copyright {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #444;
            color: #aaa;
        }
        
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
            }
            
            nav ul {
                margin-top: 20px;
            }
            
            nav ul li {
                margin: 0 10px;
            }
            
            .hero h1 {
                font-size: 32px;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container header-content">
            <a href="#" class="logo">DécoÉlégance</a>
            <nav>
                <ul>
                    <li><a href="accueilClient.php">Accueil</a></li>
                    <li><a href="produit.php" style="color:  #ff8c00;">Produits</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="realisation.php">Réalisations</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="about.php">À propos</a></li>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="panier.php">Panier</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <section class="hero">
        <div class="container">
            <h1>Nos Catégories de Décoration</h1>
            <p>Découvrez notre sélection exclusive d'articles de décoration pour embellir votre intérieur avec élégance et style.</p>
        </div>
    </section>
    
    <section class="categories">
        <div class="container">
            <div class="categories-grid">
                <!-- Tapis -->
                <div class="category-card">
                    <div class="category-img">
                        <img src="https://images.unsplash.com/photo-1444362408440-274ecb6fc730?q=80&w=1174&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Tapis de luxe">
                    </div>
                    <div class="category-info">
                        <h3>Tapis</h3>
                        <p>Découvrez notre collection de tapis haut de gamme pour apporter chaleur et élégance à vos sols.</p>
                        <a href="Tapis.php" class="btn">Voir la collection</a>
                    </div>
                </div>
                
                <!-- Meubles -->
                <div class="category-card">
                    <div class="category-img">
                        <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Meubles design">
                    </div>
                    <div class="category-info">
                        <h3>Meubles</h3>
                        <p>Des meubles uniques et fonctionnels pour transformer votre espace de vie en un havre de paix.</p>
                        <a href="Meubles.php" class="btn">Voir la collection</a>
                    </div>
                </div>
                
                <!-- Luminaires -->
                <div class="category-card">
                    <div class="category-img">
                        <img src="https://images.unsplash.com/photo-1513506003901-1e6a229e2d15?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Luminaires modernes">
                    </div>
                    <div class="category-info">
                        <h3>Luminaires</h3>
                        <p>Éclairages design et innovants pour créer des ambiances uniques dans chaque pièce de votre maison.</p>
                        <a href="Luminaires.php" class="btn">Voir la collection</a>
                    </div>
                </div>
                
                <!-- Textiles -->
                <div class="category-card">
                    <div class="category-img">
                        <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Textiles d'intérieur">
                    </div>
                    <div class="category-info">
                        <h3>Textiles</h3>
                        <p>Rideaux, coussins et linge de maison en matières nobles pour un intérieur douillet et raffiné.</p>
                        <a href="Textiles.php" class="btn">Voir la collection</a>
                    </div>
                </div>
                
                <!-- Décoration murale -->
                <div class="category-card">
                    <div class="category-img">
                        <img src="https://images.unsplash.com/photo-1536782376847-5c9d14d97cc0?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Décoration murale">
                    </div>
                    <div class="category-info">
                        <h3>Décoration murale</h3>
                        <p>Tableaux, miroirs et objets muraux pour personnaliser vos murs avec style et originalité.</p>
                        <a href="decomur.php" class="btn">Voir la collection</a>
                    </div>
                </div>
                
                <!-- Accessoires -->
                <div class="category-card">
                    <div class="category-img">
                        <img src="https://images.unsplash.com/photo-1565538810643-b5bdb714032a?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Accessoires déco">
                    </div>
                    <div class="category-info">
                        <h3>Accessoires</h3>
                        <p>Petits objets déco qui font la différence pour une touche finale parfaite à votre intérieur.</p>
                        <a href="accessoire.php" class="btn">Voir la collection</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>DécoLuxe</h3>
                    <p>Votre destination premium pour la décoration d'intérieur haut de gamme depuis 2010.</p>
                </div>
                <div class="footer-column">
                    <h3>Catégories</h3>
                    <ul>
                        <li><a href="#">Tapis</a></li>
                        <li><a href="#">Meubles</a></li>
                        <li><a href="#">Luminaires</a></li>
                        <li><a href="#">Textiles</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Informations</h3>
                    <ul>
                        <li><a href="#">Livraison</a></li>
                        <li><a href="#">Paiement</a></li>
                        <li><a href="#">Retours</a></li>
                        <li><a href="#">CGV</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Contact</h3>
                    <ul>
                        <li><a href="tel:+33123456789">77 777 77 77</a></li>
                        <li><a href="mailto:contact@decoluxe.com">contact@decoelegance.com</a></li>
                        <li>Rue faidherbe</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                &copy; 2023 DécoÉlégance. Tous droits réservés.
            </div>
        </div>
    </footer>

    <script>
        // Animation au scroll
        document.addEventListener('DOMContentLoaded', function() {
            const categoryCards = document.querySelectorAll('.category-card');
            
            // Observer pour l'animation des cartes
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });
            
            // Initialisation des styles et observation
            categoryCards.forEach((card, index) => {
                card.style.opacity = 0;
                card.style.transform = 'translateY(20px)';
                card.style.transition = `all 0.5s ease ${index * 0.1}s`;
                observer.observe(card);
            });
            
            // Effet de survol amélioré
            categoryCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    const img = this.querySelector('img');
                    if (img) {
                        img.style.transform = 'scale(1.05)';
                    }
                });
                
                card.addEventListener('mouseleave', function() {
                    const img = this.querySelector('img');
                    if (img) {
                        img.style.transform = 'scale(1)';
                    }
                });
            });
        });
    </script>
</body>
</html>