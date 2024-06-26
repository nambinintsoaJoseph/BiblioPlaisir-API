<?php 

class Collection_livre {

    private $conn; 

    public function __construct($conn) {
        $this->conn = $conn; 
    }

    // endpoint : GET localhost/BiblioPlaisir/api/Collection_livre.php/{id_collection}
    public function recuperer($id_collection) {
        $sql = "SELECT  
                    Collection_livre.date_collection,
                    Livre.titre AS titre, 
                    Livre.nombre_page AS nombre_page,
                    Collection_livre.nombre_page_lu AS nombre_page_lu, 
                    Livre.photo_couverture AS photo_couverture,
                    Livre.chemin AS chemin,
                    Compte.nom AS nom_auteur, 
                    Compte.prenom AS prenom_auteur
                FROM Collection_livre
                    INNER JOIN Livre ON Collection_livre.id_livre = Livre.id_livre
                    INNER JOIN Auteur ON Livre.id_auteur = Auteur.id_auteur
                    INNER JOIN Compte ON Auteur.id_compte = Compte.id_compte 
                    WHERE id_collection = :id_collection;
        "; 

        $requetePreparee = $this->conn->prepare($sql); 
        $requetePreparee->bindParam(':id_collection', $id_collection); 
        $requetePreparee->execute(); 

        $infoCollection = $requetePreparee->fetch(PDO::FETCH_ASSOC);
        return $infoCollection; 
    }

    // endpoint : GET localhost/BiblioPlaisir/api/Collection_livre.php/lecteur/{id_lecteur}
    public function recupererCollectionLecteur($id_lecteur) {
        $sql = "SELECT 
                    Collection_livre.id_collection, 
                    Collection_livre.date_collection,
                    Livre.titre AS titre, 
                    Livre.nombre_page AS nombre_page,
                    Collection_livre.nombre_page_lu,
                    Livre.photo_couverture AS photo_couverture,
                    Livre.chemin AS chemin,
                    Compte.nom AS nom_auteur, 
                    Compte.prenom AS prenom_auteur
                FROM Collection_livre
                    INNER JOIN Livre ON Collection_livre.id_livre = Livre.id_livre
                    INNER JOIN Auteur ON Livre.id_auteur = Auteur.id_auteur
                    INNER JOIN Compte ON Auteur.id_compte = Compte.id_compte 
                    WHERE id_lecteur = :id_lecteur;
        ";

        $requetePreparee = $this->conn->prepare($sql); 
        $requetePreparee->bindParam(':id_lecteur', $id_lecteur); 
        $requetePreparee->execute(); 

        $collectionLivre = []; 
        while($collection = $requetePreparee->fetch(PDO::FETCH_ASSOC)) {
            $collectionLivre[] = $collection;
        }

        return $collectionLivre; 
    }

    // endpoint : POST localhost/BiblioPlaisir/api/Collection_livre.php 
    public function ajouter($donnees) {
        $sql = "INSERT INTO Collection_livre(id_livre, id_lecteur, nombre_page_lu) VALUES(:id_livre, :id_lecteur, 0);"; 

        $requetePreparee = $this->conn->prepare($sql); 
        $requetePreparee->bindParam(':id_livre', $donnees['id_livre']); 
        $requetePreparee->bindParam(':id_lecteur', $donnees['id_lecteur']); 

        $etat = $requetePreparee->execute(); 

        if($etat) {
            return true; 
        }
        else {
            return false; 
        }
    }

    // endpoint : DELETE localhost/BiblioPlaisir/api/Collection_livre.php/{id_collection}
    public function supprimer($id_collection) {
        $sql = "DELETE FROM Collection_livre WHERE id_collection = :id_collection;"; 

        $requetePreparee = $this->conn->prepare($sql); 
        $requetePreparee->bindParam(':id_collection', $id_collection); 
        $etat = $requetePreparee->execute(); 

        if($etat) {
            return true; 
        }
        else {
            return false; 
        }
    }
    
    // endpoint : PUT localhost/BiblioPlaisir/api/Collection_livre.php
    public function modifier($donnees) {
        $sql = "UPDATE Collection_livre SET nombre_page_lu = :nombre_page_lu WHERE id_collection = :id_collection;"; 

        $requetePreparee = $this->conn->prepare($sql); 
        $requetePreparee->bindParam(':nombre_page_lu', $donnees['nombre_page_lu']); 
        $requetePreparee->bindParam(':id_collection', $donnees['id_collection']); 

        $etat = $requetePreparee->execute(); 

        if($etat) {
            return true; 
        }
        else {
            return false; 
        }
    }

    // Pour vérifier si un livre appartient à la collection d'un lecteur : 
    public function possederCollection($id_collection, $id_lecteur) {
        $sql = "SELECT id_lecteur FROM Collection_livre WHERE id_collection = :id_collection";

        $requetePreparee = $this->conn->prepare($sql); 
        $requetePreparee->bindParam(':id_collection', $id_collection); 

        $requetePreparee->execute(); 

        $infoCollection = $requetePreparee->fetch(PDO::FETCH_ASSOC); 

        if($infoCollection['id_lecteur'] == $id_lecteur) {
            return true; 
        } else {
            return false; 
        }
    }

    // endpoint : GET localhost/BiblioPlaisir/api/Collection_livre.php/stat4mois/{id_lecteur}
    public function statistique4Mois($id_lecteur) {
        $sql = "WITH LastFourMonths AS (
                SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 0 MONTH), '%M') AS mois
                UNION ALL
                SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 1 MONTH), '%M')
                UNION ALL
                SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 2 MONTH), '%M')
                UNION ALL
                SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 3 MONTH), '%M')
            )
            SELECT 
                CASE 
                    WHEN mois = 'January' THEN 'janvier'
                    WHEN mois = 'February' THEN 'février'
                    WHEN mois = 'March' THEN 'mars'
                    WHEN mois = 'April' THEN 'avril'
                    WHEN mois = 'May' THEN 'mai'
                    WHEN mois = 'June' THEN 'juin'
                    WHEN mois = 'July' THEN 'juillet'
                    WHEN mois = 'August' THEN 'août'
                    WHEN mois = 'September' THEN 'septembre'
                    WHEN mois = 'October' THEN 'octobre'
                    WHEN mois = 'November' THEN 'novembre'
                    WHEN mois = 'December' THEN 'décembre'
                END AS mois,
                COALESCE(SUM(cl.nombre_page_lu = l.nombre_page), 0) AS nombre_livre_lu
            FROM 
                LastFourMonths m
            LEFT JOIN 
                Collection_livre cl ON DATE_FORMAT(cl.date_collection, '%M') = m.mois
            LEFT JOIN 
                Livre l ON cl.id_livre = l.id_livre
                AND cl.id_lecteur = :id_lecteur
                AND cl.date_collection >= DATE_SUB(CURDATE(), INTERVAL 4 MONTH)
            GROUP BY 
                mois
            ORDER BY 
                STR_TO_DATE(CONCAT(mois, ' 1'), '%M %d');
        ";

        $requetePreparee = $this->conn->prepare($sql); 
        $requetePreparee->bindParam(':id_lecteur', $id_lecteur); 
        $requetePreparee->execute();

        $resultat = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);

        // Mois comme clé : 
        $livreLu = []; 
        foreach($resultat as $row) {
            $livreLu[$row['mois']] = (int)$row['nombre_livre_lu'];
        }

        return $livreLu;
    }
}

?>