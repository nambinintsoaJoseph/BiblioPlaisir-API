<h2>Point de terminaison REST</h2>

<br>

<h3>Vocabulaire</h3>

- <span style="color: #EF4;">GET localhost/BiblioPlaisir/api/Vocabulaire.php/{mot}</span> : Récupère les défintions d'un mot en français.

```raw
GET localhost/BiblioPlaisir/api/Vocabulaire.php/ordinateur
```

Réponse JSON 
```json
{
    "mot": "ordinateur",
    "definition": {
        "definition1": "Qui ordonne, met en ordre.",
        "definition2": "Ordinant.",
        "definition3": "Machine électronique de traitement de l'information, capable de classer, calculer et mémoriser, exécutant à grande vitesse les instructions d'un programme."
    }
}
```

Sinon 
```json
{
    "message": "La méthode n'est pas autorisé"
}
```

<hr><br><br>

<h3>Compte</h3>


- <span style="color: #EF4;">GET localhost/BiblioPlaisir/api/Compte.php/{email}</span> :
Récupère les informations d'un compte selon le paramètre {email}

```raw
GET localhost/BiblioPlaisir/api/Compte.php/raznambinintsoa3@gmail.com
```

Réponse JSON : 
```json
{
    "id_compte": 1,
    "type_compte": "lecteur",
    "nom": "RAZANAKANAMBININTSOA",
    "prenom": "Joseph",
    "date_naissance": "2003-12-01",
    "photo": null,
    "date_inscription": "2024-06-05 19:59:28",
    "email": "raznambinintsoa3@gmail.com",
    "date_dernier_acces": "2024-06-05 22:57:58",
    "message": "Compte trouv\u00e9"
}
```

<hr>

- <span style="color: #EF4;">PUT localhost/BiblioPlaisir/api/Compte.php/{id}</span> : Modifier les informations d'un compte selon le paramètre {id}

```raw
PUT localhost/BiblioPlaisir/api/Compte.php/1
```

Body 

```json
{
    "nom": "Lucky", 
    "prenom": "Luck", 
    "date_naissance": "2010-04-04", 
    "email": "luckyluck@gmail.com", 
    "mot_de_passe": "LuckyLuck"
}
```

Réponse JSON

```json
{
    "message": "Modification effectué"
}
```

Sinon : 

```json
{
    "message": "Erreur de modification"
}
```

<hr>

- <span style="color: #EF4;">POST localhost/BiblioPlaisir/api/Compte.php</span> : Créer un nouveau compte 

```raw
POST localhost/BiblioPlaisir/api/Compte.php
```

Body 

```json
{
	"type_compte": "lecteur",
	"nom": "VEROHASINA", 
	"prenom": "Stéphanie Alice", 
	"date_naissance": "2002-02-02", 
	"email": "verohasina@gmail.com", 
	"mot_de_passe": "password"
}
```

Réponse JSON :

```json
{
    "message": "Compte créé avec succès"
}
```

Sinon 

```json
{
    "message": "Erreur de création du compte"
}
```

<hr>

- <span style="color: #EF4;">DELETE localhost/BiblioPlaisir/api/Compte.php/{id}</span> : Supprimer un compte

```raw
DELETE localhost/BiblioPlaisir/api/Compte.php/4
```

Réponse JSON : 

```json
{
    "message": "Compte supprimé"
}
```

sinon 

```json
{
    "message": "Erreur de suppression du compte"
}
```
<hr>
<br><br>

<h3>Vocabulaire</h3>

- <span style="color: #EF4;">GET localhost/BiblioPlaisir/api/Vocabulaire.php/lecteur/{id_lecteur}</span> : Récuperer tous les vocabulaires enregistrés par un lecteur. 

```raw
GET localhost/BiblioPlaisir/api/Vocabulaire.php/lecteur/3
```

Réponse JSON 

```json
[
    {
        "id_vocabulaire": 1,
        "id_lecteur": 3,
        "mot": "jouer",
        "definition_mot": "Se récréer, se divertir, s'amuser",
        "date_ajout": "2024-06-06 21:57:54"
    },
    {
        "id_vocabulaire": 2,
        "id_lecteur": 3,
        "mot": "exploiter",
        "definition_mot": "Faire valoir une chose, en tirer le profit du produit",
        "date_ajout": "2024-06-06 21:58:28"
    }
]
```

