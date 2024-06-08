<?php 
declare(strict_types=1);

class Compte {

    private $conn; 

    public function __construct($conn) {
        $this->conn = $conn; 
    }

    // endpoint : GET localhost/BiblioPlaisir/api/Compte.php/{email}
    public function recupererCompte($email) {
        $sql = "SELECT 
                    id_compte, 
                    type_compte, 
                    nom, 
                    prenom, 
                    date_naissance, 
                    photo, date_inscription, 
                    email, 
                    date_dernier_acces 
                FROM Compte 
                WHERE email=:email";
        $requetePreparee = $this->conn->prepare($sql); 

        $requetePreparee->bindParam(':email', $email); 
        $requetePreparee->execute();
        
        $info_compte = $requetePreparee->fetch(PDO::FETCH_ASSOC); 
        return $info_compte; 
    }

    // endpoint : PUT localhost/BiblioPlaisir/api/Compte.php/{id}
    public function modifier($id, $donnees) {
        $sql = "UPDATE Compte SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance, email = :email, mot_de_passe = :mot_de_passe WHERE id_compte = :id"; 

        $requetePreparee = $this->conn->prepare($sql); 

        $requetePreparee->bindParam(':nom', $donnees['nom']); 
        $requetePreparee->bindParam(':prenom', $donnees['prenom']); 
        $requetePreparee->bindParam(':date_naissance', $donnees['date_naissance']); 
        $requetePreparee->bindParam(':email', $donnees['email']); 
        $requetePreparee->bindParam(':mot_de_passe', $donnees['mot_de_passe']); 
        $requetePreparee->bindParam(':id', $id); 

        $etat = $requetePreparee->execute(); 

        if($etat) {
            return true; 
        }
        else {
            return false; 
        }
    }

    // endpoint : POST localhost/BiblioPlaisir/api/Compte.php 
    public function creer($donnees) {
        $sql = "INSERT INTO Compte(type_compte, nom, prenom, date_naissance, email, mot_de_passe) VALUES(:type_compte, :nom, :prenom, :date_naissance, :email, :mot_de_passe);"; 

        $requetePreparee = $this->conn->prepare($sql); 

        $requetePreparee->bindParam(':type_compte', $donnees['type_compte']); 
        $requetePreparee->bindParam(':nom', $donnees['nom']); 
        $requetePreparee->bindParam(':prenom', $donnees['prenom']); 
        $requetePreparee->bindParam(':date_naissance', $donnees['date_naissance']); 
        $requetePreparee->bindParam(':email', $donnees['email']); 
        $requetePreparee->bindParam(':mot_de_passe', $donnees['mot_de_passe']); 

        $etat = $requetePreparee->execute(); 

        if($etat) {
            return true; 
        }
        else {
            return false; 
        }
    }

    // endpoint : DELETE localhost/BiblioPlaisir/api/Compte.php/{id}
    public function supprimer($id) {
        $sql = "DELETE FROM Compte WHERE id_compte = :id"; 
        $requetePreparee = $this->conn->prepare($sql); 
        $requetePreparee->bindParam(':id', $id); 

        $etat = $requetePreparee->execute(); 

        if($etat) {
            return true; 
        }
        else {
            return false; 
        }
    }
}
?>