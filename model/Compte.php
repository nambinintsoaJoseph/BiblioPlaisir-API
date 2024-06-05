<?php 

class Compte {

    private $conn; 

    public function __construct($conn) {
        $this->conn = $conn; 
    }

    // endpoint : GET localhost/BiblioPlaisir/api/Compte.php/{email}
    public function recupererCompte($email) {
        $sql = "SELECT id_compte, type_compte, nom, prenom, date_naissance, photo, date_inscription, email, date_dernier_acces FROM Compte WHERE email=:email";
        $requetePreparee = $this->conn->prepare($sql); 

        $requetePreparee->bindParam(':email', $email); 
        $requetePreparee->execute();
        
        $info_compte = $requetePreparee->fetch(PDO::FETCH_ASSOC); 
        return $info_compte; 
    }
}

?>