<hr>

- <span style="color: #EF4;">GET localhost/BiblioPlaisir/api/Vocabulaire.php/{id_vocabulaire}</span> : Récuperer un vocabulaire par son id

```raw
GET localhost/BiblioPlaisir/api/Vocabulaire.php/2
```

Réponse JSON : 

```json
{
    "id_vocabulaire": 2,
    "id_lecteur": 3,
    "mot": "exploiter",
    "definition_mot": "Faire valoir une chose, en tirer le profit du produit",
    "date_ajout": "2024-06-06 21:58:28"
}
```

- <span style="color: #EF4;">POST localhost/BiblioPlaisir/api/Vocabulaire.php</span> : Ajouter un vocabulaire 

```raw
POST localhost/BiblioPlaisir/api/Vocabulaire.php
```

Body

```json
{
	"id_lecteur": "3", 
    "mot": "thermos", 
    "definition_mot": "Récipient isolant conservant la température d'un liquide pendant quelques heures."
}
```

Réponse JSON : 

```json
{
    "message": "Nouveau vocabulaire ajouté"
}
```

Sinon 

```json
{
    "message": "Erreur d'ajout du vocabulaire"
}
```

<hr>

- <span style="color: #EF4;">DELETE localhost/BiblioPlaisir/api/Vocabulaire.php/{id_vocabulaire}</span> : Supprimer un vocabulaire par son id 

```raw
DELETE localhost/BiblioPlaisir/api/Vocabulaire.php/3
```

Reponse JSON : 

```json
{
    "message": "Vocabulaire supprimé"
}
```

Sinon 

```json
{
    "message": "Erreur de suppression du vocabulaire"
}
```

<hr> <br><br>

<h3>Collection_livre</h3>

- <span style="color: #EF4;">GET localhost/BiblioPlaisir/api/Collection_livre.php/{id_collection}</span> : Récupère une collection par son id

```raw
GET localhost/BiblioPlaisir/api/Collection_livre.php/4
```

Réponse JSON 

```json
{
    "date_collection": "2024-06-07 10:47:56",
    "titre": "Mitaraina ny tany",
    "nombre_page": 258,
    "photo_couverture": "/upload/mitaraina_ny_tany.jpg",
    "chemin": "/upload/book/mitaraina_ny_tany.pdf",
    "nom_auteur": "ANDRAINA",
    "prenom_auteur": "Andry"
}
```
<hr>

- <span style="color: #EF4;">GET localhost/BiblioPlaisir/api/Collection_livre.php/lecteur/{id_lecteur}</span> : Récupérer toutes les collections de livres d'un lecteur 

```raw
GET localhost/BiblioPlaisir/api/Collection_livre.php/lecteur/{id_lecteur}
```

Réponse JSON 
```json
[
    {
        "id_collection": 1,
        "date_collection": "2024-06-07 10:47:56",
        "titre": "Mitaraina ny tany",
        "nombre_page": 258,
        "nombre_page_lu": 12,
        "photo_couverture": "/upload/mitaraina_ny_tany.jpg",
        "chemin": "/upload/book/mitaraina_ny_tany.pdf",
        "nom_auteur": "ANDRAINA",
        "prenom_auteur": "Andry"
    },
    {
        "id_collection": 4,
        "date_collection": "2024-06-07 11:23:23",
        "titre": "Vakivakim-piainana",
        "nombre_page": 75,
        "nombre_page_lu": 15,
        "photo_couverture": "/upload/vakivakim_piainana.jpg",
        "chemin": "/upload/book/vakivakim_piainana.pdf",
        "nom_auteur": "Irilanto Patrick",
        "prenom_auteur": "ANDRIAMANGATIANA"
    }
]
```

- <span style="color: #EF4;">POST localhost/BiblioPlaisir/api/Collection_livre.php</span> : Ajouter un livre à la collection

```raw
POST localhost/BiblioPlaisir/api/Collection_livre.php
```

Body 

```json
{
	"id_livre": 3, 
    "id_lecteur": 1 
}
```
Réponse JSON 

