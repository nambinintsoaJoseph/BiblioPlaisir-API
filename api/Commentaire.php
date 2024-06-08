<?php

    header("Access-Control-Allow-Origin: *"); 
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET, POST, DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 

    $optionAutorise = ['GET', 'POST', 'DELETE']; 
    $methode = $_SERVER['REQUEST_METHOD']; 

    if(in_array($methode, $optionAutorise)) {

        require_once('../model/BaseDeDonnees.php'); 
        require_once('../model/Commentaire.php'); 
        include('fonctions.php'); 

        $baseDeDonnees = new BaseDeDonnees(); 
        $connexion = $baseDeDonnees->recupererConnexion(); 
        $commentaire = new Commentaire($connexion); 

        switch($methode) {
            case 'GET':
                $segments = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));
                if($segments[4] == 'livre') {
                    // endpoint : GET localhost/BiblioPlaisir/api/Commentaire.php/livre/{id_livre}
                    $id_livre = recupererParametreSimple($_SERVER['REQUEST_URI']); 
                    $commentaires = $commentaire->recupererCommentairesLivre($id_livre); 

                    echo json_encode($commentaires, JSON_PRETTY_PRINT); 
                }
                else {
                    // endpoint : GET localhost/BiblioPlaisir/api/Commentaire.php/{id_commentaire}
                    $id_commentaire = recupererParametreSimple($_SERVER['REQUEST_URI']); 
                    $commentaireRecupere = $commentaire->recuperer($id_commentaire); 

                    echo json_encode($commentaireRecupere, JSON_PRETTY_PRINT); 
                }
                break;
            case 'POST':
                // endpoint : POST localhost/BiblioPlaisir/api/Commentaire.php
                $donneesCommentaire = json_decode(file_get_contents('php://input'), true);

                echo json_encode($donneesCommentaire, JSON_PRETTY_PRINT);

                $nouveauCommentaire = $commentaire->ajouter($donneesCommentaire); 
                
                if($nouveauCommentaire) {
                    echo json_encode([
                        'message' => 'Le commentaire a été ajouté'
                    ], JSON_PRETTY_PRINT);
                }
                else {
                    echo json_encode([
                        'message' => "Erreur d'ajout du commentaire"
                    ], JSON_PRETTY_PRINT); 
                }
                break; 
            case 'DELETE':
                // endpoint : DELETE localhost/BiblioPlaisir/api/Commentaire.php/{id_commentaire}
                $id_commentaire = recupererParametreSimple($_SERVER['REQUEST_URI']);
                $commentaireSupprime = $commentaire->supprimer($id_commentaire); 

                if($commentaireSupprime) {
                    echo json_encode([
                        'message' => "Commentaire supprimé"
                    ], JSON_PRETTY_PRINT); 
                }
                else {
                    echo json_decode([
                        'message' => "Erreur de suppression du commentaire"
                    ], JSON_PRETTY_PRINT); 
                }
                break; 
        }

    }

?>