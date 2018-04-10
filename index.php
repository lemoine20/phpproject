<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PROJET PHP</title>
  </head>
  <body>
        <h1>PROJET PHP</h1>



        <?php

        require_once("database.php");



        try{
          $dbCnx = new PDO($mysqlDsn,$myUserDb,$myPwdDb);
        }catch(PDOException $e){
          echo "Connexion échouée : ".$e->getMessage();
          exit;
        }

        $sth = $dbCnx->prepare("SELECT * FROM parametre");
        $sth->execute();
        $parametre = $sth->fetchAll(PDO::FETCH_CLASS,'Parametre');
        print_r($parametre);

        ?>

        <table border="1">

          <tr>
            <td>ID</td>
            <td> Date </td>
            <td> Corde</td>
            <td> Libelle</td>
            <td>  Tmax %</td>
            <td>Libelle</td>
          </tr>
          <?php
          foreach ($parametre as $parametres) {
            echo "<tr><td> ".$parametres->getId() ."</td><td> ". $parametres->getDate_ajout()."</td><td> ".$parametres->getCorde()."</td><td> ".$parametres->Getlibelle()."</td><td> ".$parametres->getTmax_p()."</td></tr>";
          }
          ?>

        </table>


      <!--  <img src="http://latex.codecogs.com/gif.latex?\dpi{100}&space;\fn_jvn&space;\tiny&space;F&space;=&space;-(1.015*\frac{X}{Corde})^4&plus;&space;(2.843*\frac{X}{Corde})^3&plus;&space;(3.516*\frac{X}{Corde})^2&plus;&space;(1.26*\frac{X}{Corde})-&space;(2.969*\frac{X}{Corde})^{0.5}*&space;Tmax_{mm}" title="\tiny F = -(1.015*\frac{X}{Corde})^4+ (2.843*\frac{X}{Corde})^3+ (3.516*\frac{X}{Corde})^2+ (1.26*\frac{X}{Corde})- (2.969*\frac{X}{Corde})^{0.5}* Tmax_{mm}" />
      -->
  </body>
</html>
