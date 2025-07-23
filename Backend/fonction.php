<?php
session_start();

// Configuration de la base de données
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'deco_elegance';

// Fonction de connexion à la base de données
function connectDB() {
    global $host, $username, $password, $database;
    
    $conn = new mysqli($host, $username, $password, $database);
    
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }
    
    $conn->set_charset("utf8");
    return $conn;
}

// Fonction d'inscription
function inscription($nom_complet, $email, $telephone, $mot_de_passe, $adresse = '') {
    $conn = connectDB();
    
    // Validation des données
    if (empty($nom_complet) || empty($email) || empty($mot_de_passe) || empty($telephone)) {
        $conn->close();
        return ['success' => false, 'message' => 'Veuillez remplir tous les champs obligatoires.'];
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $conn->close();
        return ['success' => false, 'message' => 'Adresse email invalide.'];
    }
    
    // Vérifier si l'email existe déjà
    $sql_check = "SELECT id FROM clients WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    
    if ($stmt_check) {
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $result = $stmt_check->get_result();
        
        if ($result->num_rows > 0) {
            $stmt_check->close();
            $conn->close();
            return ['success' => false, 'message' => 'Cette adresse email est déjà utilisée.'];
        }
        $stmt_check->close();
    }
    
    // Hachage du mot de passe
    $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    
    // Insertion du nouveau client avec l'adresse
    $sql = "INSERT INTO clients (nom_complet, email, telephone, mot_de_passe, adresse) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("sssss", $nom_complet, $email, $telephone, $mot_de_passe_hash, $adresse);
        
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return ['success' => true, 'message' => 'Inscription réussie ! Vous pouvez maintenant vous connecter.'];
        } else {
            $stmt->close();
            $conn->close();
            return ['success' => false, 'message' => 'Erreur lors de l\'inscription. Veuillez réessayer.'];
        }
    } else {
        $conn->close();
        return ['success' => false, 'message' => 'Erreur de préparation de la requête.'];
    }
}

// Fonction de connexion
function connexion($email, $mot_de_passe) {
    $conn = connectDB();
    
    // Validation des données
    if (empty($email) || empty($mot_de_passe)) {
        $conn->close();
        return ['success' => false, 'message' => 'Veuillez remplir tous les champs.'];
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $conn->close();
        return ['success' => false, 'message' => 'Adresse email invalide.'];
    }
    
    // Recherche du client
    $sql = "SELECT id, nom_complet, email, telephone, mot_de_passe, adresse, statut FROM clients WHERE email = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $client = $result->fetch_assoc();
            
            // Vérifier le statut du compte
            if ($client['statut'] !== 'actif') {
                $stmt->close();
                $conn->close();
                return ['success' => false, 'message' => 'Votre compte est inactif ou suspendu.'];
            }
            
            // Vérifier le mot de passe
            if (password_verify($mot_de_passe, $client['mot_de_passe'])) {
                // Mettre à jour la dernière connexion
                $sql_update = "UPDATE clients SET derniere_connexion = CURRENT_TIMESTAMP WHERE id = ?";
                $stmt_update = $conn->prepare($sql_update);
                if ($stmt_update) {
                    $stmt_update->bind_param("i", $client['id']);
                    $stmt_update->execute();
                    $stmt_update->close();
                }
                
                // Créer la session avec toutes les informations y compris l'adresse
                $_SESSION['client_id'] = $client['id'];
                $_SESSION['client_nom'] = $client['nom_complet'];
                $_SESSION['client_email'] = $client['email'];
                $_SESSION['client_telephone'] = $client['telephone'];
                $_SESSION['client_adresse'] = $client['adresse'];
                $_SESSION['client_connecte'] = true;
                
                $stmt->close();
                $conn->close();
                return ['success' => true, 'message' => 'Connexion réussie !', 'redirect' => 'accueilClient.php'];
            } else {
                $stmt->close();
                $conn->close();
                return ['success' => false, 'message' => 'Email ou mot de passe incorrect.'];
            }
        } else {
            $stmt->close();
            $conn->close();
            return ['success' => false, 'message' => 'Email ou mot de passe incorrect.'];
        }
    } else {
        $conn->close();
        return ['success' => false, 'message' => 'Erreur de préparation de la requête.'];
    }
}

