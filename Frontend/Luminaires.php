<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luminaires - Déco Élégance</title>
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
        
       /* ========== HEADER STYLES ========== */
header {
    background-color: #fff;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 0;
    z-index: 1000;
    padding: 15px 0;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.logo a {
    font-size: 1.8rem;
    font-weight: 700;
    color: #d4af37;
    text-decoration: none;
    background: linear-gradient(135deg, #d4af37, #f4e4bc);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    transition: all 0.3s ease;
}

.logo a:hover {
    opacity: 0.8;
}

.main-menu {
    display: flex;
    list-style: none;
    gap: 1.8rem;
    margin: 0;
    padding: 0;
}

.main-menu li {
    position: relative;
}

.main-menu li a {
    color: #333;
    text-decoration: none;
    font-weight: 500;
    font-size: 1rem;
    padding: 8px 0;
    transition: all 0.3s ease;
    position: relative;
}

.main-menu li a:hover {
    color: #d4af37;
}

.main-menu li a::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #d4af37, #f4e4bc);
    transition: width 0.3s ease;
}

.main-menu li a:hover::after {
    width: 100%;
}

.user-actions {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.user-actions input[type="search"] {
    padding: 8px 15px;
    border: 1px solid #e0e0e0;
    border-radius: 25px;
    outline: none;
    font-size: 0.9rem;
    transition: all 0.3s;
    width: 180px;
}

.user-actions input[type="search"]:focus {
    border-color: #d4af37;
    box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.2);
}

.icon-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #333;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.3s;
}

.icon-link:hover {
    color: #d4af37;
}

.icon-link img {
    width: 20px;
    height: 20px;
    transition: transform 0.3s;
}

.icon-link:hover img {
    transform: scale(1.1);
}

/* ========== RESPONSIVE DESIGN ========== */
@media (max-width: 1024px) {
    .main-menu {
        gap: 1.2rem;
    }
    
    .user-actions input[type="search"] {
        width: 150px;
    }
}

