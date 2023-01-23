# Le Dinostore
## installation
Le Dinostore est une applcation php, il vous faudra un serveur php pour le faire fonctionner, utilisez votre favoris comme xamp par exemple.  
ensuite il vous faut mettre en place al base de donnée, pour se faire importez le fichier database/dinostore_database.sql dans une de vos table de MySql par exemple.
ensuite il faut le fichier components/database_server.php et le remplir avec vos informations tel que
```php
<?php
    $Server = ""; //database server
    $User =  ""; //user
    $Pwd = ""; //password
    $db = ""; //database name

    $database = new mysqli($Server,$User,$Pwd,$db);
?>
```
et voila vous êtes prêt à  lancer le dinostore
## limites de l'application
Il manque plusieurs chose à l'application (piste d'amélioration), tout d'abord une gestion des points de fidélité aprofondis, j'ai déja mis en place des trigger pour commencer et ai cherché à en faire d'autre (database/trigegrAimplémenter) et aussi une gestion plus complète des facture, modification et suppression des produits et enfin supression des utilisateurs ou commandes.