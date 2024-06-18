<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require_once('../model/BaseDeDonnees.php'); 

        $base_de_donnee = new BaseDeDonnees(); 
        $connexion = $base_de_donnee->recupererConnexion(); 

        $id_auteur = strip_tags($_POST['id_auteur']);
        $titre = strip_tags($_POST['titre']);
        $nombre_page = strip_tags($_POST['nombre_page']);
        $editeur = strip_tags($_POST['editeur']);
        $genre = strip_tags($_POST['genre']);
        $resumer = strip_tags($_POST['resumer']);
        $classe_age = strip_tags($_POST['classe_age']);
        $chemin = $_FILES['chemin'];

        // Vérification du fichier photo de couverture
        $photo_couverture = $_FILES['photo_couverture'];
        $image_autorise = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($photo_couverture['type'], $image_autorise)) {
            echo json_encode(["message" => "Le fichier de la photo de couverture doit être une image (JPEG, PNG, GIF)"]);
            exit;
        }

        // Vérification du fichier PDF
        $livre_autorise = 'application/pdf';
        if ($chemin['type'] !== $livre_autorise) {
            echo json_encode(["message" => "Le fichier doit être un PDF"]);
            exit;
        }

        // Définir les chemins de destination pour les fichiers uploadés
        $chemin_upload = "../uploads/";
        $chemin_photo_couverture = $chemin_upload . basename($photo_couverture["name"]);
        $chemin_livre = $chemin_upload . basename($chemin["name"]);

        if (move_uploaded_file($photo_couverture["tmp_name"], $chemin_photo_couverture) && move_uploaded_file($chemin["tmp_name"], $chemin_livre)) {
            // Préparation et exécution de la requête SQL pour insérer les données
            $sql = "INSERT INTO Livre(
                                    id_auteur, 
                                    titre, 
                                    nombre_page, 
                                    editeur, genre, 
                                    photo_couverture, 
                                    resumer, 
                                    classe_age, 
                                    chemin) 
                    VALUES (
                                    :id_auteur, 
                                    :titre, 
                                    :nombre_page, 
                                    :editeur, 
                                    :genre, 
                                    :photo_couverture, 
                                    :resumer, 
                                    :classe_age, 
                                    :chemin
                    )";

            $stmt = $connexion->prepare($sql);
            $stmt->bindParam(':id_auteur', $id_auteur);
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':nombre_page', $nombre_page);
            $stmt->bindParam(':editeur', $editeur);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':photo_couverture', $chemin_photo_couverture);
            $stmt->bindParam(':resumer', $resumer);
            $stmt->bindParam(':classe_age', $classe_age);
            $stmt->bindParam(':chemin', $chemin_livre);

            if ($stmt->execute()) {
                echo json_encode([
                    "message" => "Livre ajouté avec succès"
                ], JSON_PRETTY_PRINT);
            } else {
                echo json_encode([
                    "message" => "Erreur lors de l'ajout du livre"
                ], JSON_PRETTY_PRINT);
            }
        } 
        else {
            echo json_encode([
                "message" => "Erreur lors de l'upload des fichiers"
            ], JSON_PRETTY_PRINT);
        }
    } 
    else {
        echo json_encode([
            "message" => "Requête non valide"
        ], JSON_PRETTY_PRINT);
    }
    
?>
