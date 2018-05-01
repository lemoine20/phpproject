<buttton><a href='index.php'>Page Principale</a></button><br>
<?php // content="text/plain; charset=utf-8"
require_once ('../jpgraph/src/jpgraph.php');
require_once ('../jpgraph/src/jpgraph_line.php');
require_once("../html/header.html");
require_once("../php/database.php");


require_once("../php/database.php");
    try{
        $dbCnx = new PDO($mysqlDsn,$myUserDb,$myPwdDb);
    }catch(PDOException $e){
        echo "Connexion échouée : ".$e->getMessage();
        exit;
    }

    $id_recover = $_POST['id_recover'];
    error_log($id_recover);
    echo "<img src='"."../php/calcul_graph.php?var1=".$id_recover."'>";






    $sth = $dbCnx->prepare("SELECT * FROM cambrure WHERE id_parametre = $id_recover ");
    $sth->execute();
    $cambrures = $sth->fetchAll(PDO::FETCH_CLASS,'Cambrure');



        // Paramétrage de l'écriture du futur fichier CSV
        $chemin = '/var/www/html/php/phpproject-master/fichier.csv';
        $delimiteur = ','; // Pour une tabulation, utiliser $delimiteur = "t";

        // Création du fichier csv (le fichier est vide pour le moment)
        // w+ : consulter http://php.net/manual/fr/function.fopen.php
        $fichier_csv = fopen($chemin, 'w+');

        // Si votre fichier a vocation a être importé dans Excel,
        // vous devez impérativement utiliser la ligne ci-dessous pour corriger
        // les problèmes d'affichage des caractères internationaux (les accents par exemple)
        fprintf($fichier_csv, chr(0xEF).chr(0xBB).chr(0xBF));

        // Boucle foreach sur chaque ligne du tableau
        foreach($cambrures as $cambrure){
        	// chaque ligne en cours de lecture est insérée dans le fichier
          print_r($cambrure);
          // les valeurs présentes dans chaque ligne seront séparées par $delimiteur
        	fputcsv($fichier_csv, array($cambrure), $delimiteur);
        }

        // fermeture du fichier csv
        fclose($fichier_csv);









 ?>
 <table class="table">
   <thead>
     <tr>
       <td scope="col">X </td>
       <td scope="col">T</td>
       <td scope="col">F</td>
       <td scope="col">Yintra</td>
       <td scope="col">Yextra</td>
       <td scope="col">igx</td>
     </tr>
   </thead>
   <tbody>
     <?php
     $sth = $dbCnx->prepare("SELECT * FROM cambrure WHERE id_parametre = $id_recover ");
     $sth->execute();
     $cambrures = $sth->fetchAll(PDO::FETCH_CLASS,'Cambrure');

     foreach ($cambrures as $cambrure) {
       echo "<tr>";
       echo "<td> ".$cambrure->getX()."</td>";
       echo "<td> ".$cambrure->getT()."</td>";
       echo "<td> ".$cambrure->getF()."</td>";
       echo "<td> ".$cambrure->getYintra()."</td>";
       echo "<td> ".$cambrure->getYextra()."</td>";
       echo "<td> ".$cambrure->getIgx()."</td>";
       echo "</tr>";
     }
     ?>
   </tbody>
 </table>

<?php
  require_once("../html/footer.html");
 ?>
