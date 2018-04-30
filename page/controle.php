<?php
    require_once("../html/header.html");


    require_once("../php/database.php");
    try{
        $dbCnx = new PDO($mysqlDsn,$myUserDb,$myPwdDb);
    }catch(PDOException $e){
        echo "Connexion échouée : ".$e->getMessage();
        exit;
    }

    $id_recover = intval($_POST['id_recover']);
    $corde = intval($_POST['corde']);
    $sth = $dbCnx->prepare("SELECT * FROM parametre WHERE id='".$id_recover."'");
    $sth->execute();
    $parametre = $sth->fetchAll(PDO::FETCH_CLASS,'Parametre');

?>
<buttton><a href='index.php'>Page Principale</a></button><br>

    <?php

        $length = 78;
        // vérifiez que les données sont présentes


        $nb_point = intval($_POST['nb_point']);

        $libelle = $_POST['libelle'];

        $tmax_p = intval($_POST['tmax_p']);

        $fmax_p = intval($_POST['fmax_p']);

        $tmax_mm =($tmax_p/100)*$corde;
        $fmax_mm =($fmax_p/100)*$corde;


        //
        $stl = $dbCnx->prepare("UPDATE parametre SET corde = ".$corde." WHERE id =".$id_recover."");
        var_dump($stl);
        $stl1 = $dbCnx->prepare("UPDATE parametre SET tmax_p = ".$tmax_p." WHERE id =".$id_recover."");
        var_dump($stl1);
        $stl2 = $dbCnx->prepare("UPDATE parametre SET tmax_mm=".$tmax_mm." WHERE id =".$id_recover."");
        var_dump($stl2);
        $stl3 = $dbCnx->prepare("UPDATE parametre SET fmax_p=".$fmax_p." WHERE id =".$id_recover."");
        var_dump($stl3);
        $stl4 = $dbCnx->prepare("UPDATE parametre SET fmax_mm=".$fmax_mm." WHERE id =".$id_recover."");
        var_dump($stl4);
        $stl5 = $dbCnx->prepare("UPDATE parametre SET nb_point=".$nb_point." WHERE id =".$id_recover."");
        var_dump($stl5);
        $stl6 = $dbCnx->prepare("UPDATE parametre SET libelle='".$libelle."' WHERE id =".$id_recover."");
        var_dump($stl6);
        echo "<br><br><br><br><br>";

        try {
            $stl->execute();
            $stl1->execute();
            $stl2->execute();
            $stl3->execute();
            $stl4->execute();
            $stl5->execute();
            $stl6->execute();
        //    echo "ok";
        } catch (Exception $e) {
            echo $e;
        }

        $sth5 = $dbCnx->prepare("DELETE FROM cambrure WHERE `id` = $id_recover)");

        try {
            $sth5->execute();
            //    echo "ok";
        } catch (Exception $e) {
            echo $e;
        }

        $parametres = $sth->fetchAll(PDO::FETCH_CLASS,'parametre');
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



<?php
    require_once("../html/footer.html");
?>
