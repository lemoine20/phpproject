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

<buttton><a href='index.php'>Page Principale</a></button><br>
<form  method="post" action="index.php">
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
            //echo "<td> ". $parametre[0]->getDate_ajout()."</td>";
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
        <br>
        <input type="submit" name="submit" class="btn btn-primary"><br>

    </div>
    <?php

        $length = 78;
        // vérifiez que les données sont présentes

        $corde = $_POST['corde'];
        error_log($corde);

        $nb_point = $_POST["nb_point"];

        $libelle = $_POST["libelle"];

        $tmax_p = $_POST["tmax_p"];

        $fmax_p = $_POST["fmax_p"];

        $tmax_mm =($tmax_p/100)*$corde;
        $fmax_mm =($fmax_p/100)*$corde;


        //
        $sth = $dbCnx->prepare("UPDATE `parametre` SET `corde`=".$corde.",`tmax_p` = ".$tmax_p.",`tmax_mm`=".$tmax_mm.",`fmax_p`=".$fmax_p.",`fmax_mm`=".$fmax_mm.",`nbpoint`=".$nb_point.",`libelle`='".$libelle."' WHERE `id` =".$id_recover."");
        try {
            $sth->execute();
            echo "ok";
        } catch (Exception $e) {
            echo $e;
        }
        $parametres = $sth->fetchAll(PDO::FETCH_CLASS,'parametre');
    ?>
</form>


<?php
    require_once("../html/footer.html");
?>
