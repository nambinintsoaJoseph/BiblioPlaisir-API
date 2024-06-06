<h2>Point de terminaison REST</h2>

<h3>Compte</h3>

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