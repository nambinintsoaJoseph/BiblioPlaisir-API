<h2>Point de terminaison REST</h2>

- <span style="color: #EF4;">GET localhost/BiblioPlaisir/api/Compte.php/{email}</span> :
Récupère les informations d'un compte selon le paramètre {email}

```raw
GET localhost/BiblioPlaisir/api/Compte.php/raznambinintsoa3@gmail.com

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