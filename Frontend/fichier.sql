-- Création de la base de données
CREATE DATABASE IF NOT EXISTS deco_elegance;
USE deco_elegance;

-- Table clients (existante)
DROP TABLE IF EXISTS clients;
CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_complet VARCHAR(200) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    telephone VARCHAR(20),
    mot_de_passe VARCHAR(255) NOT NULL,
    adresse TEXT,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    derniere_connexion TIMESTAMP NULL,
    statut ENUM('actif', 'inactif', 'suspendu') DEFAULT 'actif'
);

-- Table contacts (existante)
DROP TABLE IF EXISTS contacts;
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    telephone VARCHAR(20),
    type_service VARCHAR(50) CHECK (type_service IN (
        'conseil', 
        'amenagement', 
        'evenementiel', 
        'visite', 
        'produits'
    )),
    message TEXT,
    date_envoi TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des catégories de produits
DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    statut ENUM('actif', 'inactif') DEFAULT 'actif',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des produits
DROP TABLE IF EXISTS produits;
CREATE TABLE produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(200) NOT NULL,
    description TEXT,
    prix DECIMAL(10,2) NOT NULL,
    prix_promo DECIMAL(10,2) NULL,
    categorie_id INT,
    stock INT DEFAULT 0,
    image_principale VARCHAR(255),
    statut ENUM('actif', 'inactif', 'rupture') DEFAULT 'actif',
    popularite INT DEFAULT 0,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (categorie_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Table des images produits (galerie)
DROP TABLE IF EXISTS produits_images;
CREATE TABLE produits_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produit_id INT,
    image VARCHAR(255) NOT NULL,
    alt_text VARCHAR(200),
    ordre INT DEFAULT 0,
    FOREIGN KEY (produit_id) REFERENCES produits(id) ON DELETE CASCADE
);

-- Table du panier
DROP TABLE IF EXISTS panier;
CREATE TABLE panier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    produit_id INT,
    quantite INT DEFAULT 1,
    prix_unitaire DECIMAL(10,2),
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
    FOREIGN KEY (produit_id) REFERENCES produits(id) ON DELETE CASCADE,
    UNIQUE KEY unique_client_produit (client_id, produit_id)
);

-- Table des commandes
DROP TABLE IF EXISTS commandes;
CREATE TABLE commandes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    numero_commande VARCHAR(50) UNIQUE,
    total DECIMAL(10,2) NOT NULL,
    statut ENUM('en_attente', 'confirmee', 'expediee', 'livree', 'annulee') DEFAULT 'en_attente',
    adresse_livraison TEXT NOT NULL,
    details_livraison TEXT,
    mode_paiement ENUM('livraison', 'mobile', 'virement') DEFAULT 'livraison',
    frais_livraison DECIMAL(10,2) DEFAULT 2000.00,
    date_commande TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id)
);


-- Table des détails de commande
DROP TABLE IF EXISTS commandes_details;
CREATE TABLE commandes_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commande_id INT,
    produit_id INT,
    quantite INT NOT NULL,
    prix_unitaire DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (commande_id) REFERENCES commandes(id) ON DELETE CASCADE,
    FOREIGN KEY (produit_id) REFERENCES produits(id)
);

-- Insertion de données de test
INSERT INTO categories (nom, description, image) VALUES
('Coussins', 'Coussins decoratifs pour tous les styles', 'coussin2.jpeg'),
('Rideaux', 'Rideaux et voilages pour habiller vos fenetres', 'rideau3.jpg'),
('Tableaux', 'Tableaux et oeuvres d\'art pour decorer vos murs', 'tableau2.jpg'),
('Meubles', 'Meubles de decoration et rangement', 'meubles4.jpg');


INSERT INTO produits (nom, description, prix, prix_promo, categorie_id, stock, image_principale, popularite) VALUES
('Coussin rose motif', 'Coussin decoratif rose avec motif floral. Dimensions : 45x45 cm', 12000, 9500, 1, 30, 'coussin1.jpg', 70),
('Coussins multicolores', 'Lot de coussins colores parfaits pour un salon vivant', 25000, NULL, 1, 25, 'coussin3.jpg', 80),
('Coussin blanc douillet', 'Coussin moelleux blanc pour une touche epuree', 15000, 13000, 1, 15, 'coussin4.jpg', 65),
('Coussins velours vintage', 'Coussins en velours a teinte chaude style retro', 23000, 19500, 1, 10, 'coussin5.jpeg', 77),

('Rideau velours rose', 'Rideau en velours rose pour une ambiance cosy', 32000, 28000, 2, 20, 'rideau1.jpg', 85),
('Rideau bicolore moderne', 'Rideau gris et beige pour interieur moderne', 35000, NULL, 2, 18, 'rideau2.jpg', 70),
('Rideau lin naturel', 'Rideau en lin naturel, style elegant', 38000, 33000, 2, 22, 'rideau3.jpg', 91),
('Voilage blanc transparent', 'Voilage blanc translucide pour plus de lumiere', 22000, NULL, 2, 40, 'rideau4.jpg', 68),
('Rideau graphique bleu', 'Rideau avec motifs graphiques bleu et blanc', 29000, 26000, 2, 30, 'rideau5.jpg', 75),

('Tableau portrait femme', 'Portrait expressif sur fond blanc, style moderne', 105000, 85000, 3, 8, 'tableau2.jpg', 88),
('Tableau abstrait colore', 'Oeuvre d\'art abstraite tres coloree', 90000, NULL, 3, 12, 'tableau3.jpg', 79),
('Tableau africaine', 'Portrait d\'une femme africaine en couleurs vives', 80000, 72000, 3, 10, 'tableau4.jpg', 82),
('Tableau western', 'Peinture representant une scene western', 60000, 50000, 3, 14, 'tableau5.jpeg', 73),

('Meuble TV scandinave', 'Meuble TV bois clair et blanc style scandinave', 195000, 160000, 4, 5, 'meuble3.jpg', 90),
('Meuble chambre moderne', 'Lit avec tete de lit bois clair et rangement', 230000, 210000, 4, 4, 'meuble5.jpeg', 87);

-- Insertion des images de produits
INSERT INTO produits_images (produit_id, image, alt_text, ordre) VALUES
(1, 'coussin1.jpg', 'Coussin rose motif floral', 1),
(2, 'coussin3.jpg', 'Coussins multicolores', 1),
(3, 'coussin4.jpg', 'Coussin blanc epure', 1),
(4, 'coussin5.jpeg', 'Coussins vintage en velours', 1),

(5, 'rideau1.jpg', 'Rideau velours rose', 1),
(6, 'rideau2.jpg', 'Rideau bicolore', 1),
(7, 'rideau3.jpg', 'Rideau en lin naturel', 1),
(8, 'rideau4.jpg', 'Voilage blanc', 1),
(9, 'rideau5.jpg', 'Rideau graphique bleu', 1),

(10, 'tableau2.jpg', 'Portrait artistique femme', 1),
(11, 'tableau3.jpg', 'Tableau abstrait colore', 1),
(12, 'tableau4.jpg', 'Portrait africain', 1),
(13, 'tableau5.jpeg', 'Scene western', 1),

(14, 'meuble3.jpg', 'Meuble TV bois clair', 1),
(15, 'meuble5.jpeg', 'Lit moderne avec rangement', 1);
