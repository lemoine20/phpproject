<?php
require_once("../html/header.html");
require_once("../php/database.php");

echo "<button class='btn btn-success'><a href='ajout_data.php'>ajout bdd</a></button><br>";

try{
  $dbCnx = new PDO($mysqlDsn,$myUserDb,$myPwdDb);
}catch(PDOException $e){
  echo "Connexion échouée : ".$e->getMessage();
  exit;
}

$sth = $dbCnx->prepare("SELECT * FROM parametre");
$sth->execute();
$parametres = $sth->fetchAll(PDO::FETCH_CLASS,'Parametre');
?>

<br>
<table class="table">
    <thead>
      <tr>
        <td scope="col">ID</td>
        <td scope="col">Date </td>
        <td scope="col">Corde</td>
        <td scope="col">Nombre de points</td>
        <td scope="col">Libelle</td>
        <td scope="col">Tmax %</td>
        <td scope="col">Fmax %</td>
        <td scope="col">Voir Graphique</td>
        <td scope="col">Suppression</td>
        <td scope="col">Modification</td>
      </tr>
    </thead>
    <tbody>
  <?php
  foreach ($parametres as $parametre) {
    echo "<tr><th scope='row'> ".$parametre->getId() ."</th>";
    echo "<td> ". $parametre->getDate_ajout()."</td>";
    echo "<td> ".$parametre->getCorde()."</td>";
    echo "<td> ".$parametre->getNb_point()."</td>";
    echo "<td> ".$parametre->Getlibelle()."</td>";
    echo "<td> ".$parametre->getTmax_p()."</td>";
    echo "<td> ".$parametre->getFmax_p()."</td>";
    echo "<td><form action='graph.php' method='post'>
    <input type='text' name='id_recover' value='".$parametre->getId()."' hidden>
    <input type='submit' name='Graphique' value='Voir Graphique' class='btn btn-primary'></form></td>";

    echo "<td><form action='index.php' method='post'>
    <input type='text' name='id_recover2' value='".$parametre->getId()."' hidden>
    <input type='submit' name='Suppression' value='delete' onclick=\"popup()\" class='btn btn-primary'></form></td>";

    echo "<td><form action='modification.php' method='post'>
    <input type='text' name='id_recover3' value='".$parametre->getId()."' hidden>
    <input type='submit' name='modif' value='modifier' class='btn btn-primary'></form></td>";
    echo "</tr>";

  }
  ?>
  </tbody>
</table>

<?php
    require_once("../html/footer.html");
?>
