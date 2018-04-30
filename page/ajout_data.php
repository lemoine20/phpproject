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
<form  method="post">
    <div class="form-group">
        Date : <input type="date" class="form-control" name="date1"/> <!-- possible ajout auto. Avoir-->
        <br>
        Corde : <input type="number" class="form-control" min="0" name="corde"/> en mm.
        <br>
        Nombre de points : <input type="number" class="form-control" min="0" name="nb_point"/>
        <br>
        libelle : <input type="text" class="form-control" name="libelle"/>
        <br>
        Tmax (%) : <input type="number" class="form-control" max="100" min ="0" name="tmax_p"/>
        <br>
        Fmax (%) : <input type="number" class="form-control" max="100" min ="0" name="fmax_p"/>
        <br>
        <br>
        <input type="submit" name="submit" class="btn btn-primary"><br>
    </div>
    <?php

        $length = 78;
        // vérifiez que les données sont présentes
        $_POST["corde"]."<br>"; //corde
        //echo filter_has_var(INPUT_POST, 'corde') ? 'Yes' : 'No';

        $_POST["date1"]."<br>"; //date
        //echo filter_has_var(INPUT_POST, 'date1') ? 'Yes' : 'No';

        $_POST["nb_point"]."<br>"; //nb_point
        //echo filter_has_var(INPUT_POST, 'nb_point') ? 'Yes' : 'No';

        $_POST["libelle"]."<br>"; //libelle
        //echo filter_has_var(INPUT_POST, 'libelle') ? 'Yes' : 'No';

        $_POST["tmax_p"]."<br>";
        //echo filter_has_var(INPUT_POST, 'tmax_p') ? 'Yes' : 'No';

        $_POST["fmax_p"]."<br>";
        //echo filter_has_var(INPUT_POST, 'fmax_p') ? 'Yes' : 'No';

        $corde = $_POST["corde"];
        echo addslashes("corde : ".$corde)."<br>";

        $date1 = $_POST["date1"];
        echo addslashes("date : ".$date1)."<br>";

        $nb_point = $_POST["nb_point"];
        echo addslashes("NB_POINT :".$nb_point)."<br>";

        $libelle = $_POST["libelle"];
        echo addslashes("Libelle : ".$libelle)."<br>";

        $tmax_p = $_POST["tmax_p"];
        echo addslashes("Tmax_p : ".$tmax_p)."<br>";

        $fmax_p = $_POST["fmax_p"];
        echo addslashes("fmax_p : ".$fmax_p)."<br>";

        $tmax_mm =($tmax_p/100)*$corde;
        $fmax_mm =($fmax_p/100)*$corde;



        $sth = $dbCnx->prepare("INSERT INTO parametre (date_ajout,corde,tmax_p,tmax_mm,fmax_p,fmax_mm,nb_point,libelle) VALUES ('$date1',$corde,$tmax_p,$tmax_mm,$fmax_p,$fmax_mm,$nb_point,'$libelle')");
        try {
            $sth->execute();
            echo "ok";
        } catch (Exception $e) {
            echo $e;
        }
        $parametres = $sth->fetchAll(PDO::FETCH_CLASS,'Parametre');




        $sth2 = $dbCnx->prepare("SELECT * FROM parametre");
        try {
            $sth2->execute();
            echo "ok";
        } catch (Exception $e) {
            echo $e;
        }
        $parametres = $sth2->fetchAll(PDO::FETCH_CLASS,'Parametre');

        $id_recover = $parametres[sizeof($parametres)-1]->getId();
        echo "id recup : ".$id_recover;
        $sth3 = $dbCnx->prepare("SELECT * FROM parametre WHERE id=$id_recover");
        $sth3->execute();
        $parametre = $sth3->fetchAll(PDO::FETCH_CLASS,'Parametre');


        //echo "<br> Nombre de points :".$parametre[0]->getNb_point()."<br>";
        //print_r($parametre[0]);
        $Xpos = 0;
        $corde =$parametre[0]->getCorde();
        $XposIni= $corde/$parametre[0]->getNb_point();
        $sommedSiXgi = 0;
        $sommeDsi=0;

        var_dump(intval($parametre[0]->getTmax_mm()));

        for ($i=0; $i < $parametre[0]->getNb_point(); $i++) {

          $valeurCalculer = ($Xpos/$corde);
          echo "<br> Xpos =".$Xpos."<br>";
          $Cambrure = -4*($valeurCalculer^2-$valeurCalculer)*$parametre[0]->getFmax_mm();
          $epaisseur = -(1.015*(pow($valeurCalculer,4))-2.843*(pow($valeurCalculer,3))+3.156*(pow($valeurCalculer,2))+1.26*($valeurCalculer)-2.969*(pow($valeurCalculer,0.5)))*3.2;
                  // = -(1,015*(A3/$T$3)^4        -2,843*(A3/$T$3)^3        +3,516*(A3/$T$3)^2        +1,26*(A3/$T$3)        -2,969*(A3/$T$3)^0,5)*$T$5
          echo  $i." : ". $epaisseur. "= -(1.015*(".$valeurCalculer."^4)-2.843*(".$valeurCalculer."^3)+3.516*(".$valeurCalculer."^2)+1.26*(".$valeurCalculer.")-2.969*(".$valeurCalculer."^0.5))*3.2<br>";
          $Xintrados = -$epaisseur/2;
          $Xextrados = $epaisseur/2;
          $EpaisseurMoy = ($Xextrados-$Xintrados)/2;
          $Xgi = $Xpos/2;
          $Dsi = $Xpos + $EpaisseurMoy;
          $Sixgi = $Dsi * $Xgi;
          $sommedSiXgi = $sommedSiXgi + $Sixgi;
          $Xpos =$XposIni+$Xpos;
          $sth4 = $dbCnx->prepare("INSERT INTO cambrure (x,t,f,yintra,yextra,igx,id_parametre)
                                  VALUES ($Xpos,$epaisseur,$Cambrure,$Xintrados,$Xextrados,$Xgi,$id_recover)");

          try {
              $sth4->execute();
          //    echo "ok";
          } catch (Exception $e) {
              echo $e;
          }



      }

    ?>
</form>


<?php
    require_once("../html/footer.html");
?>
