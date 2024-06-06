<?php 

    header("Access-Control-Allow-Origin: *"); 
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 

    $optionAutorise = ['GET', 'PUT', 'POST', 'DELETE']; 
    $methode = $_SERVER['REQUEST_METHOD']; 

    if(in_array($methode, $optionAutorise)) {

        require_once('../model/BaseDeDonnees.php'); 
        require_once('../model/Compte.php'); 
        include('fonctions.php'); 

        $baseDeDonnees = new BaseDeDonnees(); 
        $connexion = $baseDeDonnees->recupererConnexion(); 
        $compte = new Compte($connexion); 

        switch($methode) {
            case 'GET':
                // endpoint : localhost/BiblioPlaisir/api/Compte.php/{email}
                $email = recupererParametreSimple($_SERVER['REQUEST_URI']);
                $compteRecuperere = $compte->recupererCompte($email); 
                $compteRecuperere['message'] = "Compte trouvé"; 

                if($compteRecuperere) {
                    echo json_encode($compteRecuperere, JSON_PRETTY_PRINT);
                    http_response_code(200); 
                }
                else {
                    echo json_encode([
                        'message' => "Aucun compte ne correspond à cette adresse email"
                    ], JSON_PRETTY_PRINT); 
                }
                break;
            case 'PUT':
                // endpoint : localhost/BiblioPlaisir/api/Compte.php/{id} 
                $id = recupererParametreSimple($_SERVER['REQUEST_URI']); 
                $nouveauDonnees = json_decode(file_get_contents('php://input'), true); 
                $compteModifie = $compte->modifier($id, $nouveauDonnees); 

                if($compteModifie) {
                    echo json_encode([
                        'message' => "Modification effectué"
                    ], JSON_PRETTY_PRINT);
                    http_response_code(200); 
                }
                else {
                    echo json_encode([
                        'message' => "Erreur de modification" 
                    ], JSON_PRETTY_PRINT); 
                }
                break; 
            case 'POST':
                // endpoint : POST localhost/BiblioPlaisir/api/Compte.php
                $donneesNouveauCompte = json_decode(file_get_contents('php://input'), true);
                $nouveauCompte = $compte->creer($donneesNouveauCompte); 

                if($nouveauCompte) {
                    echo json_encode([
                        'message' => "Compte créé avec succès"
                    ], JSON_PRETTY_PRINT); 
                }
                else {
                    echo json_encode([
                        'message' => "Erreur de création du compte"
                    ], JSON_PRETTY_PRINT); 
                } 
                break; 
            case 'DELETE': 
                // endpoint : DELETE localhost/BiblioPlaisir/api/Compte.php/{id}
                $id = recupererParametreSimple($_SERVER['REQUEST_URI']); 
                $compteSupprime = $compte->supprimer($id); 

                if($compteSupprime) {
                    echo json_encode([
                        'message' => "Compte supprimé"
                    ], JSON_PRETTY_PRINT); 
                }
                else {
                    echo json_encode([
                        'message' => "Erreur de suppression du compte"
                    ], JSON_PRETTY_PRINT);
                }
                break;
        }
    }
    else {
        echo json_encode([
            'message' => "Cette méthode ne fait pas partie du standard du REST"
        ], JSON_PRETTY_PRINT); 
    }
?>