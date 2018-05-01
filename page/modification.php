<?php
    require_once("../html/header.html");


    require_once("../php/database.php");
    try{
        $dbCnx = new PDO($mysqlDsn,$myUserDb,$myPwdDb);
    }catch(PDOException $e){
        echo "Connexion échouée : ".$e->getMessage();
        exit;
    }
?>

<a href = 'index.php' class='btn btn-primary btn-block'>Page Principale</a><br>
<form  method="post" action="controle.php">
    <div class="form-group">
        <?php
            $id_recover = intval($_POST['id_recover3']);
            $sth = $dbCnx->prepare("SELECT * FROM parametre WHERE id='".$id_recover."'");
            $sth->execute();
            $parametre = $sth->fetchAll(PDO::FETCH_CLASS,'Parametre');

        ?>
        <table class="table">
        <thead>
          <tr>
            <th scope="col">Corde</th>
            <th scope="col">Nombre de points</th>
            <th scope="col">Libelle</th>
            <th scope="col">Tmax %</th>
            <th scope="col">Fmax %</th>
          </tr>
        </thead>
        <tbody>
        <?php
            echo "<td> ".$parametre[0]->getCorde()."</td>";
            echo "<td> ".$parametre[0]->getNb_point()."</td>";
            echo "<td> ".$parametre[0]->Getlibelle()."</td>";
            echo "<td> ".$parametre[0]->getTmax_p()."</td>";
            echo "<td> ".$parametre[0]->getFmax_p()."</td>";
            echo "</tbody></table>";
        ?>

        Corde (en mm) : <input type="number" class="form-control" min="0" name="corde" value=""/>
        <br>
        Nombre de points : <input type="number" class="form-control" min="0" name="nb_point" value=""/>
        <br>
        libelle : <input type="text" class="form-control" name="libelle" value=""/>
        <br>
        Tmax (%) : <input type="number" class="form-control" max="100" min ="0" name="tmax_p" value=""/>
        <br>
        Fmax (%) : <input type="number" class="form-control" max="100" min ="0" name="fmax_p" value=""/>
        <br>
        <?php echo "<input type='text' name='id_recover' value='".$parametre[0]->getId()."' hidden>";?>
        <br>
        <input type="submit" name="submit" type='button' class="btn btn-success btn-block"><br>

    </div>

</form>


<?php
    require_once("../html/footer.html");
?>
