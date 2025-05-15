CREATE DATABASE journal_etudiant;
USE journal_etudiant;

CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL
);

CREATE TABLE stages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    date DATE NOT NULL,
    heures_travail INT NOT NULL,
    observations TEXT,
    commentaires TEXT,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
);
