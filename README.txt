O� mettre le dossier un fois t�l�charg� ?
-----------------------------------------

D�placez le dossier dans :
 
-Sous Linux:	/var/www/

-Windows : Work in progress

-IOS : Work in progress


O� modifier les modifier les constantes de la base de donn�es ?
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


Donner la permission d'�criture lecture, �criture, supr�ssion
-------------------------------------------------------------

Rentrer la commande dans votre terminale:

sudo chmod 777 Dossier-d-instalation


Support technique
-----------------

Contacter:
Yohann Dumortier : yohann.dumortier@isen-ouest.yncrea.fr
Samuel Nezou : samuel.nezou@isen-ouest.yncrea.fr

