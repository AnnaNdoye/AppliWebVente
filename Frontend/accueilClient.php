<?php
require_once '../Backend/fonction.php';

// Vérifier si l'utilisateur est connecté
if (!estConnecte()) {
    header('Location: mon-compte.php');
    exit;
}

// Récupération des produits et catégories
$produits = obtenirProduits();
$categories = obtenirCategories();
$produitsPanier = obtenirProduitsPanier($_SESSION['client_id']);

// Traitement des filtres
$filtreCategorie = isset($_GET['categorie']) ? (int)$_GET['categorie'] : 0;
$filtreTri = isset($_GET['tri']) ? $_GET['tri'] : 'populaire';

if ($filtreCategorie > 0) {
    $produits = array_filter($produits, function($produit) use ($filtreCategorie) {
        return $produit['categorie_id'] == $filtreCategorie;
    });
}

// Tri des produits
switch ($filtreTri) {
    case 'prix_asc':
        usort($produits, function($a, $b) {
            $prixA = $a['prix_promo'] ?? $a['prix'];
            $prixB = $b['prix_promo'] ?? $b['prix'];
            return $prixA <=> $prixB;
        });
        break;
    case 'prix_desc':
        usort($produits, function($a, $b) {
            $prixA = $a['prix_promo'] ?? $a['prix'];
            $prixB = $b['prix_promo'] ?? $b['prix'];
            return $prixB <=> $prixA;
        });
        break;
    case 'nom':
        usort($produits, function($a, $b) {
            return strcmp($a['nom'], $b['nom']);
        });
        break;
    default: // populaire
        usort($produits, function($a, $b) {
            return $b['popularite'] <=> $a['popularite'];
        });
        break;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Client - Déco Élégance</title>
    <link rel="stylesheet" href="css/style1.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo"><a href="Pageaccueil.php">Déco Élégance</a></div>
            <nav class="nav">
                <ul class="nav-links">
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

    <main>
        <section class="welcome-section">
            <div class="container">
                <h1>Bienvenue dans votre espace Déco Élégance</h1>
                <p>Découvrez notre collection exclusive d'articles de décoration</p>
            </div>
        </section>

        <section class="filters-section">
            <div class="container">
                <form method="GET" class="filters">
                    <div class="filter-group">
                        <label for="categorie">Catégorie :</label>
                        <select name="categorie" id="categorie" onchange="this.form.submit()">
                            <option value="0">Toutes les catégories</option>
                            <?php foreach ($categories as $categorie): ?>
                                <option value="<?php echo $categorie['id']; ?>" 
                                        <?php echo $filtreCategorie == $categorie['id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($categorie['nom']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="tri">Trier par :</label>
                        <select name="tri" id="tri" onchange="this.form.submit()">
                            <option value="populaire" <?php echo $filtreTri == 'populaire' ? 'selected' : ''; ?>>Popularité</option>
                            <option value="prix_asc" <?php echo $filtreTri == 'prix_asc' ? 'selected' : ''; ?>>Prix croissant</option>
                            <option value="prix_desc" <?php echo $filtreTri == 'prix_desc' ? 'selected' : ''; ?>>Prix décroissant</option>
                            <option value="nom" <?php echo $filtreTri == 'nom' ? 'selected' : ''; ?>>Nom A-Z</option>
                        </select>
                    </div>
                </form>
            </div>
        </section>

        <section class="products-section">
            <div class="container">
                <div class="products-grid">
                    <?php if (!empty($produits)): ?>
                        <?php foreach ($produits as $produit): ?>
                            <div class="product-card" onclick="window.location.href='detailProduit.php?id=<?php echo $produit['id']; ?>'">
                                <?php if ($produit['prix_promo']): ?>
                                    <?php 
                                    $reduction = round((($produit['prix'] - $produit['prix_promo']) / $produit['prix']) * 100);
                                    ?>
                                    <div class="promo-badge">-<?php echo $reduction; ?>%</div>
                                <?php endif; ?>
                                
                                <img src="images/<?php echo htmlspecialchars($produit['image_principale']); ?>" 
                                     alt="<?php echo htmlspecialchars($produit['nom']); ?>" 
                                     class="product-image">
                                
                                <div class="product-info">
                                    <h3 class="product-name"><?php echo htmlspecialchars($produit['nom']); ?></h3>
                                    <p class="product-description"><?php echo htmlspecialchars($produit['description']); ?></p>
                                    
                                    <div class="stock-info">
                                        <?php if ($produit['stock'] > 10): ?>
                                            En stock (<?php echo $produit['stock']; ?> disponibles)
                                        <?php elseif ($produit['stock'] > 0): ?>
                                            <span class="stock-low">Stock limité (<?php echo $produit['stock']; ?> restants)</span>
                                        <?php else: ?>
                                            <span class="stock-low">Rupture de stock</span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="product-price">
                                        <span class="price-current">
                                            <?php echo number_format($produit['prix_promo'] ?? $produit['prix'], 2); ?> FCFA
                                        </span>
                                        <?php if ($produit['prix_promo']): ?>
                                            <span class="price-original"><?php echo number_format($produit['prix'], 2); ?>FCFA</span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="product-actions" onclick="event.stopPropagation()">
                                        <?php if ($produit['stock'] > 0): ?>
                                            <?php if (in_array($produit['id'], $produitsPanier)): ?>
                                                <form method="POST" style="flex: 1;">
                                                    <input type="hidden" name="action" value="supprimer_panier">
                                                    <input type="hidden" name="produit_id" value="<?php echo $produit['id']; ?>">
                                                    <button type="submit" class="btn btn-danger">Retirer du panier</button>
                                                </form>
                                            <?php else: ?>
                                                <form method="POST" style="flex: 1;">
                                                    <input type="hidden" name="action" value="ajouter_panier">
                                                    <input type="hidden" name="produit_id" value="<?php echo $produit['id']; ?>">
                                                    <button type="submit" class="btn btn-primary">Ajouter au panier</button>
                                                </form>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <button class="btn btn-secondary" disabled>Indisponible</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
                            <h3>Aucun produit trouvé</h3>
                            <p>Essayez de modifier vos filtres ou revenez plus tard.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Déco Élégance. Tous droits réservés.</p>
        </div>
    </footer>

    <script>
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