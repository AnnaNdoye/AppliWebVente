<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DécoLuxe - Collection Tapis</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="container header-content">
            <a href="#" class="logo">DécoÉlégance</a>
            <nav>
                <ul>
                    <li><a href="accueilClient.php">Accueil</a></li>
                    <li><a href="produit.php">Produits</a></li>
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
    
    
        
        <div class="collection-header">
            <h1>Collection Tapis</h1>
            <p>Découvrez notre sélection exclusive de tapis haut de gamme pour apporter chaleur, élégance et confort à votre intérieur.</p>
        </div>
        
        <div class="products-grid">
            <!-- Tapis 1 -->
            <div class="product-card" data-product="1">
                <div class="product-img">
                    <img src="https://images.unsplash.com/photo-1444362408440-274ecb6fc730?q=80&w=1174&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Tapis Persan">
                    <span class="product-badge">Nouveau</span>
                </div>
                <div class="product-info">
                    <h3>Tapis Persan "Shiraz"</h3>
                    <p class="product-description">Tapis en laine pure tissé à la main avec motifs traditionnels persans.</p>
                    <div class="product-price">500 000 CFA</div>
                    <div class="product-origin">
                        <img src="https://flagcdn.com/w20/ir.png" alt="Iran"> Fabriqué en Iran
                    </div>
                    <div class="product-details">150x200 cm · Laine naturelle</div>
                    <div class="product-actions">
                        <button class="btn-outline" onclick="openModal(1)">Détails</button>
                        <button class="btn">Ajouter au panier</button>
                    </div>
                </div>
            </div>
            
            <!-- Tapis 2 -->
            <div class="product-card" data-product="2">
                <div class="product-img">
                    <img src="https://plus.unsplash.com/premium_photo-1670876807290-275ea26f8677?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Tapis Moderne">
                </div>
                <div class="product-info">
                    <h3>Tapis Moderne "Nordic"</h3>
                    <p class="product-description">Tapis design en fibres synthétiques résistantes, facile d'entretien.</p>
                    <div class="product-price">150 000 CFA</div>
                    <div class="product-origin">
                        <img src="https://flagcdn.com/w20/be.png" alt="Belgique"> Fabriqué en Belgique
                    </div>
                    <div class="product-details">160x230 cm · Polypropylène</div>
                    <div class="product-actions">
                        <button class="btn-outline" onclick="openModal(2)">Détails</button>
                        <button class="btn">Ajouter au panier</button>
                    </div>
                </div>
            </div>
            
            <!-- Tapis 3 -->
            <div class="product-card" data-product="3">
                <div class="product-img">
                    <img src="https://plus.unsplash.com/premium_photo-1725295198184-5dde96badeba?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Tapis Berbère">
                    <span class="product-badge">Best-seller</span>
                </div>
                <div class="product-info">
                    <h3>Tapis Berbère "Atlas"</h3>
                    <p class="product-description">Tapis artisanal en laine de mouton, motifs géométriques traditionnels.</p>
                    <div class="product-price">250 000 CFA</div>
                    <div class="product-origin">
                        <img src="https://flagcdn.com/w20/ma.png" alt="Maroc"> Fabriqué au Maroc
                    </div>
                    <div class="product-details">140x200 cm · Laine de mouton</div>
                    <div class="product-actions">
                        <button class="btn-outline" onclick="openModal(3)">Détails</button>
                        <button class="btn">Ajouter au panier</button>
                    </div>
                </div>
            </div>
            
            <!-- Tapis 4 -->
            <div class="product-card" data-product="4">
                <div class="product-img">
                    <img src="https://images.unsplash.com/photo-1600166898405-da9535204843?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Tapis Vintage">
                </div>
                <div class="product-info">
                    <h3>Tapis Vintage "Boho"</h3>
                    <p class="product-description">Tapis recyclé aux couleurs chaudes, style bohème chic.</p>
                    <div class="product-price">400 000 CFA</div>
                    <div class="product-origin">
                        <img src="https://flagcdn.com/w20/in.png" alt="Inde"> Fabriqué en Inde
                    </div>
                    <div class="product-details">120x180 cm · Coton recyclé</div>
                    <div class="product-actions">
                        <button class="btn-outline" onclick="openModal(4)">Détails</button>
                        <button class="btn">Ajouter au panier</button>
                    </div>
                </div>
            </div>
            
            <!-- Tapis 5 -->
            <div class="product-card" data-product="5">
                <div class="product-img">
                    <img src="https://media.istockphoto.com/id/1301012629/fr/photo/vieille-texture-rouge-de-tapis-persan-ornement-abstrait.webp?a=1&b=1&s=612x612&w=0&k=20&c=VodU8hUD5HEBKvoIY9juvywfWzgLQ8dM5lnED7Dm2HE=" alt="Tapis d'Orient">
                </div>
                <div class="product-info">
                    <h3>Tapis d'Orient "Sultan"</h3>
                    <p class="product-description">Tapis de luxe en soie et laine, motifs complexes et couleurs vives.</p>
                    <div class="product-price">600 000 CFA</div>
                    <div class="product-origin">
                        <img src="https://flagcdn.com/w20/tr.png" alt="Turquie"> Fabriqué en Turquie
                    </div>
                    <div class="product-details">200x300 cm · Soie & laine</div>
                    <div class="product-actions">
                        <button class="btn-outline" onclick="openModal(5)">Détails</button>
                        <button class="btn">Ajouter au panier</button>
                    </div>
                </div>
            </div>
            
            <!-- Tapis 6 -->
            <div class="product-card" data-product="6">
                <div class="product-img">
                    <img src="https://plus.unsplash.com/premium_photo-1668447600881-5d09400fdd63?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fHRhcGlzJTIwc2NhbmRpbmF2ZXxlbnwwfHwwfHx8MA%3D%3D" alt="Tapis Scandinave">
                    <span class="product-badge">Promo</span>
                </div>
                <div class="product-info">
                    <h3>Tapis Scandinave "Minimal"</h3>
                    <p class="product-description">Tapis épais et doux, design épuré aux tons neutres.</p>
                    <div class="product-price">90 000 CFA <span style="text-decoration: line-through; color: #999; font-size: 16px; margin-left: 5px;">599 €</span></div>
                    <div class="product-origin">
                        <img src="https://flagcdn.com/w20/se.png" alt="Suède"> Fabriqué en Suède
                    </div>
                    <div class="product-details">170x240 cm · Laine et coton</div>
                    <div class="product-actions">
                        <button class="btn-outline" onclick="openModal(6)">Détails</button>
                        <button class="btn">Ajouter au panier</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal pour les détails du produit -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalProductTitle">Tapis Persan "Shiraz"</h2>
                <span class="close-modal" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <div class="modal-product">
                    <div class="modal-product-images">
                        <div class="modal-thumbnails">
                            <img src="https://images.unsplash.com/photo-1444362408440-274ecb6fc730?q=80&w=1174&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Tapis Persan" class="modal-thumbnail active" onclick="changeMainImage(this)">
                            <img src="https://images.unsplash.com/photo-1444362408440-274ecb6fc730?q=80&w=1174&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Tapis Persan détail" class="modal-thumbnail" onclick="changeMainImage(this)">
                            <img src="https://images.unsplash.com/photo-1444362408440-274ecb6fc730?q=80&w=1174&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Tapis Persan motif" class="modal-thumbnail" onclick="changeMainImage(this)">
                        </div>
                        <img src="https://images.unsplash.com/photo-1444362408440-274ecb6fc730?q=80&w=1174&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Tapis Persan" class="modal-main-image">
                    </div>
                    <div class="modal-product-info">
                        <h3 id="modalProductName">Tapis Persan "Shiraz"</h3>
                        <div class="modal-product-price" id="modalProductPrice">500 000 CFA</div>
                        <div class="modal-product-description" id="modalProductDescription">
                            Ce magnifique tapis persan "Shiraz" est tissé à la main par des artisans iraniens selon des techniques traditionnelles vieilles de plusieurs siècles. Fabriqué en laine pure de haute qualité, il présente des motifs complexes et des couleurs riches qui s'amélioreront avec le temps.
                        </div>
                        <div class="modal-product-details">
                            <h4>Caractéristiques</h4>
                            <ul id="modalProductFeatures">
                                <li>Dimensions : 150x200 cm</li>
                                <li>Matière : 100% laine naturelle</li>
                                <li>Origine : Shiraz, Iran</li>
                                <li>Poids : 8 kg</li>
                                <li>Épaisseur : 1,5 cm</li>
                                <li>Entretien : Nettoyage à sec recommandé</li>
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
                        <li>Dakar </li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                &copy; 2023 DécoÉlégance. Tous droits réservés.
            </div>
        </div>
    </footer>

    <script>
        // Données des produits
        const products = {
            1: {
                title: "Tapis Persan \"Shiraz\"",
                price: "500 000 CFA",
                description: "Ce magnifique tapis persan \"Shiraz\" est tissé à la main par des artisans iraniens selon des techniques traditionnelles vieilles de plusieurs siècles. Fabriqué en laine pure de haute qualité, il présente des motifs complexes et des couleurs riches qui s'amélioreront avec le temps.",
                features: [
                    "Dimensions : 150x200 cm",
                    "Matière : 100% laine naturelle",
                    "Origine : Shiraz, Iran",
                    "Poids : 8 kg",
                    "Épaisseur : 1,5 cm",
                    "Entretien : Nettoyage à sec recommandé"
                ],
                images: [
                    "https://images.unsplash.com/photo-1444362408440-274ecb6fc730?q=80&w=1174&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1444362408440-274ecb6fc730?q=80&w=1174&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "https://images.unsplash.com/photo-1444362408440-274ecb6fc730?q=80&w=1174&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                ]
            },
            2: {
                title: "Tapis Moderne \"Nordic\"",
                price: "150 000 CFA",
                description: "Notre tapis \"Nordic\" allie design contemporain et praticité. Ses fibres synthétiques de haute qualité résistent à l'usure tout en restant douces sous les pieds. Son motif géométrique moderne s'intègre parfaitement dans les intérieurs scandinaves ou minimalistes.",
                features: [
                    "Dimensions : 160x230 cm",
                    "Matière : Polypropylène haute résistance",
                    "Origine : Bruges, Belgique",
                    "Poids : 4 kg",
                    "Épaisseur : 1 cm",
                    "Entretien : Lavable en machine à 30°C"
                ],
                images: [
                    "https://plus.unsplash.com/premium_photo-1670876807290-275ea26f8677?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                
                    
                ]
            },
            3: {
                title: "Tapis Berbère \"Atlas\"",
                price: " 250 000 CFA",
                description: "Authentique tapis berbère tissé à la main par les femmes de la région de l'Atlas marocain. Sa laine de mouton naturelle offre une douceur incomparable et une excellente isolation thermique. Les motifs géométriques traditionnels racontent l'histoire de la tribu qui l'a créé.",
                features: [
                    "Dimensions : 140x200 cm",
                    "Matière : Laine de mouton naturelle",
                    "Origine : Atlas, Maroc",
                    "Poids : 6 kg",
                    "Épaisseur : 2 cm",
                    "Entretien : Aspiration régulière, nettoyage à sec occasionnel"
                ],
                images: [
                    "https://plus.unsplash.com/premium_photo-1725295198184-5dde96badeba?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                ]
            }
        };

        // Fonction pour ouvrir le modal avec les détails du produit
        function openModal(productId) {
            const product = products[productId];
            if (!product) return;
            
            document.getElementById('modalProductTitle').textContent = product.title;
            document.getElementById('modalProductName').textContent = product.title;
            document.getElementById('modalProductPrice').textContent = product.price;
            document.getElementById('modalProductDescription').textContent = product.description;
            
            const featuresList = document.getElementById('modalProductFeatures');
            featuresList.innerHTML = '';
            product.features.forEach(feature => {
                const li = document.createElement('li');
                li.textContent = feature;
                featuresList.appendChild(li);
            });
            
            // Mise à jour des images
            const thumbnailsContainer = document.querySelector('.modal-thumbnails');
            thumbnailsContainer.innerHTML = '';
            
            product.images.forEach((imgSrc, index) => {
                const thumbnail = document.createElement('img');
                thumbnail.src = imgSrc;
                thumbnail.alt = product.title;
                thumbnail.className = 'modal-thumbnail' + (index === 0 ? ' active' : '');
                thumbnail.onclick = function() { changeMainImage(this); };
                thumbnailsContainer.appendChild(thumbnail);
            });
            
            document.querySelector('.modal-main-image').src = product.images[0];
            
            document.getElementById('productModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
        
        // Fonction pour fermer le modal
        function closeModal() {
            document.getElementById('productModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        
        // Fonction pour changer l'image principale
        function changeMainImage(element) {
            document.querySelectorAll('.modal-thumbnail').forEach(thumb => {
                thumb.classList.remove('active');
            });
            
            element.classList.add('active');
            document.querySelector('.modal-main-image').src = element.src;
        }
        
        // Fonction pour modifier la quantité
        function changeQuantity(change) {
            const input = document.querySelector('.quantity-input');
            let value = parseInt(input.value) + change;
            if (value < 1) value = 1;
            input.value = value;
        }
        
        // Fermer le modal en cliquant en dehors
        window.onclick = function(event) {
            const modal = document.getElementById('productModal');
            if (event.target === modal) {
                closeModal();
            }
        }
        
        // Animation des produits au chargement
        document.addEventListener('DOMContentLoaded', function() {
            const productCards = document.querySelectorAll('.product-card');
            
            productCards.forEach((card, index) => {
                card.style.opacity = 0;
                card.style.transform = 'translateY(20px)';
                card.style.transition = `all 0.5s ease ${index * 0.1}s`;
                
                setTimeout(() => {
                    card.style.opacity = 1;
                    card.style.transform = 'translateY(0)';
                }, 100);
            });
        });
    </script>
</body>
</html>