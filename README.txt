Où mettre le dossier un fois téléchargé ?
-----------------------------------------

Déplacez le dossier dans :
 
-Sous Linux:	/var/www/

-Windows : Work in progress

-IOS : Work in progress


Où modifier les modifier les constantes de la base de données ?
---------------------------------------------------------------

Dossierd-d-instalation/php/constants.php


 $mysqlServerIp = "127.0.0.1";
 $mysqlServerPort = "3306";
 $mysqlDbName = "nom de  votre bdd";
 $mysqlDbCharset = "UTF8";
 $mysqlDsn = "mysql:host=".$mysqlServerIp.";port=".$mysqlServerPort.";dbname=".
 $mysqlDbName.";charset=".$mysqlDbCharset.";";
 $myUserDb = 'nom Utilisateur de la bdd' ;
 $myPwdDb = 'mots de passe Utilisateur ' ;


Donner la permission d'écriture lecture, écriture, supréssion
-------------------------------------------------------------

Rentrer la commande dans votre terminale:

sudo chmod 777 Dossier-d-instalation


Support technique
-----------------

Contacter:
Yohann Dumortier : yohann.dumortier@isen-ouest.yncrea.fr
Samuel Nezou : samuel.nezou@isen-ouest.yncrea.fr

