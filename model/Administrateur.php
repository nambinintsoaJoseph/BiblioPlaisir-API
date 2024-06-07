<?php 

class Administrateur {

    private $conn; 

    public function __construct($conn) {
        $this->conn = $conn; 
    }

    // endpoint : GET localhost/BiblioPlaisir/api/Administrateur.php/{id}
    public function recuperer($id) {
        $sql = "SELECT 
                    Compte.id_compte, 
                    Compte.nom, 
                    Compte.prenom, 
                    Compte.date_naissance, 
                    Compte.photo, 
                    Compte.email, 
                FROM Administrateur
                JOIN 
                    Compte ON Administrateur.id_compte = Compte.id_compte
                WHERE 
                    Administrateur.id_admin = :id_admin;
        ";

        $requetePreparee = $this->conn->prepare($sql); 
        $requetePreparee->bindParam(':id_admin', $id); 
        $requetePreparee->execute(); 

        $infoAdmin = $requetePreparee->fetch(PDO::FETCH_ASSOC);
        return $infoAdmin; 
    }

    // endpoint : POST localhost/BiblioPlaisir/api/Administrateur.php
    public function creer($donnees) {
        $sql = "INSERT INTO Administrateur(id_compte) VALUES(:id_compte);"; 

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

    // endpoint : DELETE localhost/BiblioPlaisir/api/Administrateur.php/{id}
    public function supprimer($id) {
        $sql = "DELETE FROM Administrateur WHERE id_admin = :id_admin"; 

        $requetePreparee = $this->conn->prepare($sql); 
        $requetePreparee->bindParam(':id_admin', $id);
        $adminSupprime = $requetePreparee->execute(); 

        if($adminSupprime) {
            return true; 
        }
        else {
            return false; 
        }
    }

}

?>