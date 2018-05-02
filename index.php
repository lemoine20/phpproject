<?php
require_once("html/header_index.html");
require_once("php/database.php");


try{
    $dbCnx = new PDO($mysqlDsn,$myUserDb,$myPwdDb);
}catch(PDOException $e){
    echo "Connexion échouée : ".$e->getMessage();
    exit;
}
echo "<a href = 'page/ajout_data.php' type='button' class='btn btn-success btn-block'>Ajouté</a><br>";

$sth = $dbCnx->prepare("SELECT * FROM parametre");
$sth->execute();
$parametres = $sth->fetchAll(PDO::FETCH_CLASS,'Parametre');
?>

<br>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Libelle</th>
            <th scope="col">Date </th>
            <th scope="col">Corde</th>
            <th scope="col">Nombre de points</th>
            <th scope="col">Tmax %</th>
            <th scope="col">Fmax %</th>
            <th scope="col">Voir Graphique</th>
            <th scope="col">Suppression</th>
            <th scope="col">Modification</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach ($parametres as $parametre) {
        echo "<td> ".$parametre->Getlibelle()."</td>";
        echo "<td> ". $parametre->getDate_ajout()."</td>";
        echo "<td> ".$parametre->getCorde()."</td>";
        echo "<td> ".$parametre->getNb_point()."</td>";
        echo "<td> ".$parametre->getTmax_p()."</td>";
        echo "<td> ".$parametre->getFmax_p()."</td>";
        echo "<td><form action='page/graph.php' method='post'>
        <input type='text' name='id_recover' value='".$parametre->getId()."' hidden>
        <input type='submit' type='button' name='Graphique' value='Voir Graphique' class='btn btn-primary'></form></td>";

        echo "<td><form action='page/suppression.php' method='post'>
        <input type='text' name='id_recover2' value='".$parametre->getId()."' hidden>
        <input type='submit' type='button' name='Suppression' value='delete' class='btn btn-primary'></form></td>";

        echo "<td><form action='page/modification.php' method='post'>
        <input type='text' name='id_recover3' value='".$parametre->getId()."' hidden>
        <input type='submit' name='modif' type='button' value='modifier' class='btn btn-primary'></form></td>";
        echo "</tr>";

      }
      ?>
  </tbody>
</table>

<?php
    require_once("html/footer_index.html");
?>
