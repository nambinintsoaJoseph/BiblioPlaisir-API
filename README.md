<h2>Point de terminaison REST</h2>

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

- <span style="color: #EF4;">PUT localhost/BiblioPlaisir/api/Compte.php/{id}</span> : 

```raw
PUT localhost/BiblioPlaisir/api/Compte.php/1
```

Body 

```json
{
    "nom": "Lucky", 
    "prenom": "Luck", 
    "date_naissance": "2010-04-04", 
    "photo": null, 
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