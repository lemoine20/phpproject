
<?php


require_once("../html/header.html");
require_once("../php/database.php");


try{
  $dbCnx = new PDO($mysqlDsn,$myUserDb,$myPwdDb);
}catch(PDOException $e){
  echo "Connexion échouée : ".$e->getMessage();
  exit;
}
echo "<a href = ../index.php class='btn btn-primary btn-block'>Page Principale</a>";
echo $_POST["fichier"];
?>
<!-- <buttton><a href='index.php'>Page Principale</a></button><br> -->

<table class="table">
  <thead>
    <tr>

      <td scope="col">Date </td>
      <td scope="col">Corde</td>
      <td scope="col">Nombre de points</td>
      <td scope="col">Libelle</td>
      <td scope="col">Tmax en %</td>
      <td scope="col">Tmax en mm</td>
      <td scope="col">Fmax en %</td>
      <td scope="col">Fmax en mm</td>

    </tr>
  </thead>
  <tbody>
    <?php
    $tmax_mm =($_POST["tmax_p"]/100)*$_POST["corde"];
    $fmax_mm =($_POST["fmax_p"]/100)*$_POST["corde"];

    echo "<td> ".$_POST["date1"]."</td>";
    echo "<td> ".$_POST["corde"]."</td>";
    echo "<td> ".$_POST["nb_point"]."</td>";
    echo "<td> ".$_POST["libelle"]."</td>";
    echo "<td> ".$_POST["tmax_p"]."</td>";
    echo "<td> ".$tmax_mm."</td>";
    echo "<td> ".$_POST["fmax_p"]."</td>";
    echo "<td> ".$fmax_mm."</td>";
    echo "</tr>";

    ?>
  </tbody>
</table>

<?php
$validate = 0;
$sth2 = $dbCnx->prepare("SELECT * FROM parametre ");
$sth2->execute();
$parametres = $sth2->fetchAll(PDO::FETCH_CLASS,'Parametre');

$length = 78;
$date1 = $_POST["date1"];
$corde = $_POST["corde"];
$tmax_p =$_POST["tmax_p"];
$fmax_p = $_POST["fmax_p"];
$nb_point = $_POST["nb_point"];
$libelle =$_POST["libelle"];

foreach ($parametres as $parametre) {
  if (strnatcmp ( $libelle, $parametre->getLibelle() ) == 0 ) {
    $validate = 1;
    break;
  }
}

if ($validate == 0) {
sql_requete("INSERT INTO parametre (date_ajout,corde,tmax_p,tmax_mm,fmax_p,fmax_mm,nb_point,libelle)
                        VALUES ('$date1',$corde,$tmax_p,$tmax_mm,$fmax_p,$fmax_mm,$nb_point,'$libelle')",$mysqlDsn,$myUserDb,$myPwdDb);

$parametres = sql_requete("SELECT * FROM parametre ",$mysqlDsn,$myUserDb,$myPwdDb);

$id_recover = $parametres[sizeof($parametres)-1]->getId();

$parametres = sql_requete("SELECT * FROM parametre WHERE id=$id_recover",$mysqlDsn,$myUserDb,$myPwdDb);


$Xpos = 0;
$corde =$parametre[0]->getCorde();
$XposIni= $corde/$parametre[0]->getNb_point();
$sommedSiXgi = 0;
$sommeDsi=0;


for ($i=0; $i <= $parametre[0]->getNb_point(); $i++) {

  $valeurCalculer = ($Xpos/$corde);
  $Cambrure = -4*(pow($valeurCalculer,2)-$valeurCalculer)*$parametre[0]->getFmax_mm();
  $epaisseur = -(1.015*(pow($valeurCalculer,4))-2.843*(pow($valeurCalculer,3))+3.516*(pow($valeurCalculer,2))+1.26*($valeurCalculer)-2.969*(pow($valeurCalculer,0.5)))*$parametre[0]->getTmax_mm();
  $Xintrados = $Cambrure-$epaisseur/2;
  $Xextrados = $Cambrure+$epaisseur/2;
  $EpaisseurMoy = ($Xextrados-$Xintrados)/2;
  $Xgi = $Xpos/2;
  $Dsi = $Xpos + $EpaisseurMoy;
  $Sixgi = $Dsi * $Xgi;
  $sommedSiXgi = $sommedSiXgi + $Sixgi;
  $sth4 = $dbCnx->prepare("INSERT INTO cambrure (x,t,f,yintra,yextra,igx,id_parametre)
  VALUES ($Xpos,$epaisseur,$Cambrure,$Xintrados,$Xextrados,$Xgi,$id_recover)");

  try {
    $sth4->execute();

  } catch (Exception $e) {
    echo $e;
  }
  $Xpos =$XposIni+$Xpos;
}
  echo "<p class='text-center'>Ajouter à la base de données</p>";
  echo "<a href = ../index.php class='btn btn-success btn-block'>OK</a>";
}else {
  echo "<p class='text-center'>Ce libelle est déja existant</p>";
  echo "<a href = ajout_data.php class='btn btn-danger btn-block'>Retour</a>";
}

?>
</form>


<?php
require_once("../html/footer.html");
?>