// Fonction de déconnexion
function deconnexion() {
    session_unset();
    session_destroy();
    return ['success' => true, 'message' => 'Déconnexion réussie.'];
}

// Fonction pour vérifier si un client est connecté
function estConnecte() {
    return isset($_SESSION['client_connecte']) && $_SESSION['client_connecte'] === true;
}

// Fonction pour obtenir tous les produits
function obtenirProduits() {
    $conn = connectDB();
    $produits = [];
    
    $sql = "SELECT p.*, c.nom as categorie_nom 
            FROM produits p 
            LEFT JOIN categories c ON p.categorie_id = c.id 
            WHERE p.statut = 'actif' 
            ORDER BY p.popularite DESC";
    
    $result = $conn->query($sql);
    
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $produits[] = $row;
        }
    }
    
    $conn->close();
    return $produits;
}

// Fonction pour obtenir toutes les catégories
function obtenirCategories() {
    $conn = connectDB();
    $categories = [];
    
    $sql = "SELECT * FROM categories WHERE statut = 'actif' ORDER BY nom";
    $result = $conn->query($sql);
    
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
    
    $conn->close();
    return $categories;
}

// Fonction pour obtenir un produit par ID
function obtenirProduitParId($id) {
    $conn = connectDB();
    
    $sql = "SELECT p.*, c.nom as categorie_nom 
            FROM produits p 
            LEFT JOIN categories c ON p.categorie_id = c.id 
            WHERE p.id = ? AND p.statut = 'actif'";
    
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $produit = $result->fetch_assoc();
            $stmt->close();
            $conn->close();
            return $produit;
        }
        $stmt->close();
    }
    
    $conn->close();
    return null;
}

// Fonction pour obtenir les images d'un produit
function obtenirImagesProduit($produit_id) {
    $conn = connectDB();
    $images = [];
    
    $sql = "SELECT * FROM produits_images WHERE produit_id = ? ORDER BY ordre";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $produit_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $images[] = $row;
        }
        $stmt->close();
    }
    
    $conn->close();
    return $images;
}

// Fonction pour obtenir les produits dans le panier d'un client
function obtenirProduitsPanier($client_id) {
    $conn = connectDB();
    $produits_panier = [];
    
    $sql = "SELECT produit_id FROM panier WHERE client_id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $client_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $produits_panier[] = $row['produit_id'];
        }
        $stmt->close();
    }
    
    $conn->close();
    return $produits_panier;
}

// Fonction pour ajouter un produit au panier
function ajouterAuPanier($client_id, $produit_id) {
    $conn = connectDB();
    
    // Vérifier que le produit existe et est disponible
    $sql_check = "SELECT prix, prix_promo, stock FROM produits WHERE id = ? AND statut = 'actif'";
    $stmt_check = $conn->prepare($sql_check);
    
    if ($stmt_check) {
        $stmt_check->bind_param("i", $produit_id);
        $stmt_check->execute();
        $result = $stmt_check->get_result();
        
        if ($result->num_rows === 1) {
            $produit = $result->fetch_assoc();
            
            if ($produit['stock'] <= 0) {
                $stmt_check->close();
                $conn->close();
                return ['success' => false, 'message' => 'Ce produit est en rupture de stock.'];
            }
            
            $prix_unitaire = $produit['prix_promo'] ?? $produit['prix'];
            
            // Ajouter au panier (ou mettre à jour si déjà présent)
            $sql = "INSERT INTO panier (client_id, produit_id, quantite, prix_unitaire) 
                    VALUES (?, ?, 1, ?) 
                    ON DUPLICATE KEY UPDATE quantite = quantite + 1";
            
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("iid", $client_id, $produit_id, $prix_unitaire);
                
                if ($stmt->execute()) {
                    $stmt->close();
                    $stmt_check->close();
                    $conn->close();
                    return ['success' => true, 'message' => 'Produit ajouté au panier avec succès.'];
                }
                $stmt->close();
            }
        }
        $stmt_check->close();
    }
    
    $conn->close();
    return ['success' => false, 'message' => 'Erreur lors de l\'ajout au panier.'];
}

