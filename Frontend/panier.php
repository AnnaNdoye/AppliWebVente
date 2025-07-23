<?php
require_once '../Backend/fonction.php';

// Vérifier si le client est connecté
if (!estConnecte()) {
    header('Location: connexion.php');
    exit();
}

$client_id = $_SESSION['client_id'];
$message = '';
$message_type = '';

// Traitement des actions du panier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'update_quantity':
                $produit_id = intval($_POST['produit_id']);
                $quantite = intval($_POST['quantite']);
                
                // Vérifier la disponibilité du stock
                $produit = obtenirProduitParId($produit_id);
                if ($produit && $quantite > $produit['stock']) {
                    $message = 'Quantité demandée supérieure au stock disponible (' . $produit['stock'] . ').';
                    $message_type = 'error';
                } else {
                    if (modifierQuantitePanier($client_id, $produit_id, $quantite)) {
                        $message = 'Quantité mise à jour avec succès.';
                        $message_type = 'success';
                    } else {
                        $message = 'Erreur lors de la mise à jour.';
                        $message_type = 'error';
                    }
                }
                break;
                
            case 'remove_item':
                $produit_id = intval($_POST['produit_id']);
                if (supprimerDuPanier($client_id, $produit_id)) {
                    $message = 'Produit supprimé du panier.';
                    $message_type = 'success';
                } else {
                    $message = 'Erreur lors de la suppression.';
                    $message_type = 'error';
                }
                break;
                
            case 'validate_order':
                $adresse = trim($_POST['adresse_livraison']);
                $details = trim($_POST['details_livraison']);
                $mode_paiement = $_POST['mode_paiement'];
                
                if (empty($adresse)) {
                    $message = 'Veuillez renseigner une adresse de livraison.';
                    $message_type = 'error';
                } else {
                    $result = creerCommande($client_id, $adresse, $mode_paiement, $details);
                    if ($result['success']) {
                        $message = 'Commande validée avec succès ! Numéro: ' . $result['numero_commande'];
                        $message_type = 'success';
                        // Redirection vers une page de confirmation
                        header('Location: confirmation.php?commande=' . $result['numero_commande']);
                        exit();
                    } else {
                        $message = $result['message'];
                        $message_type = 'error';
                    }
                }
                break;
        }
    }
}

