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
        require_once('../model/Auteur.php'); 
        include('fonctions.php'); 

        $baseDeDonnees = new BaseDeDonnees(); 
        $connexion = $baseDeDonnees->recupererConnexion(); 
        $auteur = new Auteur($connexion); 

        switch($methode) {
            case 'POST':
                // endpoint : POST localhost/BiblioPlaisir/api/Auteur.php
                $donneesNouveauAuteur = json_decode(file_get_contents('php://input'), true); 
                $nouveauAuteur = $auteur->creer($donneesNouveauAuteur); 

                if($nouveauAuteur) {
                    echo json_encode([
                        'message' => "Auteur ajouté"
                    ], JSON_PRETTY_PRINT);
                }
                else {
                    echo json_encode([
                        'message' => "Erreur d'ajout de l'auteur"
                    ], JSON_PRETTY_PRINT);
                }
                break; 
            CASE 'GET':
                // endpoint : GET localhost/BiblioPlaisir/api/Auteur.php/{id}
                $id_auteur = recupererParametreSimple($_SERVER['REQUEST_URI']);
                $auteurRecupere = $auteur->recuperer($id_auteur); 

                if($auteurRecupere) {
                    echo json_encode($auteurRecupere, JSON_PRETTY_PRINT);
                    http_response_code(200); 
                }
                else {
                    echo json_encode([
                        'message' => "Aucun auteur trouvé"
                    ], JSON_PRETTY_PRINT); 
                    http_response_code(200); 
                }
                break;
            case 'DELETE':
                // endpoint : DELETE localhost/BiblioPlaisir/api/Auteur.php/{id}
                $id_auteur = recupererParametreSimple($_SERVER['REQUEST_URI']);
                $auteurSupprime = $auteur->supprimer($id_auteur); 

                if($auteurSupprime) {
                    echo json_encode([
                        'message' => "Auteur supprimé avec succès"
                    ], JSON_PRETTY_PRINT);
                }
                else {
                    echo json_encode([
                        'message' => "Erreur de suppression du l'auteur"
                    ], JSON_PRETTY_PRINT);
                }
                break; 
        }

    }
    else {
        if($methode == 'PUT') {
            echo json_encode([
                'message' => "La méthode PUT n'est pas autorisée"
            ], JSON_PRETTY_PRINT);
        }
        else {
            echo json_encode([
                'message' => "Cette méthode ne fait pas partie du standard du REST"
            ], JSON_PRETTY_PRINT); 
        }
    }

?>