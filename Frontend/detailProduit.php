<?php
require_once '../Backend/fonction.php';

// Vérifier si l'utilisateur est connecté
if (!estConnecte()) {
    header('Location: mon-compte.php');
    exit;
}

// Récupérer l'ID du produit
$produit_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($produit_id <= 0) {
    header('Location: accueilClient.php');
    exit;
}

// Récupérer les détails du produit
$produit = obtenirProduitParId($produit_id);

if (!$produit) {
    header('Location: accueilClient.php?error=produit_inexistant');
    exit;
}

// Récupérer les images du produit
$images = obtenirImagesProduit($produit_id);

// Récupérer les produits du panier pour vérifier si ce produit y est
$produitsPanier = obtenirProduitsPanier($_SESSION['client_id']);

// Calculer le pourcentage de réduction si il y a une promo
$reduction = 0;
if ($produit['prix_promo']) {
    $reduction = round((($produit['prix'] - $produit['prix_promo']) / $produit['prix']) * 100);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($produit['nom']); ?> - Déco Élégance</title>
    <link rel="stylesheet" href="css/style1.css">
    <style>
        .product-detail {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .product-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }
        
        .product-images {
            position: relative;
        }
        
        .main-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        
        .image-thumbnails {
            display: flex;
            gap: 0.5rem;
            overflow-x: auto;
        }
        
        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.3s;
        }
        
        .thumbnail:hover,
        .thumbnail.active {
            opacity: 1;
        }
        
        .product-info {
            padding: 1rem 0;
        }
        
        .product-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #333;
        }
        
        .product-category {
            color: #666;
            margin-bottom: 1rem;
            font-style: italic;
        }
        
        .product-description {
            line-height: 1.6;
            margin-bottom: 2rem;
            color: #555;
        }
        
        .price-section {
            margin-bottom: 2rem;
        }
        
        .price-current {
            font-size: 2rem;
            font-weight: bold;
            color: #e74c3c;
        }
        
        .price-original {
            font-size: 1.2rem;
            text-decoration: line-through;
            color: #999;
            margin-left: 1rem;
        }
        
        .promo-badge {
            display: inline-block;
            background: #e74c3c;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.9rem;
            margin-left: 1rem;
        }
        
        .stock-section {
            margin-bottom: 2rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .stock-available {
            color: #27ae60;
            font-weight: bold;
        }
        
        .stock-limited {
            color: #f39c12;
            font-weight: bold;
        }
        
        .stock-out {
            color: #e74c3c;
            font-weight: bold;
        }
        
        .quantity-section {
            margin-bottom: 2rem;
        }
        
        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .quantity-input {
            width: 80px;
            padding: 0.5rem;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .quantity-btn {
            width: 40px;
            height: 40px;
            border: 1px solid #ddd;
            background: white;
            cursor: pointer;
            border-radius: 4px;
            font-size: 1.2rem;
        }
        
        .quantity-btn:hover {
            background: #f8f9fa;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .btn {
            padding: 1rem 2rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background: #3498db;
            color: white;
        }
        
        .btn-primary:hover {
            background: #2980b9;
        }
        
        .btn-danger {
            background: #e74c3c;
            color: white;
        }
        
        .btn-danger:hover {
            background: #c0392b;
        }
        
        .btn-secondary {
            background: #95a5a6;
            color: white;
            cursor: not-allowed;
        }
        
        .btn-outline {
            background: transparent;
            border: 2px solid #3498db;
            color: #3498db;
        }
        
        .btn-outline:hover {
            background: #3498db;
            color: white;
        }
        
        .product-specs {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 8px;
            margin-top: 2rem;
        }
        
        .specs-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #333;
        }
        
        @media (max-width: 768px) {
            .product-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .quantity-controls {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo"><a href="Pageaccueil.php">Déco Élégance</a></div>
            <nav class="nav">
                <ul class="nav-links">
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
                <div class="user-info">
                    <span>Bonjour, <?php echo htmlspecialchars($_SESSION['client_nom']); ?></span>
                    <a href="?action=deconnexion" class="btn-logout">Déconnexion</a>
                </div>
            </nav>
        </div>
    </header>

    <main class="product-detail">
        <div class="container">
            <!-- Breadcrumb -->
            <nav style="margin-bottom: 2rem;">
                <a href="accueilClient.php">Produits</a> &gt; 
                <span><?php echo htmlspecialchars($produit['categorie_nom']); ?></span> &gt; 
                <strong><?php echo htmlspecialchars($produit['nom']); ?></strong>
            </nav>

            <div class="product-container">
                <!-- Images du produit -->
                <div class="product-images">
                    <img id="mainImage" 
                         src="images/<?php echo htmlspecialchars($produit['image_principale']); ?>" 
                         alt="<?php echo htmlspecialchars($produit['nom']); ?>" 
                         class="main-image">
                    
                    <?php if (!empty($images)): ?>
                        <div class="image-thumbnails">
                            <img src="images/<?php echo htmlspecialchars($produit['image_principale']); ?>" 
                                 alt="Image principale" 
                                 class="thumbnail active" 
                                 onclick="changeMainImage(this.src)">
                            <?php ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Informations du produit -->
                <div class="product-info">
                    <h1 class="product-title"><?php echo htmlspecialchars($produit['nom']); ?></h1>
                    
                    <p class="product-category">
                        Catégorie: <?php echo htmlspecialchars($produit['categorie_nom']); ?>
                    </p>

                    <div class="price-section">
                        <span class="price-current">
                            <?php echo number_format($produit['prix_promo'] ?? $produit['prix'], 2); ?> FCFA
                        </span>
                        <?php if ($produit['prix_promo']): ?>
                            <span class="price-original"><?php echo number_format($produit['prix'], 2); ?> FCFA</span>
                            <span class="promo-badge">-<?php echo $reduction; ?>%</span>
                        <?php endif; ?>
                    </div>

                    <div class="stock-section">
                        <?php if ($produit['stock'] > 10): ?>
                            <span class="stock-available">✓ En stock (<?php echo $produit['stock']; ?> disponibles)</span>
                        <?php elseif ($produit['stock'] > 0): ?>
                            <span class="stock-limited">⚠ Stock limité (<?php echo $produit['stock']; ?> restants)</span>
                        <?php else: ?>
                            <span class="stock-out">✗ Rupture de stock</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($produit['stock'] > 0): ?>
                        <div class="quantity-section">
                            <label for="quantity">Quantité:</label>
                            <div class="quantity-controls">
                                <button type="button" class="quantity-btn" onclick="decreaseQuantity()">-</button>
                                <input type="number" id="quantity" class="quantity-input" value="1" min="1" max="<?php echo $produit['stock']; ?>">
                                <button type="button" class="quantity-btn" onclick="increaseQuantity()">+</button>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="action-buttons">
                        <?php if ($produit['stock'] > 0): ?>
                            <?php if (in_array($produit['id'], $produitsPanier)): ?>
                                <form method="POST" style="flex: 1;">
                                    <input type="hidden" name="action" value="supprimer_panier">
                                    <input type="hidden" name="produit_id" value="<?php echo $produit['id']; ?>">
                                    <button type="submit" class="btn btn-danger" style="width: 100%;">
                                        Retirer du panier
                                    </button>
                                </form>
                            <?php else: ?>
                                <form method="POST" style="flex: 1;">
                                    <input type="hidden" name="action" value="ajouter_panier">
                                    <input type="hidden" name="produit_id" value="<?php echo $produit['id']; ?>">
                                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                                        Ajouter au panier
                                    </button>
                                </form>
                            <?php endif; ?>
                        <?php else: ?>
                            <button class="btn btn-secondary" disabled style="width: 100%;">
                                Produit indisponible
                            </button>
                        <?php endif; ?>
                        
                        <a href="accueilClient.php" class="btn btn-outline">
                            Continuer mes achats
                        </a>
                    </div>

                    <div class="product-description">
                        <h3>Description</h3>
                        <p><?php echo nl2br(htmlspecialchars($produit['description'])); ?></p>
                    </div>

                    <?php if (!empty($produit['caracteristiques'])): ?>
                        <div class="product-specs">
                            <h3 class="specs-title">Caractéristiques</h3>
                            <p><?php echo nl2br(htmlspecialchars($produit['caracteristiques'])); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Déco Élégance. Tous droits réservés.</p>
        </div>
    </footer>

    <script>
        // Fonction pour changer l'image principale
        function changeMainImage(src) {
            document.getElementById('mainImage').src = src;
            
            // Mettre à jour les classes des miniatures
            document.querySelectorAll('.thumbnail').forEach(thumb => {
                thumb.classList.remove('active');
            });
            event.target.classList.add('active');
        }

        // Fonctions pour gérer la quantité
        function increaseQuantity() {
            const input = document.getElementById('quantity');
            const max = parseInt(input.getAttribute('max'));
            const current = parseInt(input.value);
            
            if (current < max) {
                input.value = current + 1;
            }
        }

        function decreaseQuantity() {
            const input = document.getElementById('quantity');
            const current = parseInt(input.value);
            
            if (current > 1) {
                input.value = current - 1;
            }
        }

        // Gestion des messages de succès/erreur
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('success') === 'panier') {
                alert('Produit ajouté au panier avec succès !');
            } else if (urlParams.get('success') === 'supprime') {
                alert('Produit retiré du panier avec succès !');
            } else if (urlParams.get('error')) {
                alert('Une erreur s\'est produite. Veuillez réessayer.');
            }
        });
    </script>
</body>
</html>