// Fonction pour supprimer un produit du panier
// Fonction pour supprimer un produit du panier (CORRIGÉE)
function supprimerDuPanier($client_id, $produit_id) {
    $conn = connectDB();
    
    // Vérifier d'abord que le produit est dans le panier
    $sql_check = "SELECT id FROM panier WHERE client_id = ? AND produit_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    
    if ($stmt_check) {
        $stmt_check->bind_param("ii", $client_id, $produit_id);
        $stmt_check->execute();
        $result = $stmt_check->get_result();
        
        if ($result->num_rows === 0) {
            $stmt_check->close();
            $conn->close();
            return ['success' => false, 'message' => 'Ce produit n\'est pas dans votre panier.'];
        }
        $stmt_check->close();
    }
    
    // Supprimer le produit du panier
    $sql = "DELETE FROM panier WHERE client_id = ? AND produit_id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ii", $client_id, $produit_id);
        
        if ($stmt->execute() && $stmt->affected_rows > 0) {
            $stmt->close();
            $conn->close();
            return ['success' => true, 'message' => 'Produit supprimé de votre panier avec succès.'];
        } else {
            $stmt->close();
            $conn->close();
            return ['success' => false, 'message' => 'Erreur lors de la suppression du produit du panier.'];
        }
    }
    
    $conn->close();
    return ['success' => false, 'message' => 'Erreur de préparation de la requête.'];
}

