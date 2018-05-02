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

  echo "<a href = '../index.php' class='btn btn-info btn-block'>Retour</a>";
  $id_recover = $_POST['id_recover'];
  echo "<img src='"."../php/calcul_graph.php?var1=".$id_recover."'>";

  sql_requete_recup("cambrure","SELECT x,yintra,yextra,igx FROM cambrure WHERE id_parametre = $id_recover ",$mysqlDsn,$myUserDb,$myPwdDb);

  sql_requete_recup("parametre","SELECT libelle FROM parametre WHERE id = $id_recover ",$mysqlDsn,$myUserDb,$myPwdDb);


  echo "<a type='button' class='btn' href='"."../php/calcul_graph.php?var1=".$id_recover."' download= '".$parametres[0]->getLibelle()."'>Download png</a>";


  $chemin = '../fichier.csv';
  $delimiteur = ',';

  $fichier_csv = fopen($chemin, 'w+');
  fprintf($fichier_csv, chr(0xEF).chr(0xBB).chr(0xBF));

  $a = 0;
  foreach($cambrures as $cambrure){
    if($a == 0 ){
      $file = array('X','Yintra','Yextra','Igx');
    }else{
      $file = array($cambrure->getX(),$cambrure->getYintra(),$cambrure->getYextra(),$cambrure->getIgx());
    }
    $a = 1;
    fputcsv($fichier_csv, $file, $delimiteur);
  }
  fclose($fichier_csv);

  ?>
  <a href="../fichier.csv" type="button" class='btn' download> Download Csv</a>

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
      sql_requete("SELECT * FROM cambrure WHERE id_parametre = $id_recover ",$mysqlDsn,$myUserDb,$myPwdDb);

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
