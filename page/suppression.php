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

    <a href = 'index.php' class='btn btn-primary'>Page Principale</a><br>
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
    <div class="center-block">
        <p class='text-center'>Voulez vous supprimer cette ligne?</p>

            <?php
            echo "<form action='supp2.php' method='post'>";
            echo "<input type='text' name='id_recover' value='".$parametre[0]->getId()."' hidden>";
            echo "<input type='submit' name='submit' value='Valider' class='btn btn-primary btn-block'></form>";
            echo "<a href = 'index.php' type='button' class='btn btn-danger btn-block'>Retour</a>";
            ?>
        </div>
    </div>
    <?php
        require_once("../html/footer.html");
    ?>
