CREATE TABLE IF NOT EXISTS Compte(
    id_compte BIGINT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    type_compte VARCHAR(15) NOT NULL, 
    nom VARCHAR(30) NOT NULL, 
    prenom VARCHAR(30) NOT NULL, 
    date_naissance DATE NOT NULL, 
    photo VARCHAR(50), 
    date_inscription DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    email VARCHAR(40) NOT NULL, 
    mot_de_passe TEXT NOT NULL, 
    PRIMARY KEY (id_compte)
) ENGINE=InnoDB; 

CREATE TABLE IF NOT EXISTS Administrateur(
    id_admin BIGINT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    id_compte BIGINT(11) UNSIGNED NOT NULL, 
    FOREIGN KEY (id_compte) REFERENCES Compte(id_compte), 
    PRIMARY KEY (id_admin)
) ENGINE=InnoDB; 

CREATE TABLE IF NOT EXISTS Lecteur(
    id_lecteur BIGINT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    id_compte BIGINT(11) UNSIGNED NOT NULL, 
    FOREIGN KEY (id_compte) REFERENCES Compte(id_compte), 
    PRIMARY KEY (id_lecteur)
) ENGINE=InnoDB; 

CREATE TABLE IF NOT EXISTS Auteur(
    id_auteur BIGINT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    id_compte BIGINT(11) UNSIGNED NOT NULL, 
    FOREIGN KEY (id_compte) REFERENCES Compte(id_compte), 
    PRIMARY KEY (id_auteur)
) ENGINE=InnoDB; 

CREATE TABLE IF NOT EXISTS Vocabulaire(
    id_vocabulaire BIGINT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    id_lecteur BIGINT(11) UNSIGNED NOT NULL, 
    mot VARCHAR(20) NOT NULL, 
    definition_mot TEXT NOT NULL, 
    date_ajout DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_lecteur) REFERENCES Lecteur(id_lecteur), 
    PRIMARY KEY (id_vocabulaire) 
) ENGINE=InnoDB; 

CREATE TABLE IF NOT EXISTS Livre(
    id_livre BIGINT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    id_auteur BIGINT(11) UNSIGNED NOT NULL, 
    titre VARCHAR(30) NOT NULL, 
    nombre_page INT(4) NOT NULL, 
    editeur VARCHAR(10), 
    genre VARCHAR(15) NOT NULL, 
    date_importaion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    photo_couverture VARCHAR(255) NOT NULL, 
    resumer TEXT NOT NULL, 
    classe_age VARCHAR(5), 
    chemin VARCHAR(50) NOT NULL, 
    FOREIGN KEY (id_auteur) REFERENCES Auteur(id_auteur), 
    PRIMARY KEY (id_livre)
) ENGINE=InnoDB; 

CREATE TABLE IF NOT EXISTS Collection_livre(
    id_collection BIGINT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    id_livre BIGINT(11) UNSIGNED NOT NULL, 
    id_lecteur BIGINT(11) UNSIGNED NOT NULL, 
    nombre_page_lu INT(4) UNSIGNED NOT NULL,
    date_collection DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, 
    FOREIGN KEY (id_livre) REFERENCES Livre(id_livre), 
    FOREIGN KEY (id_lecteur) REFERENCES Lecteur(id_lecteur), 
    PRIMARY KEY (id_collection)
) ENGINE=InnoDB; 

CREATE TABLE IF NOT EXISTS Commentaire(
    id_commentaire BIGINT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    id_lecteur BIGINT(11) UNSIGNED NOT NULL, 
    id_livre BIGINT(11) UNSIGNED NOT NULL, 
    texte_commentaire TEXT NOT NULL, 
    date_commentaire DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (id_lecteur) REFERENCES Lecteur(id_lecteur), 
    FOREIGN KEY (id_livre) REFERENCES Livre(id_livre), 
    PRIMARY KEY (id_commentaire)
) ENGINE=InnoDB; 