<?php 

class Collection_livre {

    private $conn; 

    public function __construct($conn) {
        $this->conn = $conn; 
    }

    // endpoint : GET localhost/BiblioPlaisir/api/Collection_livre.php/{id_collection}
    public function recuperer($id_collection) {
        $sql = "SELECT * FROM Collection_livre WHERE id_collection = :id_collection;"; 

        $requetePreparee = $this->conn->prepare($sql); 
        $requetePreparee->bindParam(':id_collection', $id_collection); 
        $requetePreparee->execute(); 

        $infoCollection = $requetePreparee->fetch(PDO::FETCH_ASSOC);
        return $infoCollection; 
    }

    // endpoint : GET localhost/BiblioPlaisir/api/Collection_livre.php/lecteur/{id_lecteur}
    public function recupererCollectionLecteur($id_lecteur) {
        $sql = "SELECT * FROM Collection_livre WHERE id_lecteur = :id_lecteur"; 

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
        $sql = "INSERT INTO Collection_livre(id_livre, id_lecteur) VALUES(:id_livre, :id_lecteur);"; 

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
    

}

?>