```json
{
    "message": "Livre ajouté à la collection"
}
```

Sinon 

```json
{
    "message": "Erreur d'ajour du livre à la collection"
}
```

<hr>

- <span style="color: #EF4;">PUT localhost/BiblioPlaisir/api/Collection_livre.php</span> : Modifier le nombre de page lu pour un livre

```raw
PUT localhost/BiblioPlaisir/api/Collection_livre.php
```

Body 

```raw
{
    "id_collection": 1, 
    "nombre_page_lu": 15
}
```

Réponse JSON 

```json
{
    "message": "Collection à jour"
}
```
Sinon 

```json
{
    "message": "Erreur de la mise à jour de la collection"
}
```

<hr>

- <span style="color: #EF4;">DELETE localhost/BiblioPlaisir/api/Collection_livre.php/{id_collection}</span> : Supprimer un livre à la collection 

```raw
DELETE localhost/BiblioPlaisir/api/Collection_livre.php/5
```

Réponse JSON : 
```json
{
    "message": "Livre supprimé de votre collection"
}
```

Sinon 

```json
{
    "message": "Une erreur est survenue lors de la suppression du livre de votre collection"
}
```

<hr><br><br>

<h3>Commentaire</h3>

- <span style="color: #EF4;">GET localhost/BiblioPlaisir/api/Commentaire.php/{id_commentaire}</span> : Récuperer un commentaire par son id

```raw
GET localhost/BiblioPlaisir/api/Commentaire.php/2
```

Réponse JSON 

```json
{
    "id_commentaire": 1,
    "id_lecteur": 1,
    "id_livre": 2,
    "texte_commentaire": "Bon livre",
    "date_commentaire": "2024-06-07 20:28:16"
}
```

<hr>

- <span style="color: #EF4;">GET localhost/BiblioPlaisir/api/Commentaire.php/livre/{id_livre}</span> : Récuperer les commentaires d'un livre

```raw
GET localhost/BiblioPlaisir/api/Commentaire.php/livre/2
```

Réponse JSON :

```json
[
    {
        "id_compte": 1,
        "nom": "RAZANAKANAMBININTSOA",
        "prenom": "Joseph",
        "photo": null,
        "texte_commentaire": "Bon livre",
        "date_commentaire": "2024-06-07 20:28:16"
    },
    {
        "id_compte": 4,
        "nom": "Jean",
        "prenom": "Pierre",
        "photo": null,
        "texte_commentaire": "Tsara be",
        "date_commentaire": "2024-06-07 22:28:32"
    }
]
```
<hr>

- <span style="color: #EF4;">POST localhost/BiblioPlaisir/api/Commentaire.php</span> : Ajouter un nouveau commentaire

```raw
POST localhost/BiblioPlaisir/api/Commentaire.php
```

Body 
```json
{
    "id_lecteur": "2",
    "id_livre": "2",
    "texte_commentaire": "J'adore"
}    
```

Réponse JSON 
```json
{
    "message": "Le commentaire a été ajouté"
}
```

Sinon 
```json
{
    "message": "Erreur d'ajout du commentaire"
}
```

<hr>

- <span style="color: #EF4;">DELETE localhost/BiblioPlaisir/api/Commentaire.php/{id_commentaire}</span> : Supprimer un commentaire

```raw
DELETE localhost/BiblioPlaisir/api/Commentaire.php/3
```

Réponse JSON 
```json
{
    "message": "Commentaire supprimé"
}
```

Sinon 

```json
{
    "message": "Erreur de suppression du commentaire"
}
```

<hr><br><br>

<h3>Lecteur</h3>

- <span style="color: #EF4;">GET localhost/BiblioPlaisir/api/Lecteur.php/{id}</span> : Récupère un lecteur par son id  

```raw
GET localhost/BiblioPlaisir/api/Lecteur.php/2
```

Reponse 
```json
{
    "id_compte": 1,
    "nom": "RAZANAKANAMBININTSOA",
    "prenom": "Joseph",
    "date_naissance": "2003-12-01",
    "photo": null,
    "date_inscription": "2024-06-07 10:26:34",
    "email": "raznambinintsoa3@gmail.com",
    "date_dernier_acces": "2024-06-05 22:57:58"
}
```

