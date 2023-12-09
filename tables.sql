    -- Mouhamadou Bamba Toure --
    -- Table des contacts --
CREATE TABLE contact (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    id_categorie INTEGER REFERENCES categorie(id)
);

    -- Table des catégories --
CREATE TABLE categorie (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255)
);


INSERT INTO categorie (nom) VALUES
('Amis'),
('Famille'),
('Collègues'),
('Autre');

INSERT INTO contact (nom, prenom, id_categorie) VALUES
('Doe', 'John', 1),  
('Smith', 'Jane', 2), 
('Johnson', 'Bob', 3); 