@media (max-width: 768px) {
    nav {
        flex-direction: column;
        gap: 1rem;
        padding: 0 15px;
    }
    
    .main-menu {
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.8rem 1.2rem;
    }
    
    .user-actions {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .logo a {
        font-size: 1.5rem;
    }
    
    .main-menu {
        gap: 0.5rem 1rem;
    }
    
    .main-menu li a {
        font-size: 0.9rem;
    }
    
    .user-actions {
        flex-direction: column;
        gap: 0.8rem;
    }
    
    .user-actions input[type="search"] {
        width: 100%;
    }
}
        .breadcrumb {
            padding: 20px 0;
            font-size: 14px;
        }
        
        .breadcrumb a {
            color: #555;
            text-decoration: none;
        }
        
        .breadcrumb a:hover {
            text-decoration: underline;
        }
        
        .breadcrumb span {
            color: var(--gold);
            margin: 0 5px;
        }
        
        .collection-header {
            text-align: center;
            padding: 30px 0;
        }
        
        .collection-header h1 {
            font-size: 36px;
            margin-bottom: 15px;
        }
        
        .collection-header p {
            color: #555;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            padding: 30px 0;
        }
        
        .product-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .product-img {
            height: 250px;
            overflow: hidden;
            position: relative;
        }
        
        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        
        .product-card:hover .product-img img {
            transform: scale(1.05);
        }
        
        .product-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--gold);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .product-info {
            padding: 20px;
        }
        
        .product-info h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        
        .product-info .product-description {
            color: #666;
            margin-bottom: 15px;
            font-size: 14px;
            line-height: 1.5;
        }
        
        .product-info .product-price {
            font-size: 22px;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
        }
        
        .product-info .product-origin {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 12px;
            color: #888;
        }
        
        .product-info .product-origin img {
            width: 20px;
            margin-right: 5px;
        }
        
        .product-actions {
            display: flex;
            justify-content: space-between;
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
            font-size: 14px;
        }
        
        .btn-outline {
            background: transparent;
            border: 1px solid var(--gold);
            color: var(--gold);
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4);
        }
        
        .btn-outline:hover {
            background: rgba(212, 175, 55, 0.1);
        }
        
        .product-details {
            margin-top: 5px;
            font-size: 13px;
            color: #888;
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
        
        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            overflow-y: auto;
        }
        
        .modal-content {
            background-color: white;
            margin: 50px auto;
            max-width: 900px;
            border-radius: 10px;
            overflow: hidden;
            animation: modalFadeIn 0.3s;
        }
        
        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .modal-header h2 {
            font-size: 24px;
        }
        
        .close-modal {
            font-size: 30px;
            cursor: pointer;
            color: #999;
            transition: color 0.3s;
        }
        
        .close-modal:hover {
            color: #333;
        }
        
        .modal-body {
            display: flex;
            flex-direction: column;
            padding: 20px;
        }
        
        .modal-product {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
        
        .modal-product-images {
            display: grid;
            grid-template-columns: 80px 1fr;
            gap: 10px;
        }
        
        .modal-thumbnails {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .modal-thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            cursor: pointer;
            border: 1px solid #eee;
            border-radius: 5px;
        }
        
        .modal-thumbnail.active {
            border-color: var(--gold);
        }
        
        .modal-main-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 5px;
        }
        
        .modal-product-info h3 {
            font-size: 28px;
            margin-bottom: 15px;
        }
        
        .modal-product-price {
            font-size: 24px;
            font-weight: 700;
            color: var(--gold);
            margin-bottom: 20px;
        }
        
        .modal-product-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        
        .modal-product-details {
            margin-bottom: 20px;
        }
        
        .modal-product-details h4 {
            margin-bottom: 10px;
            font-size: 18px;
        }
        
        .modal-product-details ul {
            list-style-position: inside;
            color: #666;
        }
        
        .modal-product-details li {
            margin-bottom: 5px;
        }
        
        .modal-actions {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .quantity-selector {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .quantity-btn {
            width: 30px;
            height: 30px;
            background-color: #f5f5f5;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }
        
        .quantity-input {
            width: 50px;
            height: 30px;
            text-align: center;
            border: 1px solid #ddd;
            margin: 0 5px;
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
            
            .modal-product {
                grid-template-columns: 1fr;
            }
            
            .modal-product-images {
                grid-template-columns: 60px 1fr;
            }
            
            .modal-thumbnail {
                width: 60px;
                height: 60px;
            }
            
            .modal-main-image {
                height: 300px;
            }
        }
 
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo"><a href="index.html">Déco Élégance</a></div>
            <ul class="main-menu"><li>
                <a href="accueilClient.php">Accueil</a></li>
                <li><a href="produit.php">Produits</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="realisation.php">Réalisations</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="about.php">À propos</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="panier.php">Panier</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <div class="user-actions">
                <input type="search" placeholder="Rechercher...">
              
            </div>
        </nav>
    </header>

    <main>
        <section class="collection-header">
            <h1>Collection Luminaires</h1>
            <p>Découvrez notre sélection exclusive de luminaires pour créer des ambiances uniques dans chaque pièce.</p>
        </section>

        <section class="products-grid">
            <!-- Luminaire 1 -->
            <div class="product-card" data-product="1">
                <div class="product-img">
                    <img src="https://media.istockphoto.com/id/1639202832/fr/photo/fixation-de-luminaire.webp?a=1&b=1&s=612x612&w=0&k=20&c=Nye4-KFhovI60T3RigKMsWID0nNpOd764kKO8X8hNMM=" alt="Suspension en verre soufflé">
                    <span class="product-badge">Nouveau</span>
                </div>
                <div class="product-info">
                    <h3>Suspension "Éther"</h3>
                    <p class="product-description">Suspension en verre soufflé à la main, diffusion lumineuse douce et uniforme.</p>
                    <div class="product-price">25 000 CFA</div>
                    <div class="product-origin">
                        <img src="https://media.istockphoto.com/id/1639202832/fr/photo/fixation-de-luminaire.webp?a=1&b=1&s=612x612&w=0&k=20&c=Nye4-KFhovI60T3RigKMsWID0nNpOd764kKO8X8hNMM=" alt="Italie"> Fabriqué en Italie
                    </div>
                    <div class="product-details">Hauteur: 45cm · Diamètre: 35cm</div>
                    <div class="product-actions">
                        <button class="btn-outline" onclick="openModal(1)">Détails</button>
                        <button class="btn">Ajouter au panier</button>
                    </div>
                </div>
            </div>

            <!-- Luminaire 2 -->
            <div class="product-card" data-product="2">
                <div class="product-img">
                    <img src="https://images.unsplash.com/photo-1542728928-1413d1894ed1?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fGxhbXBlfGVufDB8fDB8fHww" alt="Lampe à poser en marbre">
                </div>
                <div class="product-info">
                    <h3>Lampe "Minéral"</h3>
                    <p class="product-description">Lampe à poser en marbre blanc de Carrare avec abat-jour en lin.</p>
                    <div class="product-price">25 000 CFA</div>
                    <div class="product-origin">
                        <img src="https://images.unsplash.com/photo-1542728928-1413d1894ed1?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fGxhbXBlfGVufDB8fDB8fHww" alt="France"> Fabriqué en France
                    </div>
                    <div class="product-details">Hauteur: 55cm · Matière: Marbre</div>
                    <div class="product-actions">
                        <button class="btn-outline" onclick="openModal(2)">Détails</button>
                        <button class="btn">Ajouter au panier</button>
                    </div>
                </div>
            </div>

            <!-- Luminaire 3 -->
            <div class="product-card" data-product="3">
                <div class="product-img">
                    <img src="https://images.unsplash.com/photo-1540932239986-30128078f3c5?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8bGFtcGV8ZW58MHx8MHx8fDA%3D" alt="Applique murale design">
                    <span class="product-badge">Best-seller</span>
                </div>
                <div class="product-info">
                    <h3>Applique "Filament"</h3>
                    <p class="product-description">Applique murale design avec ampoule filament visible, style industriel.</p>
                    <div class="product-price">30 000 CFA</div>
                    <div class="product-origin">
                        <img src="https://images.unsplash.com/photo-1540932239986-30128078f3c5?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8bGFtcGV8ZW58MHx8MHx8fDA%3D" alt="Espagne"> Fabriqué en Espagne
                    </div>
                    <div class="product-details">Longueur: 60cm · Métal brossé</div>
                    <div class="product-actions">
                        <button class="btn-outline" onclick="openModal(3)">Détails</button>
                        <button class="btn">Ajouter au panier</button>
                    </div>
                </div>
            </div>

           

           

            
                
        
        </section>

        <!-- Modal -->
        <div id="productModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="modalProductTitle">Suspension "Éther"</h2>
                    <span class="close-modal" onclick="closeModal()">&times;</span>
                </div>
                <div class="modal-body">
                    <div class="modal-product">
                        <div class="modal-product-images">
                            <div class="modal-thumbnails">
                                <img src="https://media.istockphoto.com/id/1639202832/fr/photo/fixation-de-luminaire.webp?a=1&b=1&s=612x612&w=0&k=20&c=Nye4-KFhovI60T3RigKMsWID0nNpOd764kKO8X8hNMM=" alt="Suspension Éther" class="modal-thumbnail active" onclick="changeMainImage(this)">
                                
                            </div>
                            <img src="https://media.istockphoto.com/id/1639202832/fr/photo/fixation-de-luminaire.webp?a=1&b=1&s=612x612&w=0&k=20&c=Nye4-KFhovI60T3RigKMsWID0nNpOd764kKO8X8hNMM=" alt="Suspension Éther" class="modal-main-image">
                        </div>
                        <div class="modal-product-info">
                            <h3 id="modalProductName">Suspension "Éther"</h3>
                            <div class="modal-product-price" id="modalProductPrice">15 000 CFA</div>
                            <div class="modal-product-description" id="modalProductDescription">
                                Cette suspension artisanale en verre soufflé à la main diffuse une lumière douce et uniforme, créant une ambiance chaleureuse. Chaque pièce est unique grâce au travail manuel des artisans verriers italiens.
                            </div>
                            <div class="modal-product-details">
                                <h4>Caractéristiques</h4>
                                <ul id="modalProductFeatures">
                                    <li>Matériau : Verre soufflé à la main</li>
                                    <li>Dimensions : 45cm (H) x 35cm (Ø)</li>
                                    <li>Poids : 3.2 kg</li>
                                    <li>Ampoule incluse : LED 9W (non-dimmable)</li>
                                    <li>Installation : Suspendu (câble inclus)</li>
                                    <li>Garantie : 2 ans</li>
                                </ul>
                            </div>
                            <div class="quantity-selector">
                                <button class="quantity-btn" onclick="changeQuantity(-1)">-</button>
                                <input type="number" class="quantity-input" value="1" min="1">
                                <button class="quantity-btn" onclick="changeQuantity(1)">+</button>
                            </div>
                            <div class="modal-actions">
                                <button class="btn-outline">
                                    <i class="far fa-heart"></i> Ajouter aux favoris
                                </button>
                                <button class="btn">
                                    <i class="fas fa-shopping-cart"></i> Ajouter au panier
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Déco Élégance</h3>
                    <p>Votre destination premium pour la décoration d'intérieur haut de gamme depuis 2010.</p>
                </div>
                <div class="footer-column">
                    <h3>Catégories</h3>
                    <ul>
                        <li><a href="#">Tapis</a></li>
                        <li><a href="#">Luminaires</a></li>
                        <li><a href="#">Meubles</a></li>
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
                        <li><a href="tel:+33123456789">01 23 45 67 89</a></li>
                        <li><a href="mailto:contact@decoelegance.com">contact@decoelegance.com</a></li>
                        <li>12 Rue du Luxe, 75008 Paris</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                &copy; 2025 Déco Élégance. Tous droits réservés.
            </div>
        </div>
    </footer>

    <script>// Données des produits
const products = {
    1: {
        title: "Suspension \"Éther\"",
        price: "249 €",
        description: "Cette suspension artisanale en verre soufflé à la main diffuse une lumière douce et uniforme, créant une ambiance chaleureuse. Chaque pièce est unique grâce au travail manuel des artisans verriers italiens.",
        features: [
            "Matériau : Verre soufflé à la main",
            "Dimensions : 45cm (H) x 35cm (Ø)",
            "Poids : 3.2 kg",
            "Ampoule incluse : LED 9W (non-dimmable)",
            "Installation : Suspendu (câble inclus)",
            "Garantie : 2 ans"
        ],
        images: [
            "images/luminaire1.jpg",
            "images/luminaire1_detail.jpg",
            "images/luminaire1_ambiance.jpg"
        ]
    },
    2: {
        title: "Lampe \"Minéral\"",
        price: "179 €",
        description: "Lampe à poser en marbre blanc de Carrare avec abat-jour en lin naturel. La base en marbre massif apporte stabilité et élégance à ce luminaire intemporel.",
        features: [
            "Matériau : Marbre de Carrare & lin",
            "Dimensions : 55cm (H) x 25cm (Ø)",
            "Poids : 4.8 kg",
            "Ampoule : E27 max 60W (non incluse)",
            "Interrupteur : Intégré au câble",
            "Garantie : 2 ans"
        ],
        images: [
            "images/luminaire2.jpg",
            "images/luminaire2_detail.jpg",
            "images/luminaire2_ambiance.jpg"
        ]
    },
    // ... Ajouter les autres produits de la même manière
};

// Fonctions identiques à la page tapis
function openModal(productId) {
    const product = products[productId];
    if (!product) return;
    
    // Même implémentation que la page tapis
    // ...
}

function closeModal() {
    // ...
}

function changeMainImage(element) {
    // ...
}

function changeQuantity(change) {
    // ...
}

// Animation au chargement
document.addEventListener('DOMContentLoaded', function() {
    const productCards = document.querySelectorAll('.product-card');
    
    productCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = `all 0.5s ease ${index * 0.1}s`;
        
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100);
    });
});</script>
</body>
</html>