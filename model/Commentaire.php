<?php 
    class Commentaire {

        private $conn; 

        public function __construct($conn) {
            $this->conn = $conn; 
        }

        // endpoint : GET localhost/BiblioPlaisir/api/Commentaire.php/{id_commentaire}
        public function recuperer($id_commentaire) {
            $sql = "SELECT * FROM Commentaire WHERE id_commentaire = :id_commentaire;"; 

            $requetePreparee = $this->conn->prepare($sql); 
            $requetePreparee->bindParam(':id_commentaire', $id_commentaire); 
            $requetePreparee->execute(); 

            $commentaire = $requetePreparee->fetch(PDO::FETCH_ASSOC); 
            return $commentaire; 
        }

        // endpoint : GET localhost/BiblioPlaisir/api/Commentaire.php/livre/{id_livre}
        public function recupererCommentairesLivre($id_livre) {
            $sql = "SELECT 
                        Compte.id_compte, 
                        Compte.nom, 
                        Compte.prenom, 
                        Compte.photo, 
                        Commentaire.texte_commentaire, 
                        Commentaire.date_commentaire 
                    FROM 
                        Commentaire 
                    INNER JOIN 
                        Lecteur ON Commentaire.id_lecteur = Lecteur.id_lecteur 
                    INNER JOIN 
                        Compte ON Lecteur.id_compte = Compte.id_compte 
                    WHERE 
                        Commentaire.id_livre = :id_livre;
            "; 

            $requetePreparee = $this->conn->prepare($sql); 
            $requetePreparee->bindParam(':id_livre', $id_livre); 
            $requetePreparee->execute(); 

            $commentairesLivre = []; 
            while($commentaire = $requetePreparee->fetch(PDO::FETCH_ASSOC)) {
                $commentairesLivre[] = $commentaire; 
            }

            return $commentairesLivre; 
        }

        // endpoint : POST localhost/BiblioPlaisir/api/Commentaire.php
        public function ajouter($donnees) {
            $sql = "INSERT INTO Commentaire(
                                    id_lecteur, 
                                    id_livre, 
                                    texte_commentaire) 
                    VALUES(:id_lecteur, :id_livre, :texte_commentaire);"; 

            $requetePreparee = $this->conn->prepare($sql); 

            $requetePreparee->bindParam(':id_lecteur', $donnees['id_lecteur']); 
            $requetePreparee->bindParam(':id_livre', $donnees['id_livre']); 
            $requetePreparee->bindParam(':texte_commentaire', $donnees['texte_commentaire']); 

            $etat = $requetePreparee->execute(); 

            if($etat) {
                return true; 
            }
            else {
                return false; 
            }
        }

        // endpoint : DELETE localhost/BiblioPlaisir/api/Commentaire.php/{id_commentaire}
        public function supprimer($id_commentaire) {
            $sql = "DELETE FROM Commentaire WHERE id_commentaire = :id_commentaire;"; 

            $requetePreparee = $this->conn->prepare($sql); 
            $requetePreparee->bindParam(':id_commentaire', $id_commentaire); 
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