// Récupérer le contenu du panier
$panier_items = obtenirPanier($client_id);
$total_panier = calculerTotalPanier($client_id);
$frais_livraison = 2000; // 2000 FCFA
$total_final = $total_panier + $frais_livraison;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Panier - Déco Élégance</title>
    <link rel="stylesheet" href="css/panier.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo"><a href="accueilClient.php">Déco Élégance</a></div>
            <ul class="main-menu">
                    <li><a href="accueilClient.php">Accueil</a></li>
                    <li><a href="produit.php">Produits</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="realisation.php">Réalisations</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="about.php">À propos</a></li>
                    <li><a href="panier.php"  style="color:  #ff8c00;">Panier</a></li>
                    <li><a href="contact.php">Contact</a></li>
            </ul>
            <div class="user-actions">
                <a href="profil.php" class="icon-link">Mon compte</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="page-header">
            <h1>Votre Panier</h1>
        </section>

        <?php if ($message): ?>
            <div class="message <?php echo $message_type; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (empty($panier_items)): ?>
            <div class="empty-cart">
                <h3>Votre panier est vide</h3>
                <p>Découvrez nos magnifiques produits de décoration</p>
                <a href="produit.php" class="continue-shopping">Continuer vos achats</a>
            </div>
        <?php else: ?>
            <div class="cart-container">
                <div class="cart-items">
                    <h2 style="color: #ff8c00; margin-bottom: 1.5rem;">Produits dans votre panier</h2>
                    
                    <?php foreach ($panier_items as $item): ?>
                        <div class="cart-item" data-product-id="<?php echo $item['produit_id']; ?>">
                            <img src="images/<?php echo htmlspecialchars($item['image_principale']); ?>" 
                                 alt="<?php echo htmlspecialchars($item['nom']); ?>">
                            
                            <div class="item-details">
                                <h3><?php echo htmlspecialchars($item['nom']); ?></h3>
                                <div class="item-price"><?php echo number_format($item['prix_unitaire'], 0, ',', ' '); ?> FCFA</div>
                                <div class="stock-info" style="color: #666; font-size: 0.9rem; margin-bottom: 1rem;">
                                    Stock disponible: <?php echo $item['stock']; ?>
                                </div>
                                
                                <div class="quantity-controls">
                                    <div class="quantity-input">
                                        <button type="button" class="quantity-btn" onclick="changeQuantity(<?php echo $item['produit_id']; ?>, -1, <?php echo $item['stock']; ?>)">-</button>
                                        <input type="number" 
                                               id="qty_<?php echo $item['produit_id']; ?>" 
                                               value="<?php echo $item['quantite']; ?>" 
                                               min="1" 
                                               max="<?php echo $item['stock']; ?>"
                                               data-original="<?php echo $item['quantite']; ?>"
                                               onchange="updateQuantity(<?php echo $item['produit_id']; ?>, <?php echo $item['stock']; ?>)">
                                        <button type="button" class="quantity-btn" onclick="changeQuantity(<?php echo $item['produit_id']; ?>, 1, <?php echo $item['stock']; ?>)">+</button>
                                    </div>
                                    
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="action" value="remove_item">
                                        <input type="hidden" name="produit_id" value="<?php echo $item['produit_id']; ?>">
                                        <button type="submit" class="remove-btn" onclick="return confirm('Supprimer ce produit du panier ?')">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="item-total">
                                <div class="item-total-price" id="total_<?php echo $item['produit_id']; ?>">
                                    <?php echo number_format($item['quantite'] * $item['prix_unitaire'], 0, ',', ' '); ?> FCFA
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="order-summary">
                    <h2>Résumé de la commande</h2>
                    
                    <div class="summary-row">
                        <span>Sous-total :</span>
                        <span id="subtotal"><?php echo number_format($total_panier, 0, ',', ' '); ?> FCFA</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Frais de livraison :</span>
                        <span><?php echo number_format($frais_livraison, 0, ',', ' '); ?> FCFA</span>
                    </div>
                    
                    <div class="summary-row total">
                        <span>Total à payer :</span>
                        <span id="total-final"><?php echo number_format($total_final, 0, ',', ' '); ?> FCFA</span>
                    </div>

                    <form method="POST" id="orderForm">
                        <input type="hidden" name="action" value="validate_order">
                        
                        <div class="delivery-section">
                            <h3 class="section-title">📍 Informations de livraison</h3>
                            
                            <div class="form-group">
                                <label for="adresse_livraison">Adresse de livraison *</label>
                                <textarea id="adresse_livraison" name="adresse_livraison" rows="3" 
                                          placeholder="Saisissez votre adresse complète de livraison..." required></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="details_livraison">Détails supplémentaires (optionnel)</label>
                                <textarea id="details_livraison" name="details_livraison" rows="2" 
                                          placeholder="Instructions spéciales, points de repère, heures de disponibilité..."></textarea>
                            </div>
                        </div>

                        <div class="payment-section">
                            <h3 class="section-title">💳 Mode de paiement</h3>
                            
                            <div class="payment-options">
                                <label class="payment-option" for="paiement_livraison">
                                    <input type="radio" id="paiement_livraison" name="mode_paiement" value="livraison" checked>
                                    <span class="payment-icon">🚚</span>
                                    <strong>Paiement à la livraison</strong>
                                    <small>Payez en espèces lors de la réception</small>
                                </label>
                                
                                <label class="payment-option" for="paiement_mobile">
                                    <input type="radio" id="paiement_mobile" name="mode_paiement" value="mobile">
                                    <span class="payment-icon">📱</span>
                                    <strong>Mobile Money</strong>
                                    <small>Orange Money, Wave, Free Money</small>
                                </label>
                                
                                <label class="payment-option" for="paiement_virement">
                                    <input type="radio" id="paiement_virement" name="mode_paiement" value="virement">
                                    <span class="payment-icon">🏦</span>
                                    <strong>Virement bancaire</strong>
                                    <small>Transfert sur compte bancaire</small>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="validate-btn" id="submitBtn">
                            🛒 Valider ma commande - <span id="btn-total"><?php echo number_format($total_final, 0, ',', ' '); ?></span> FCFA
                        </button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 Déco Élégance. Tous droits réservés.</p>
    </footer>

    <script>
        // Variables globales
        const fraisLivraison = <?php echo $frais_livraison; ?>;
        let isUpdating = false;

        // Fonction pour changer la quantité avec les boutons + et -
        function changeQuantity(produitId, delta, stock) {
            if (isUpdating) return;
            
            const input = document.getElementById('qty_' + produitId);
            let currentValue = parseInt(input.value);
            let newValue = currentValue + delta;
            
            // Vérifier les limites
            if (newValue < 1) newValue = 1;
            if (newValue > stock) {
                alert(`Stock maximum disponible: ${stock}`);
                return;
            }
            
            input.value = newValue;
            updateQuantity(produitId, stock);
        }

        // Fonction pour mettre à jour la quantité
        function updateQuantity(produitId, stock) {
            if (isUpdating) return;
            
            const input = document.getElementById('qty_' + produitId);
            const newQuantity = parseInt(input.value);
            const originalQuantity = parseInt(input.dataset.original);
            
            // Validation
            if (newQuantity < 1) {
                if (confirm('Voulez-vous supprimer ce produit du panier ?')) {
                    removeItem(produitId);
                } else {
                    input.value = originalQuantity;
                }
                return;
            }
            
            if (newQuantity > stock) {
                alert(`Stock maximum disponible: ${stock}`);
                input.value = Math.min(originalQuantity, stock);
                return;
            }
            
            // Si la quantité n'a pas changé, ne rien faire
            if (newQuantity === originalQuantity) return;
            
            // Marquer comme en cours de mise à jour
            isUpdating = true;
            const cartItem = document.querySelector(`[data-product-id="${produitId}"]`);
            cartItem.classList.add('loading');
            
            // Créer et soumettre le formulaire
            const form = document.createElement('form');
            form.method = 'POST';
            form.style.display = 'none';
            
            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = 'update_quantity';
            
            const produitInput = document.createElement('input');
            produitInput.type = 'hidden';
            produitInput.name = 'produit_id';
            produitInput.value = produitId;
            
            const quantiteInput = document.createElement('input');
            quantiteInput.type = 'hidden';
            quantiteInput.name = 'quantite';
            quantiteInput.value = newQuantity;
            
            form.appendChild(actionInput);
            form.appendChild(produitInput);
            form.appendChild(quantiteInput);
            
            document.body.appendChild(form);
            form.submit();
        }

        // Fonction pour supprimer un item
        function removeItem(produitId) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.style.display = 'none';
            
            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = 'remove_item';
            
            const produitInput = document.createElement('input');
            produitInput.type = 'hidden';
            produitInput.name = 'produit_id';
            produitInput.value = produitId;
            
            form.appendChild(actionInput);
            form.appendChild(produitInput);
            
            document.body.appendChild(form);
            form.submit();
        }

        // Gestion des options de paiement
        document.addEventListener('DOMContentLoaded', function() {
            const paymentOptions = document.querySelectorAll('.payment-option');
            
            // Ajouter les événements de clic sur les labels
            paymentOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Retirer la classe selected de toutes les options
                    paymentOptions.forEach(opt => opt.classList.remove('selected'));
                    
                    // Ajouter la classe selected à l'option cliquée
                    this.classList.add('selected');
                    
                    // Cocher le radio button correspondant
                    const radio = this.querySelector('input[type="radio"]');
                    if (radio) {
                        radio.checked = true;
                    }
                });
            });
            
            // Marquer l'option par défaut comme sélectionnée
            const defaultOption = document.querySelector('input[name="mode_paiement"]:checked');
            if (defaultOption) {
                defaultOption.closest('.payment-option').classList.add('selected');
            }
            
            // Validation du formulaire avant soumission
            document.getElementById('orderForm').addEventListener('submit', function(e) {
                const adresse = document.getElementById('adresse_livraison').value.trim();
                
                if (!adresse) {
                    e.preventDefault();
                    alert('Veuillez renseigner une adresse de livraison.');
                    document.getElementById('adresse_livraison').focus();
                    return false;
                }
                
                // Confirmation de la commande
                const total = document.getElementById('total-final').textContent;
                const modePaiement = document.querySelector('input[name="mode_paiement"]:checked').nextElementSibling.querySelector('strong').textContent;
                
                const confirmation = confirm(
                    `Confirmer votre commande ?\n\n` +
                    `Total : ${total}\n` +
                    `Mode de paiement : ${modePaiement}\n` +
                    `Adresse : ${adresse.substring(0, 50)}${adresse.length > 50 ? '...' : ''}`
                );
                
                if (!confirmation) {
                    e.preventDefault();
                    return false;
                }
                
                // Désactiver le bouton pour éviter les doubles soumissions
                const submitBtn = document.getElementById('submitBtn');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '⏳ Traitement en cours...';
            });
        });

        // Animation au survol des produits du panier
        document.querySelectorAll('.cart-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                if (!this.classList.contains('loading')) {
                    this.style.transform = 'translateY(-2px)';
                    this.style.boxShadow = '0 4px 12px rgba(255, 140, 0, 0.15)';
                    this.style.transition = 'all 0.3s ease';
                }
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
            });
        });

        // Fonction pour mettre à jour les totaux en temps réel (pour futures améliorations AJAX)
        function updateCartTotals() {
            let sousTotal = 0;
            const items = document.querySelectorAll('.cart-item');
            
            items.forEach(item => {
                const quantite = parseInt(item.querySelector('input[type="number"]').value);
                const prixText = item.querySelector('.item-price').textContent;
                const prixUnitaire = parseFloat(prixText.replace(/[^\d]/g, ''));
                const totalItem = quantite * prixUnitaire;
                
                // Mettre à jour le total de l'item
                const totalElement = item.querySelector('.item-total-price');
                totalElement.textContent = new Intl.NumberFormat('fr-FR').format(totalItem) + ' FCFA';
                
                sousTotal += totalItem;
            });
            
            // Mettre à jour le résumé de commande
            const totalFinal = sousTotal + fraisLivraison;
            
            document.getElementById('subtotal').textContent = new Intl.NumberFormat('fr-FR').format(sousTotal) + ' FCFA';
            document.getElementById('total-final').textContent = new Intl.NumberFormat('fr-FR').format(totalFinal) + ' FCFA';
            document.getElementById('btn-total').textContent = new Intl.NumberFormat('fr-FR').format(totalFinal);
        }

        // Effet de chargement pour les actions
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn && !submitBtn.disabled && submitBtn.id !== 'submitBtn') {
                    submitBtn.style.opacity = '0.7';
                    submitBtn.style.cursor = 'wait';
                    submitBtn.disabled = true;
                }
            });
        });

        // Validation en temps réel des champs
        document.getElementById('adresse_livraison').addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.style.borderColor = '#dc3545';
            } else {
                this.style.borderColor = '#28a745';
            }
        });

        document.getElementById('adresse_livraison').addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.style.borderColor = '#ddd';
            }
        });

        // Gestion des erreurs de validation côté client
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function() {
                const max = parseInt(this.max);
                const min = parseInt(this.min);
                let value = parseInt(this.value);
                
                if (value > max) {
                    this.style.borderColor = '#dc3545';
                    this.title = `Maximum: ${max}`;
                } else if (value < min) {
                    this.style.borderColor = '#dc3545';
                    this.title = `Minimum: ${min}`;
                } else {
                    this.style.borderColor = '#ddd';
                    this.title = '';
                }
            });
        });

        // Auto-save pour éviter la perte de données
        let addressTimer;
        document.getElementById('adresse_livraison').addEventListener('input', function() {
            clearTimeout(addressTimer);
            addressTimer = setTimeout(() => {
                localStorage.setItem('temp_address', this.value);
            }, 1000);
        });

        document.getElementById('details_livraison').addEventListener('input', function() {
            clearTimeout(addressTimer);
            addressTimer = setTimeout(() => {
                localStorage.setItem('temp_details', this.value);
            }, 1000);
        });

        // Restaurer les données sauvegardées
        window.addEventListener('load', function() {
            const savedAddress = localStorage.getItem('temp_address');
            const savedDetails = localStorage.getItem('temp_details');
            
            if (savedAddress) {
                document.getElementById('adresse_livraison').value = savedAddress;
            }
            
            if (savedDetails) {
                document.getElementById('details_livraison').value = savedDetails;
            }
        });

        // Nettoyer les données temporaires après validation
        document.getElementById('orderForm').addEventListener('submit', function() {
            localStorage.removeItem('temp_address');
            localStorage.removeItem('temp_details');
        });
    </script>
</body>
</html>