// SECTION DE TRAITEMENT DES FORMULAIRES (CORRIGÉE)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = null;
    
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'inscription':
                $nom_complet = trim($_POST['nom_complet']);
                $email = trim($_POST['email']);
                $telephone = trim($_POST['telephone']);
                $mot_de_passe = trim($_POST['mot_de_passe']);
                $confirmer_mot_de_passe = trim($_POST['confirmer_mot_de_passe']);
                $adresse = isset($_POST['adresse']) ? trim($_POST['adresse']) : '';
                
                if ($mot_de_passe !== $confirmer_mot_de_passe) {
                    $result = ['success' => false, 'message' => 'Les mots de passe ne correspondent pas.'];
                } else {
                    $result = inscription($nom_complet, $email, $telephone, $mot_de_passe, $adresse);
                }
                break;
                
            case 'connexion':
                $email = trim($_POST['email']);
                $mot_de_passe = trim($_POST['mot_de_passe']);
                $result = connexion($email, $mot_de_passe);
                break;
                
            case 'deconnexion':
                $result = deconnexion();
                header('Location: ../Frontend/mon-compte.php');
                exit;
                break;
                
            case 'ajouter_panier':
                if (estConnecte()) {
                    $produit_id = (int)$_POST['produit_id'];
                    $result = ajouterAuPanier($_SESSION['client_id'], $produit_id);
                    
                    if ($result['success']) {
                        // Redirection avec message de succès
                        $redirect_url = $_SERVER['HTTP_REFERER'] ?? 'accueilClient.php';
                        header('Location: ' . $redirect_url . '?success=panier');
                        exit;
                    } else {
                        // En cas d'erreur, rediriger avec message d'erreur
                        $redirect_url = $_SERVER['HTTP_REFERER'] ?? 'accueilClient.php';
                        header('Location: ' . $redirect_url . '?error=panier');
                        exit;
                    }
                } else {
                    header('Location: mon-compte.php');
                    exit;
                }
                break;
                
            case 'supprimer_panier':
                if (estConnecte()) {
                    $produit_id = (int)$_POST['produit_id'];
                    $result = supprimerDuPanier($_SESSION['client_id'], $produit_id);
                    
                    if ($result['success']) {
                        // Redirection avec message de succès pour suppression
                        $redirect_url = $_SERVER['HTTP_REFERER'] ?? 'accueilClient.php';
                        header('Location: ' . $redirect_url . '?success=supprime');
                        exit;
                    } else {
                        // En cas d'erreur, rediriger avec message d'erreur
                        $redirect_url = $_SERVER['HTTP_REFERER'] ?? 'accueilClient.php';
                        header('Location: ' . $redirect_url . '?error=suppression');
                        exit;
                    }
                } else {
                    header('Location: mon-compte.php');
                    exit;
                }
                break;
                
            default:
                $result = traiterContact();
                break;
        }
    } else {
        $result = traiterContact();
    }
    
    // Réponse JSON pour AJAX
    if (isset($_POST['ajax']) && $_POST['ajax'] === '1') {
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    
    // Stockage du résultat en session pour affichage
    if ($result) {
        $_SESSION['auth_result'] = $result;
    }
    
    // Redirection après connexion réussie
    if (isset($result['redirect']) && $result['success']) {
        header('Location: ' . $result['redirect']);
        exit;
    }
    
    // Redirection pour éviter la resoumission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
function traiterContact() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conn = connectDB();
        
        // Récupération et nettoyage des données
        $prenom = mysqli_real_escape_string($conn, trim($_POST['firstname']));
        $nom = mysqli_real_escape_string($conn, trim($_POST['lastname']));
        $email = mysqli_real_escape_string($conn, trim($_POST['email']));
        $telephone = mysqli_real_escape_string($conn, trim($_POST['phone']));
        $type_service = mysqli_real_escape_string($conn, trim($_POST['service']));
        $message = mysqli_real_escape_string($conn, trim($_POST['message']));
        
        // Validation des données
        if (empty($prenom) || empty($nom) || empty($email) || empty($type_service)) {
            return ['success' => false, 'message' => 'Veuillez remplir tous les champs obligatoires.'];
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Adresse email invalide.'];
        }
        
        // Insertion en base de données
        $sql = "INSERT INTO contacts (prenom, nom, email, telephone, type_service, message) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $requete = $conn->prepare($sql);
        
        if ($requete) {
            $requete->bind_param("ssssss", $prenom, $nom, $email, $telephone, $type_service, $message);
            
            if ($requete->execute()) {
                $requete->close();
                $conn->close();
                return ['success' => true, 'message' => 'Votre message a été envoyé avec succès ! Nous vous contacterons dans les plus brefs délais.'];
            } else {
                $requete->close();
                $conn->close();
                return ['success' => false, 'message' => 'Erreur lors de l\'envoi du message. Veuillez réessayer.'];
            }
        } else {
            $conn->close();
            return ['success' => false, 'message' => 'Erreur de préparation de la requête.'];
        }
    }
    
    return ['success' => false, 'message' => 'Méthode non autorisée.'];
}

