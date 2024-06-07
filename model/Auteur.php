<?php 

class Auteur {

    private $conn; 

    public function __construct($conn) {
        $this->conn = $conn; 
    }

    // endpoint : GET localhost/BiblioPlaisir/api/Auteur.php/{id}
    public function recuperer($id) {
        $sql = "SELECT 
                    Compte.id_compte, 
                    Compte.nom, 
                    Compte.prenom, 
                    Compte.date_naissance, 
                    Compte.photo, 
                    Compte.date_inscription, 
                    Compte.email, 
                    Compte.date_dernier_acces
                FROM Auteur
                JOIN 
                    Compte ON Auteur.id_compte = Compte.id_compte
                WHERE 
                    Auteur.id_auteur = :id_auteur;
        ";

        $requetePreparee = $this->conn->prepare($sql); 
        $requetePreparee->bindParam(':id_auteur', $id); 
        $requetePreparee->execute(); 

        $infoAuteur = $requetePreparee->fetch(PDO::FETCH_ASSOC);
        return $infoAuteur; 
    }

    // endpoint : POST localhost/BiblioPlaisir/api/Auteur.php
    public function creer($donnees) {
        $sql = "INSERT INTO Auteur(id_compte) VALUES(:id_compte);"; 

        $requetePreparee = $this->conn->prepare($sql);
        $requetePreparee->bindParam(':id_compte', $donnees['id_compte']);  

        $etat = $requetePreparee->execute(); 

        if($etat) {
            return true; 
        }
        else {
            return false; 
        }
    }

    // endpoint : DELETE localhost/BiblioPlaisir/api/Auteur.php/{id}
    public function supprimer($id) {
        $sql = "DELETE FROM Auteur WHERE id_auteur = :id_auteur"; 

        $requetePreparee = $this->conn->prepare($sql); 
        $requetePreparee->bindParam(':id_auteur', $id);
        $auteurSupprime = $requetePreparee->execute(); 

        if($auteurSupprime) {
            return true; 
        }
        else {
            return false; 
        }
    }

}

?>