<?php 

class Lecteur {

    private $conn; 

    public function __construct($conn) {
        $this->conn = $conn; 
    }

    // endpoint : POST localhost/BiblioPlaisir/api/Lecteur.php
    public function creer($donnees) {
        $sql = "INSERT INTO Lecteur(id_compte) VALUES(:id_compte);"; 

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

    // endpoint : GET localhost/BiblioPlaisir/api/Lecteur.php/{id}
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
                FROM Lecteur
                JOIN 
                    Compte ON Lecteur.id_compte = Compte.id_compte
                WHERE 
                    Lecteur.id_lecteur = :id_lecteur;
        ";

        $requetePreparee = $this->conn->prepare($sql); 
        $requetePreparee->bindParam(':id_lecteur', $id); 
        $requetePreparee->execute(); 

        $infoLecteur = $requetePreparee->fetch(PDO::FETCH_ASSOC);
        return $infoLecteur; 
    }

    // endpoint : DELETE localhost/BiblioPlaisir/api/Lecteur.php/{id}
    public function supprimer($id) {
        $sql = "DELETE FROM Lecteur WHERE id_lecteur = :id_lecteur"; 

        $requetePreparee = $this->conn->prepare($sql); 
        $requetePreparee->bindParam(':id_lecteur', $id);
        $lecteurSupprime = $requetePreparee->execute(); 

        if($lecteurSupprime) {
            return true; 
        }
        else {
            return false; 
        }
    }

}

?>