// Traitement des formulaires
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = null;
    
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'inscription':
                $nom_complet = trim($_POST['nom_complet']);
                $email = trim($_POST['email']);
                $telephone = trim($_POST['telephone']);
                $mot_de_passe = trim($_POST['mot_de_passe']);
                $confirmer_mot_de_passe = trim($_POST['confirmer_mot_de_passe']);
                $adresse = isset($_POST['adresse']) ? trim($_POST['adresse']) : '';
                
                if ($mot_de_passe !== $confirmer_mot_de_passe) {
                    $result = ['success' => false, 'message' => 'Les mots de passe ne correspondent pas.'];
                } else {
                    $result = inscription($nom_complet, $email, $telephone, $mot_de_passe, $adresse);
                }
                break;
                
            case 'connexion':
                $email = trim($_POST['email']);
                $mot_de_passe = trim($_POST['mot_de_passe']);
                $result = connexion($email, $mot_de_passe);
                break;
                
            case 'deconnexion':
                $result = deconnexion();
                header('Location: ../Frontend/mon-compte.php');
                exit;
                break;
                
            case 'ajouter_panier':
                if (estConnecte()) {
                    $produit_id = (int)$_POST['produit_id'];
                    $result = ajouterAuPanier($_SESSION['client_id'], $produit_id);
                    
                    if ($result['success']) {
                        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?success=panier');
                        exit;
                    }
                } else {
                    header('Location: mon-compte.php');
                    exit;
                }
                break;
                
            case 'supprimer_panier':
                if (estConnecte()) {
                    $produit_id = (int)$_POST['produit_id'];
                    $result = supprimerDuPanier($_SESSION['client_id'], $produit_id);
                    
                    if ($result['success']) {
                        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?success=supprime');
                        exit;
                    }
                } else {
                    header('Location: mon-compte.php');
                    exit;
                }
                break;
                
            default:
                $result = traiterContact();
                break;
        }
    } else {
        $result = traiterContact();
    }
    
    // Réponse JSON pour AJAX
    if (isset($_POST['ajax']) && $_POST['ajax'] === '1') {
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    
    // Stockage du résultat en session pour affichage
    $_SESSION['auth_result'] = $result;
    
    // Redirection après connexion réussie
    if (isset($result['redirect']) && $result['success']) {
        header('Location: ' . $result['redirect']);
        exit;
    }
    
    // Redirection pour éviter la resoumission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Traitement des actions GET (déconnexion)
if (isset($_GET['action']) && $_GET['action'] === 'deconnexion') {
    deconnexion();
    header('Location: mon-compte.php');
    exit;
}

// Fonction pour afficher les messages
function afficherMessage() {
    if (isset($_SESSION['auth_result'])) {
        $result = $_SESSION['auth_result'];
        $class = $result['success'] ? 'success' : 'error';
        echo "<div class='message {$class}'>{$result['message']}</div>";
        unset($_SESSION['auth_result']);
    }
    
    if (isset($_SESSION['contact_result'])) {
        $result = $_SESSION['contact_result'];
        $class = $result['success'] ? 'success' : 'error';
        echo "<div class='message {$class}'>{$result['message']}</div>";
        unset($_SESSION['contact_result']);
    }
}

// ==================== FONCTIONS PANIER ====================

// Fonction pour obtenir le contenu du panier d'un client
function obtenirPanier($client_id) {
    $conn = connectDB();
    $panier = [];
    
    $sql = "SELECT p.id as panier_id, p.quantite, p.prix_unitaire, p.date_ajout,
                    pr.id as produit_id, pr.nom, pr.description, pr.image_principale, pr.stock
            FROM panier p
            JOIN produits pr ON p.produit_id = pr.id
            WHERE p.client_id = ? AND pr.statut = 'actif'
            ORDER BY p.date_ajout DESC";
    
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $client_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $panier[] = $row;
        }
        $stmt->close();
    }
    
    $conn->close();
    return $panier;
}

// Fonction pour mettre à jour la quantité d'un produit dans le panier
function modifierQuantitePanier($client_id, $produit_id, $quantite) {
    $conn = connectDB();
    
    // Vérifier d'abord que le produit existe dans le panier
    $sql_check = "SELECT id FROM panier WHERE client_id = ? AND produit_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    if (!$stmt_check) {
        $conn->close();
        return false;
    }
    
    $stmt_check->bind_param("ii", $client_id, $produit_id);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    
    if ($result->num_rows === 0) {
        $stmt_check->close();
        $conn->close();
        return false;
    }
    $stmt_check->close();
    
    if ($quantite <= 0) {
        // Supprimer le produit du panier si quantité <= 0
        $sql = "DELETE FROM panier WHERE client_id = ? AND produit_id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ii", $client_id, $produit_id);
            $success = $stmt->execute();
            $stmt->close();
            $conn->close();
            return $success;
        }
    } else {
        // Mettre à jour la quantité
        $sql = "UPDATE panier SET quantite = ? WHERE client_id = ? AND produit_id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("iii", $quantite, $client_id, $produit_id);
            $success = $stmt->execute();
            $stmt->close();
            $conn->close();
            return $success;
        }
    }
    
    $conn->close();
    return false;
}

