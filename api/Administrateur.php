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
        require_once('../model/Administrateur.php'); 
        include('fonctions.php'); 

        $baseDeDonnees = new BaseDeDonnees(); 
        $connexion = $baseDeDonnees->recupererConnexion(); 
        $administrateur = new Administrateur($connexion); 

        switch($methode) {
            case 'POST':
                // endpoint : POST localhost/BiblioPlaisir/api/Administrateur.php
                $donneesNouveauAdmin = json_decode(file_get_contents('php://input'), true); 
                $nouveauAdmin = $administrateur->creer($donneesNouveauAdmin); 

                if($nouveauAdmin) {
                    echo json_encode([
                        'message' => "Administrateur ajouté"
                    ], JSON_PRETTY_PRINT);
                }
                else {
                    echo json_encode([
                        'message' => "Erreur d'ajout de l'administrateur"
                    ], JSON_PRETTY_PRINT);
                }
                break; 
            CASE 'GET':
                // endpoint : GET localhost/BiblioPlaisir/api/Administrateur.php/{id}
                $id_admin = recupererParametreSimple($_SERVER['REQUEST_URI']);
                $adminRecupere = $administrateur->recuperer($id_admin); 

                if($adminRecupere) {
                    echo json_encode($adminRecupere, JSON_PRETTY_PRINT);
                    http_response_code(200); 
                }
                else {
                    echo json_encode([
                        'message' => "Aucun administrateur trouvé"
                    ], JSON_PRETTY_PRINT); 
                    http_response_code(200); 
                }
                break;
            case 'DELETE':
                // endpoint : DELETE localhost/BiblioPlaisir/api/Administrateur.php/{id}
                $id_admin = recupererParametreSimple($_SERVER['REQUEST_URI']);
                $adminSupprime = $administrateur->supprimer($id_admin); 

                if($adminSupprime) {
                    echo json_encode([
                        'message' => "Administrateur supprimé avec succès"
                    ], JSON_PRETTY_PRINT);
                }
                else {
                    echo json_encode([
                        'message' => "Erreur de suppression de l'administrateur"
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