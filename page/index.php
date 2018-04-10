<?php
require_once("../html/header.html");
echo "<buttton><a href='ajout_data.php'>ajout bdd</a></button><br>";

require_once("../php/database.php");

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

<?php
    require_once("../html/footer.html");
?>