// Fonction pour vider le panier
function viderPanier($client_id) {
    $conn = connectDB();
    
    $sql = "DELETE FROM panier WHERE client_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $client_id);
        $success = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $success;
    }
    
    $conn->close();
    return false;
}

// Fonction pour calculer le total du panier
function calculerTotalPanier($client_id) {
    $conn = connectDB();
    
    $sql = "SELECT SUM(quantite * prix_unitaire) as total FROM panier WHERE client_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $client_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $total = 0;
        if ($row = $result->fetch_assoc()) {
            $total = $row['total'] ? floatval($row['total']) : 0;
        }
        
        $stmt->close();
        $conn->close();
        return $total;
    }
    
    $conn->close();
    return 0;
}

// Fonction pour créer une commande
function creerCommande($client_id, $adresse_livraison, $mode_paiement, $details_livraison = '') {
    $conn = connectDB();
    
    // Commencer une transaction
    $conn->begin_transaction();
    
    try {
        // Vérifier que le panier n'est pas vide
        $panier_items = obtenirPanier($client_id);
        if (empty($panier_items)) {
            throw new Exception('Panier vide.');
        }
        
        // Vérifier la disponibilité du stock pour tous les produits
        foreach ($panier_items as $item) {
            if ($item['quantite'] > $item['stock']) {
                throw new Exception('Stock insuffisant pour le produit: ' . $item['nom']);
            }
        }
        
        // Générer un numéro de commande unique
        do {
            $numero_commande = 'CMD-' . date('Y') . '-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $sql_check = "SELECT id FROM commandes WHERE numero_commande = ?";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->bind_param("s", $numero_commande);
            $stmt_check->execute();
            $result_check = $stmt_check->get_result();
            $existe = $result_check->num_rows > 0;
            $stmt_check->close();
        } while ($existe);
        
        // Calculer le total
        $total_panier = calculerTotalPanier($client_id);
        $frais_livraison = 2000.00;
        $total_final = $total_panier + $frais_livraison;
        
        if ($total_panier <= 0) {
            throw new Exception('Erreur de calcul du total.');
        }
        
        // Préparer l'adresse complète
        $adresse_complete = trim($adresse_livraison);
        if (!empty($details_livraison)) {
            $adresse_complete .= "\n\nDétails: " . trim($details_livraison);
        }
        
        // Créer la commande dans la table commandes
        $sql_commande = "INSERT INTO commandes (client_id, numero_commande, total, adresse_livraison, details_livraison, mode_paiement, frais_livraison) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_commande = $conn->prepare($sql_commande);
        if (!$stmt_commande) {
            throw new Exception('Erreur de préparation de la requête commande.');
        }
        
        $stmt_commande->bind_param("isssssd", 
            $client_id, 
            $numero_commande, 
            $total_final, 
            $adresse_complete, 
            $details_livraison, 
            $mode_paiement, 
            $frais_livraison
        );
        
        if (!$stmt_commande->execute()) {
            $stmt_commande->close();
            throw new Exception('Erreur lors de la création de la commande.');
        }
        
        $commande_id = $conn->insert_id;
        $stmt_commande->close();
        
        // Insérer les détails de la commande
        $sql_detail = "INSERT INTO commandes_details (commande_id, produit_id, quantite, prix_unitaire) VALUES (?, ?, ?, ?)";
        $stmt_detail = $conn->prepare($sql_detail);
        if (!$stmt_detail) {
            throw new Exception('Erreur de préparation de la requête détails.');
        }
        
        foreach ($panier_items as $item) {
            $stmt_detail->bind_param("iiid", 
                $commande_id, 
                $item['produit_id'], 
                $item['quantite'], 
                $item['prix_unitaire']
            );
            
            if (!$stmt_detail->execute()) {
                $stmt_detail->close();
                throw new Exception('Erreur lors de l\'ajout des détails de commande.');
            }
            
            // Mettre à jour le stock du produit
            $sql_stock = "UPDATE produits SET stock = stock - ? WHERE id = ?";
            $stmt_stock = $conn->prepare($sql_stock);
            if ($stmt_stock) {
                $stmt_stock->bind_param("ii", $item['quantite'], $item['produit_id']);
                $stmt_stock->execute();
                $stmt_stock->close();
            }
        }
        
        $stmt_detail->close();
        
        // Vider le panier après la commande
        $sql_vider = "DELETE FROM panier WHERE client_id = ?";
        $stmt_vider = $conn->prepare($sql_vider);
        if ($stmt_vider) {
            $stmt_vider->bind_param("i", $client_id);
            $stmt_vider->execute();
            $stmt_vider->close();
        }
        
        // Valider la transaction
        $conn->commit();
        $conn->close();
        
        return [
            'success' => true, 
            'message' => 'Commande créée avec succès.', 
            'numero_commande' => $numero_commande,
            'total' => $total_final
        ];
        
    } catch (Exception $e) {
        // Annuler la transaction en cas d'erreur
        $conn->rollback();
        $conn->close();
        
        return [
            'success' => false, 
            'message' => $e->getMessage()
        ];
    }
}

