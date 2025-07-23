<?php
require_once '../Backend/fonction.php';

// Vérifier si le client est connecté
if (!estConnecte()) {
    header('Location: mon-compte.php');
    exit();
}

// Traitement de la modification du profil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier_profil'])) {
    $result = modifierProfilClient(
        $_SESSION['client_id'],
        $_POST['nom_complet'] ?? '',
        $_POST['telephone'] ?? '',
        $_POST['adresse'] ?? '',
        $_POST['mot_de_passe_actuel'] ?? '',
        $_POST['nouveau_mot_de_passe'] ?? '',
        $_POST['confirmer_mot_de_passe'] ?? ''
    );
    
    if ($result['success']) {
        // Mettre à jour les informations de session
        $_SESSION['client_nom'] = $_POST['nom_complet'];
        $_SESSION['client_telephone'] = $_POST['telephone'];
        $_SESSION['client_adresse'] = $_POST['adresse'];
        
        $_SESSION['message'] = $result['message'];
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = $result['message'];
        $_SESSION['message_type'] = 'error';
    }
    
    header('Location: profil.php');
    exit();
}

// Récupérer les informations détaillées du client
$infos_client = obtenirInfosClient($_SESSION['client_id']);
$historique_commandes = obtenirHistoriqueCommandes($_SESSION['client_id']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - DécoÉlégance</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
        }
        
        .profile-sidebar {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            height: fit-content;
        }
        
        .profile-main {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .profile-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .profile-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #d4af37 0%, #f4e4bc 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin: 0 auto 15px;
        }
        
        .profile-nav {
            list-style: none;
            padding: 0;
        }
        
        .profile-nav li {
            margin-bottom: 10px;
        }
        
        .profile-nav a {
            display: block;
            padding: 12px 15px;
            color: #666;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .profile-nav a:hover,
        .profile-nav a.active {
            background: #667eea;
            color: white;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .info-item {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        
        .info-label {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        
        .info-value {
            color: #666;
        }
        
        .edit-form {
            display: none;
        }
        
        .edit-form.active {
            display: block;
        }
        
        .history-item {
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        
        .history-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .order-status {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        
        .status-nouveau { background: #e3f2fd; color: #1976d2; }
        .status-en-cours { background: #fff3e0; color: #f57c00; }
        .status-termine { background: #e8f5e8; color: #388e3c; }
        .status-annule { background: #ffebee; color: #d32f2f; }
        
        .message-item {
            padding: 15px;
            border-left: 4px solid #667eea;
            background: #f8f9fa;
            margin-bottom: 15px;
            border-radius: 0 5px 5px 0;
        }
        
        .btn-edit {
            background: #17a2b8;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }
        
        .btn-cancel {
            background: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        @media (max-width: 768px) {
            .profile-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
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
                    <li><a href="services.php">Services</a></li>
                    <li><a href="realisation.php">Réalisations</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="about.php">À propos</a></li>
                    <li><a href="profil.php"  style="color:  #ff8c00;">Profil</a></li>
                    <li><a href="panier.php">Panier</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
            <div class="contact-header">
                <span style="color: #333;">Bonjour <?php echo htmlspecialchars($_SESSION['client_nom']); ?></span>
            </div>
        </div>
    </header>

    <div class="profile-container">
        <!-- Sidebar -->
        <div class="profile-sidebar">
            <div class="profile-header">
                <div class="profile-avatar">
                    <?php echo strtoupper(substr($_SESSION['client_nom'], 0, 2)); ?>
                </div>
                <h3><?php echo htmlspecialchars($_SESSION['client_nom']); ?></h3>
                <p style="color: #666; font-size: 0.9rem;">
                    Membre depuis <?php echo date('M Y', strtotime($infos_client['date_inscription'] ?? 'now')); ?>
                </p>
            </div>
            
            <ul class="profile-nav">
                <li><a href="#" onclick="showTab('infos')" class="active">Mes Informations</a></li>
                <li><a href="#" onclick="showTab('commandes')">Historique Commandes</a></li>
                <li><a href="#" onclick="showTab('securite')">Sécurité</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="profile-main">
            <?php afficherMessage(); ?>
            
            <!-- Onglet Informations -->
            <div id="infos" class="tab-content active">
                <h2>Mes Informations Personnelles</h2>
                
                <div id="info-display">
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Nom complet</div>
                            <div class="info-value"><?php echo htmlspecialchars($infos_client['nom_complet'] ?? ''); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Email</div>
                            <div class="info-value"><?php echo htmlspecialchars($infos_client['email'] ?? ''); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Téléphone</div>
                            <div class="info-value"><?php echo htmlspecialchars($infos_client['telephone'] ?? ''); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Adresse</div>
                            <div class="info-value"><?php echo htmlspecialchars($infos_client['adresse'] ?? 'Non renseignée'); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Date d'inscription</div>
                            <div class="info-value"><?php echo date('d/m/Y', strtotime($infos_client['date_inscription'] ?? 'now')); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Dernière connexion</div>
                            <div class="info-value"><?php echo $infos_client['derniere_connexion'] ? date('d/m/Y H:i', strtotime($infos_client['derniere_connexion'])) : 'Première connexion'; ?></div>
                        </div>
                    </div>
                    
                    <button class="btn-edit" onclick="toggleEdit()">Modifier mes informations</button>
                </div>
                
                <form id="edit-form" class="edit-form" method="POST" action="">
                    <div class="info-grid">
                        <div class="form-group">
                            <label for="nom_complet">Nom complet *</label>
                            <input type="text" id="nom_complet" name="nom_complet" 
                                   value="<?php echo htmlspecialchars($infos_client['nom_complet'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email_display">Email (non modifiable)</label>
                            <input type="email" id="email_display" 
                                   value="<?php echo htmlspecialchars($infos_client['email'] ?? ''); ?>" 
                                   readonly style="background-color: #f5f5f5;">
                        </div>
                        <div class="form-group">
                            <label for="telephone">Téléphone *</label>
                            <input type="tel" id="telephone" name="telephone" 
                                   value="<?php echo htmlspecialchars($infos_client['telephone'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input type="text" id="adresse" name="adresse" 
                                   value="<?php echo htmlspecialchars($infos_client['adresse'] ?? ''); ?>">
                        </div>
                    </div>
                    
                    <div style="margin-top: 20px;">
                        <button type="submit" name="modifier_profil" class="btn">Enregistrer les modifications</button>
                        <button type="button" class="btn-cancel" onclick="toggleEdit()">Annuler</button>
                    </div>
                </form>
            </div>
            
            <!-- Onglet Commandes -->
            <div id="commandes" class="tab-content">
                <h2>Historique de mes Commandes</h2>
                
                <?php if (empty($historique_commandes)): ?>
                    <div style="text-align: center; padding: 40px;">
                        <p style="color: #666; font-size: 1.1rem;">Vous n'avez pas encore passé de commande.</p>
                        <a href="accueilClient.php" class="btn" style="margin-top: 15px;">Découvrir nos produits</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($historique_commandes as $commande): ?>
                        <div class="history-item">
                            <div class="history-header">
                                <div>
                                    <strong>Commande #<?php echo $commande['id']; ?></strong>
                                    <span style="color: #666; margin-left: 15px;">
                                        <?php echo date('d/m/Y H:i', strtotime($commande['date_commande'])); ?>
                                    </span>
                                </div>
                                <span class="order-status status-<?php echo $commande['statut']; ?>">
                                    <?php 
                                    $statuts = [
                                        'nouveau' => 'Nouvelle',
                                        'en-cours' => 'En cours',
                                        'termine' => 'Terminée',
                                        'annule' => 'Annulée'
                                    ];
                                    echo $statuts[$commande['statut']] ?? $commande['statut'];
                                    ?>
                                </span>
                            </div>
                            <p><strong>Service:</strong> <?php echo htmlspecialchars($commande['service']); ?></p>
                            <p><strong>Montant:</strong> <?php echo number_format($commande['montant'], 0, ',', ' '); ?> CFA</p>
                            <?php if (!empty($commande['description'])): ?>
                                <p><strong>Description:</strong> <?php echo htmlspecialchars($commande['description']); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <!-- Onglet Messages -->
            <div id="messages" class="tab-content">
                <h2>Mes Messages de Contact</h2>
                
                <?php if (empty($messages_contact)): ?>
                    <div style="text-align: center; padding: 40px;">
                        <p style="color: #666; font-size: 1.1rem;">Vous n'avez pas encore envoyé de message.</p>
                        <a href="contact.php" class="btn" style="margin-top: 15px;">Nous contacter</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($messages_contact as $message): ?>
                        <div class="message-item">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <strong>Service: <?php echo htmlspecialchars($message['service']); ?></strong>
                                <small style="color: #666;">
                                    <?php echo date('d/m/Y H:i', strtotime($message['date_contact'])); ?>
                                </small>
                            </div>
                            <p><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
                            <span class="order-status status-<?php echo $message['statut']; ?>">
                                <?php 
                                $statuts = [
                                    'nouveau' => 'Nouveau',
                                    'lu' => 'Lu',
                                    'traite' => 'Traité'
                                ];
                                echo $statuts[$message['statut']] ?? $message['statut'];
                                ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <!-- Onglet Sécurité -->
            <div id="securite" class="tab-content">
                <h2>Sécurité du Compte</h2>
                
                <form method="POST" action="">
                    <h3>Changer le mot de passe</h3>
                    <div class="form-group">
                        <label for="mot_de_passe_actuel">Mot de passe actuel *</label>
                        <input type="password" id="mot_de_passe_actuel" name="mot_de_passe_actuel" required>
                    </div>
                    <div class="form-group">
                        <label for="nouveau_mot_de_passe">Nouveau mot de passe *</label>
                        <input type="password" id="nouveau_mot_de_passe" name="nouveau_mot_de_passe" required>
                        <small>Le mot de passe doit contenir au moins 6 caractères.</small>
                    </div>
                    <div class="form-group">
                        <label for="confirmer_mot_de_passe">Confirmer le nouveau mot de passe *</label>
                        <input type="password" id="confirmer_mot_de_passe" name="confirmer_mot_de_passe" required>
                    </div>
                    
                    <button type="submit" name="modifier_profil" class="btn">Changer le mot de passe</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-bottom">
                <p>&copy; 2024 DécoÉlégance. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        function showTab(tabName) {
            // Masquer tous les contenus
            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(content => content.classList.remove('active'));
            
            // Retirer la classe active de tous les liens
            const links = document.querySelectorAll('.profile-nav a');
            links.forEach(link => link.classList.remove('active'));
            
            // Afficher le contenu sélectionné
            document.getElementById(tabName).classList.add('active');
            
            // Ajouter la classe active au lien cliqué
            event.target.classList.add('active');
        }
        
        function toggleEdit() {
            const displayDiv = document.getElementById('info-display');
            const editForm = document.getElementById('edit-form');
            
            if (editForm.classList.contains('active')) {
                editForm.classList.remove('active');
                displayDiv.style.display = 'block';
            } else {
                editForm.classList.add('active');
                displayDiv.style.display = 'none';
            }
        }
    </script>
</body>
</html>