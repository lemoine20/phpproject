<?php
    require_once("../html/header.html");


    require_once("../php/database.php");
    try{
        $dbCnx = new PDO($mysqlDsn,$myUserDb,$myPwdDb);
    }catch(PDOException $e){
        echo "Connexion échouée : ".$e->getMessage();
        exit;
    }

    $id_recover = intval($_POST['id_recover2']);
    $corde = intval($_POST['corde']);
    $sth = $dbCnx->prepare("SELECT * FROM parametre WHERE id='".$id_recover."'");
    $sth->execute();
    $parametre = $sth->fetchAll(PDO::FETCH_CLASS,'Parametre');

?>

    <buttton><a href='index.php'>Page Principale</a></button><br>
    <form  method="post" action="suppression.php">
        <div class="form-group">
            <?php
                $id_recover = intval($_POST['id_recover2']);
                $sth = $dbCnx->prepare("SELECT * FROM parametre WHERE id='".$id_recover."'");
                $sth->execute();
                $parametre = $sth->fetchAll(PDO::FETCH_CLASS,'Parametre');

            ?>
            <table class="table">
            <thead>
              <tr>
                <td scope="col">ID</td>
                <td scope="col">Corde</td>
                <td scope="col">Nombre de points</td>
                <td scope="col">Libelle</td>
                <td scope="col">Tmax %</td>
                <td scope="col">Fmax %</td>
              </tr>
            </thead>
            <tbody>
            <?php
                echo "<tr><th scope='row'> ".$id_recover."</th>";
                echo "<td> ".$parametre[0]->getCorde()."</td>";
                echo "<td> ".$parametre[0]->getNb_point()."</td>";
                echo "<td> ".$parametre[0]->Getlibelle()."</td>";
                echo "<td> ".$parametre[0]->getTmax_p()."</td>";
                echo "<td> ".$parametre[0]->getFmax_p()."</td>";
                echo "</tbody></table>";
            ?>
        </div>
    </form>
    <p>Voulez vous supprimer cette ligne?</p>

    <?php
    echo "<form action='supp2.php' method='post'>";
    echo "<input type='text' name='id_recover' value='".$parametre[0]->getId()."' hidden>";
    echo "<input type='submit' name='submit' value='Valider' class='btn btn-primary'></form>";
    echo "<form action='index.php' method='post'>";
    echo "<input type='submit' name='retour' value='Retour' class='btn btn-danger'></form>";
    ?>
    <?php
        require_once("../html/footer.html");
    ?>