// Fonction pour traiter les messages de contact des clients connectés
function contact_recup($client_id, $prenom, $nom, $email, $telephone, $service, $message) {
    $conn = connectDB();
    
    // Validation des données
    if (empty($prenom) || empty($nom) || empty($email) || empty($service) || empty($message)) {
        $conn->close();
        return ['success' => false, 'message' => 'Veuillez remplir tous les champs obligatoires.'];
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $conn->close();
        return ['success' => false, 'message' => 'Adresse email invalide.'];
    }
    
    // Préparer les données pour l'insertion
    $nom_complet = trim($prenom . ' ' . $nom);
    $date_contact = date('Y-m-d H:i:s');
    $statut = 'nouveau'; // Statut par défaut
    
    // Insertion dans la table contacts
    $sql = "INSERT INTO contacts (client_id, nom_complet, email, telephone, service, message, date_contact, statut) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("isssssss", $client_id, $nom_complet, $email, $telephone, $service, $message, $date_contact, $statut);
        
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return ['success' => true, 'message' => 'Votre message a été envoyé avec succès ! Nous vous contacterons dans les plus brefs délais.'];
        } else {
            $stmt->close();
            $conn->close();
            return ['success' => false, 'message' => 'Erreur lors de l\'envoi du message. Veuillez réessayer.'];
        }
    } else {
        $conn->close();
        return ['success' => false, 'message' => 'Erreur de préparation de la requête.'];
    }
}

// Fonction pour obtenir les informations détaillées d'un client
function obtenirInfosClient($client_id) {
    $conn = connectDB();
    
    $sql = "SELECT * FROM clients WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $client_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $client = $result->fetch_assoc();
            $stmt->close();
            $conn->close();
            return $client;
        }
        $stmt->close();
    }
    
    $conn->close();
    return null;
}

