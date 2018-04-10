<?php
require_once("../html/header.html");
require_once("../php/database.php");

echo "<buttton><a href='ajout_data.php'>ajout bdd</a></button><br>";

try{
  $dbCnx = new PDO($mysqlDsn,$myUserDb,$myPwdDb);
}catch(PDOException $e){
  echo "Connexion échouée : ".$e->getMessage();
  exit;
}

$sth = $dbCnx->prepare("SELECT * FROM parametre");
$sth->execute();
$parametre = $sth->fetchAll(PDO::FETCH_CLASS,'Parametre');


?>
<br>
<table class="table">
    <thead>
      <tr>
        <td scope="col">ID</td>
        <td scope="col"> Date </td>
        <td scope="col"> Corde</td>
        <td scope="col"> Libelle</td>
        <td scope="col">  Tmax %</td>
      </tr>
    </thead>
    <tbody>
  <?php
  foreach ($parametre as $parametres) {
    echo "<tr><td> ".$parametres->getId() ."</td><td> ". $parametres->getDate_ajout()."</td><td> ".$parametres->getCorde()."</td><td> ".$parametres->Getlibelle()."</td><td> ".$parametres->getTmax_p()."</td></tr>";
  }
  ?>
  </tbody>
</table>

<?php
    require_once("../html/footer.html");
?>
