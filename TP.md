# TP

## TP1
Créer un script qui lit un fichier "number.txt" avec des nombres (1 par ligne).  
Le script doit affiché la somme, la moyenne, la médiane ainsi que la liste des nombres triés par ordre décroissant.  
Exemple:  
Moyenne: 5
Médianne: 4
Somme: 10
Values: 5, 4, 3, 2, 1

## TP2
Créer un script qui permet de gérer un ensemble d'utilisateur dans un fichier JSON.  
Le script doit proposé l'ensemble des opérations CRUD en argument.  
Options:  
- list: Affiche un utilisateur par ligne
- add: Ajoute un utilisateur
- delete: Supprime un utilisateur
- update: Met à jour un utilisateur

*list* doit permettre de filter les utilisateurs selon les différents champs.  
`--name value --role value --age value --occupation value --id value --activated`
```
Ex: contact.php list --name Jo --role Admin
3 utilisateurs trouvés
ID Name Age Role Occupation Activated
14 Josianne 57 Admin Compta true
27 Joseph 35 Admin Dev false
90 Joseph 24 Admin Dev true
````
**add** doit permettre d'ajouter un utilisateur via option ou en demandant les champs si les options n'existent pas
```
Ex: contact.php add --name Karl --occupation Dev
Age: 34
Activated: 1
Role: Admin
Utilisateur #15 ajouté avec succès
```

**delete** doit supprimer un utilisateur selon son ID
```
Ex: contact.php delete 90
Utilisateur #90 supprimé avec succès
```
**update** doit mettre à jour un utilisateur en utilisant des options
```
Ex: contact.php update 90 --occupation "Tech lead"
Utilisateur #90 mis à jour
```

## TP3
Créer un script qui scrappe l'ensemble des images du site "https://www.galerie1809.com/".
A partir de la page principal se déplacer vers les pages "menu-item-160" et les "menu-item-161".
Le script doit créer automatiquement le dossier `images` dans lequel les sous-dossiers doivent porter le nom des liens en kebab-case.
Générer une base de donnée en JSON qui associe le lien de l'image, la page, le chemin du fichier.
```
Ex:
Dossiers:
images/les-oeuvres/1.png
images/nos-artistes/19.png

BDD:
[ {"url": "tartenpion.png", page: "les-oeuvres", "path": "./images/les-oeuvres/1.png"}, {...}]
```