// Fonction pour modifier le profil d'un client
function modifierProfilClient($client_id, $nom_complet, $telephone, $adresse, $mot_de_passe_actuel = '', $nouveau_mot_de_passe = '', $confirmer_mot_de_passe = '') {
    $conn = connectDB();
    
    // Validation des données de base
    if (empty($nom_complet) || empty($telephone)) {
        $conn->close();
        return ['success' => false, 'message' => 'Le nom complet et le téléphone sont obligatoires.'];
    }
    
    // Si l'utilisateur veut changer son mot de passe
    if (!empty($mot_de_passe_actuel) || !empty($nouveau_mot_de_passe) || !empty($confirmer_mot_de_passe)) {
        // Vérifier que tous les champs de mot de passe sont remplis
        if (empty($mot_de_passe_actuel) || empty($nouveau_mot_de_passe) || empty($confirmer_mot_de_passe)) {
            $conn->close();
            return ['success' => false, 'message' => 'Veuillez remplir tous les champs pour changer le mot de passe.'];
        }
        
        // Vérifier que les nouveaux mots de passe correspondent
        if ($nouveau_mot_de_passe !== $confirmer_mot_de_passe) {
            $conn->close();
            return ['success' => false, 'message' => 'Les nouveaux mots de passe ne correspondent pas.'];
        }
        
        // Vérifier la longueur du nouveau mot de passe
        if (strlen($nouveau_mot_de_passe) < 6) {
            $conn->close();
            return ['success' => false, 'message' => 'Le nouveau mot de passe doit contenir au moins 6 caractères.'];
        }
        
        // Vérifier l'ancien mot de passe
        $sql_check = "SELECT mot_de_passe FROM clients WHERE id = ?";
        $stmt_check = $conn->prepare($sql_check);
        
        if ($stmt_check) {
            $stmt_check->bind_param("i", $client_id);
            $stmt_check->execute();
            $result = $stmt_check->get_result();
            
            if ($result->num_rows === 1) {
                $client = $result->fetch_assoc();
                if (!password_verify($mot_de_passe_actuel, $client['mot_de_passe'])) {
                    $stmt_check->close();
                    $conn->close();
                    return ['success' => false, 'message' => 'Le mot de passe actuel est incorrect.'];
                }
            } else {
                $stmt_check->close();
                $conn->close();
                return ['success' => false, 'message' => 'Client introuvable.'];
            }
            $stmt_check->close();
        }
        
        // Hacher le nouveau mot de passe
        $nouveau_mot_de_passe_hash = password_hash($nouveau_mot_de_passe, PASSWORD_DEFAULT);
        
        // Mettre à jour avec le nouveau mot de passe
        $sql = "UPDATE clients SET nom_complet = ?, telephone = ?, adresse = ?, mot_de_passe = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("ssssi", $nom_complet, $telephone, $adresse, $nouveau_mot_de_passe_hash, $client_id);
            
            if ($stmt->execute()) {
                $stmt->close();
                $conn->close();
                return ['success' => true, 'message' => 'Profil et mot de passe mis à jour avec succès !'];
            } else {
                $stmt->close();
                $conn->close();
                return ['success' => false, 'message' => 'Erreur lors de la mise à jour.'];
            }
        }
    } else {
        // Mettre à jour sans changer le mot de passe
        $sql = "UPDATE clients SET nom_complet = ?, telephone = ?, adresse = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("sssi", $nom_complet, $telephone, $adresse, $client_id);
            
            if ($stmt->execute()) {
                $stmt->close();
                $conn->close();
                return ['success' => true, 'message' => 'Profil mis à jour avec succès !'];
            } else {
                $stmt->close();
                $conn->close();
                return ['success' => false, 'message' => 'Erreur lors de la mise à jour.'];
            }
        }
    }
    
    $conn->close();
    return ['success' => false, 'message' => 'Erreur de préparation de la requête.'];
}

// Fonction pour obtenir l'historique des commandes d'un client
function obtenirHistoriqueCommandes($client_id) {
    $conn = connectDB();
    $commandes = [];
    
    $sql = "SELECT * FROM commandes WHERE client_id = ? ORDER BY date_commande DESC";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $client_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $commandes[] = $row;
        }
        $stmt->close();
    }
    
    $conn->close();
    return $commandes;
}

// Fonction pour obtenir une commande par ID
function obtenirCommandeParId($commande_id, $client_id = null) {
    $conn = connectDB();
    
    if ($client_id) {
        $sql = "SELECT * FROM commandes WHERE id = ? AND client_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $commande_id, $client_id);
    } else {
        $sql = "SELECT * FROM commandes WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $commande_id);
    }
    
    if ($stmt) {
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $commande = $result->fetch_assoc();
            $stmt->close();
            $conn->close();
            return $commande;
        }
        $stmt->close();
    }
    
    $conn->close();
    return null;
}

// Fonction pour mettre à jour le statut d'une commande
function mettreAJourStatutCommande($commande_id, $nouveau_statut) {
    $conn = connectDB();
    
    $sql = "UPDATE commandes SET statut = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("si", $nouveau_statut, $commande_id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
    
    $conn->close();
    return false;
}
?>