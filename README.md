<h2>Point de terminaison REST</h2>

<h3>Compte</h3>

<hr>

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
    "date_naissance": "2000-12-01",
    "photo": null,
    "date_inscription": "2024-06-05 19:59:28",
    "email": "raznambinintsoa3@gmail.com",
    "date_dernier_acces": "2024-06-05 19:57:58",
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
    "email": "testemail@test.com", 
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
	"nom": "test", 
	"prenom": "test", 
	"date_naissance": "2002-02-02", 
	"email": "test-test.com", 
	"mot_de_passe": "test"
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

BODY

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

<hr>

<h3>Lecteur</h3>

- <span style="color: #EF4;">GET localhost/BiblioPlaisir/api/Lecteur.php/{id}</span> : Récupère un lecteur par son id  

```raw
GET localhost/BiblioPlaisir/api/Lecteur.php/2
```

Reponse 
```json
{
    "id_lecteur": 2,
    "id_compte": 2
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

Reponse 

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

<hr>

<h3>Auteur</h3>

- <span style="color: #EF4;">GET localhost/BiblioPlaisir/api/Auteur.php/{id}</span> : Recuperer un auteur par son id

```raw
GET localhost/BiblioPlaisir/api/Auteur.php/{id}
```

Reponse JSON : 

```json
{
    "id_auteur": 2,
    "id_compte": 2
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

<hr>

<h3>Administrateur</h3>

- <span style="color: #EF4;">GET localhost/BiblioPlaisir/api/Administrateur.php/{id}</span> : Recuperer un administrateur par son id

```raw
GET localhost/BiblioPlaisir/api/Administrateur.php/{id}
```

Reponse JSON : 

```json
{
    "id_admin": 2,
    "id_compte": 2
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