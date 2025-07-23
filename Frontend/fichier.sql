-- Création de la base
--CREATE DATABASE deco_elegance;
--USE deco_elegance;




--contact
DROP TABLE IF EXISTS contacts;

CREATE TABLE contacts (
    id SERIAL PRIMARY KEY,
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
