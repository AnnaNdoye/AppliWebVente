<?php
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

// Fonction pour traiter le formulaire de contact
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

// Traitement du formulaire si des données POST sont reçues
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = traiterContact();
    
    // Réponse JSON pour AJAX (optionnel)
    if (isset($_POST['ajax']) && $_POST['ajax'] === '1') {
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    
    // Stockage du résultat en session pour affichage
    $_SESSION['contact_result'] = $result;
    
    // Redirection pour éviter la resoumission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Fonction pour afficher les messages
function afficherMessage() {
    if (isset($_SESSION['contact_result'])) {
        $result = $_SESSION['contact_result'];
        $class = $result['success'] ? 'success' : 'error';
        echo "<div class='message {$class}'>{$result['message']}</div>";
        unset($_SESSION['contact_result']);
    }
}
?>