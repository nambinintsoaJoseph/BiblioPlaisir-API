<h2>Point de terminaison REST</h2>

<h3>Compte</h3>

<hr>

- <span style="color: #EF4;">GET localhost/BiblioPlaisir/api/Compte.php/{email}</span> :
Récupère les informations d'un compte selon le paramètre {email}

```raw
GET localhost/BiblioPlaisir/api/Compte.php/raznambinintsoa3@gmail.com
```

Reponse (JSON): 
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

En cas de la réussite de la requête, voici le code JSON qui sera renvoyé : 

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

Reponse (JSON) si le compté est crée : 

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

Si la suppression fonctionne, la reponse en JSON est : 

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