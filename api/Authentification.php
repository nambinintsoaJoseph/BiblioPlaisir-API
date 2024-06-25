<?php 
    
    header("Access-Control-Allow-Origin: *"); 
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 
    
    require '../model/JWTManagement.php'; 
    $methode = $_SERVER['REQUEST_METHOD']; 

    if($methode == 'POST') {

        require_once('../model/BaseDeDonnees.php'); 
        require_once('../model/Compte.php'); 
        require_once('../model/Lecteur.php'); 

        $base_de_donnees = new BaseDeDonnees(); 
        $connexion = $base_de_donnees->recupererConnexion(); 
        $compte = new Compte($connexion);

        // On récupère les données d'authentification : 
        $donneesAuthentification = json_decode(file_get_contents('php://input'), true);

        // On récupère le compte correspond à l'email : 
        $informationsCompte = $compte->recupererCompte($donneesAuthentification['email']); 
        
        if(password_verify($donneesAuthentification['mot_de_passe'], $informationsCompte['mot_de_passe'])) { 
         
            if($informationsCompte['type_compte'] == 'lecteur') {
                $lecteur = new Lecteur($connexion); 
                $id_lecteur = $lecteur->recupererIdLecteur($informationsCompte['id_compte']); 
                
                $payload = array(
                    "iss" => "localhost/BiblioPlaisir",
                    "iat" => time(),
                    "nbf" => time(),
                    "exp" => time() + 7200, // Le token expire dans 2 heure
                    "data" => array(
                        "id_compte" => $informationsCompte['id_compte'], 
                        "id_lecteur" => $id_lecteur['id_lecteur'], 
                        "type_compte" => $informationsCompte['type_compte']
                    )
                ); 
            }
            else if ($informationsCompte['type_compte'] == 'auteur') {
                // on récupère l'id de l'auteur
            } else {
                // on recupère l'id de l'administrateur 
            }
            
            
            $jwt = new JWTManagement('BiblioPlaisir'); 
            $token = $jwt->genererToken($payload); 
            echo json_encode([
                "validation" => true,
                "token" => $token
            ]); 
            http_response_code(200); 

            print_r($jwt->decoderToken($token)); 
            
        }
        else {
            echo json_encode([
                "validation" => false, 
            ]);
            http_response_code(401); 
        }

    }
    else {
        echo json_encode([
            "message" => "L'utilisation de la méthode POST est obligatoire"
        ], JSON_PRETTY_PRINT); 
    }
?>