ou 
```json
{
    "message": "Aucun lecteur trouvé"
}
```

<hr>

- <span style="color: #EF4;">POST localhost/BiblioPlaisir/api/Lecteur.php</span> : Ajouter un nouveau lecteur 

```raw
POST localhost/BiblioPlaisir/api/Lecteur.php
```

Body
```json
{
    "id_compte": "3"
}
```

Reponse (JSON) si le lecteur est ajouté : 

```json
{
    "message": "Lecteur ajouté"
}
```

Sinon 

```json
{
    "message": "Erreur d'ajout du lecteur"
}
```

<hr>

- <span style="color: #EF4;">DELETE localhost/BiblioPlaisir/api/Lecteur.php/{id}</span> : Supprimer un lecteur par son id 

```raw
DELETE localhost/BiblioPlaisir/api/Lecteur.php/{id}
```

Réponse JSON

```json
{
    "message": "Lecteur supprimé avec succès"
}
```

ou bien 

```json
{
    "message": "Erreur de suppression du lecteur"
}
```


<hr><br><br>

<h3>Auteur</h3>

- <span style="color: #EF4;">GET localhost/BiblioPlaisir/api/Auteur.php/{id}</span> : Recuperer un auteur par son id

```raw
GET localhost/BiblioPlaisir/api/Auteur.php/{id}
```

Reponse JSON : 

```json
{
    "id_compte": 2,
    "nom": "Paul",
    "prenom": "Jean",
    "date_naissance": "1954-06-09",
    "photo": null,
    "date_inscription": "2024-06-07 10:28:51",
    "email": "jean@gmail.com",
    "date_dernier_acces": "2024-06-07 10:27:59"
}
```

ou bien 

```json
{
    "message": "Aucun auteur trouvé"
}
```

<hr>

- <span style="color: #EF4;">POST localhost/BiblioPlaisir/api/Auteur.php/{id}</span> : Créer un auteur

```raw
POST localhost/BiblioPlaisir/api/Auteur.php
```

Body 

```json
{
	"id_compte": 7
}
```

Reponse JSON 

```json
{
    "message": "Auteur ajouté"
}
```

ou bien 

```json
{
    "message": "Erreur d'ajout de l'auteur"
}
```
<hr>

- <span style="color: #EF4;">DELETE localhost/BiblioPlaisir/api/Auteur.php/{id}</span> : Supprimer un auteur par son id

```raw
DELETE localhost/BiblioPlaisir/api/Auteur.php/{id}
```

```json
{
    "message": "Auteur supprimé avec succès"
}
```
ou bien 

```json
{
    "message": "Erreur de suppression du l'auteur"
}
```

<hr> <br><br>

<h3>Administrateur</h3>

- <span style="color: #EF4;">GET localhost/BiblioPlaisir/api/Administrateur.php/{id}</span> : Recuperer un administrateur par son id

```raw
GET localhost/BiblioPlaisir/api/Administrateur.php/{id}
```

Reponse JSON : 

```json
{
    "id_compte": 3,
    "nom": "Admin",
    "prenom": "",
    "date_naissance": "1999-06-04",
    "photo": null,
    "email": "admin@gmail.com",
}
```

ou bien 

```json
{
    "message": "Aucun administrateur trouvé"
}
```

<hr>

- <span style="color: #EF4;">POST localhost/BiblioPlaisir/api/Administrateur.php</span> : Créer un administrateur

```raw
POST localhost/BiblioPlaisir/api/Administrateur.php
```

Body 

```json
{
	"id_compte": 7
}
```

Reponse JSON 

```json
{
    "message": "Administrateur ajouté"
}
```

ou bien 

```json
{
    "message": "Erreur d'ajout de l'administrateur"
}
```

<hr>

- <span style="color: #EF4;">DELETE localhost/BiblioPlaisir/api/Administrateur.php/{id}</span> : Supprimer un administrateur par son id

```raw
DELETE localhost/BiblioPlaisir/api/Administrateur.php/{id}
```

```json
{
    "message": "Administrateur supprimé avec succès"
}
```
ou bien 

```json
{
    "message": "Erreur de suppression du l'administrateur"
}
```