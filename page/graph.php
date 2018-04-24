<?php // content="text/plain; charset=utf-8"
require_once ('../jpgraph/src/jpgraph.php');
require_once ('../jpgraph/src/jpgraph_line.php');
<<<<<<< HEAD
=======


>>>>>>> 05012683e885c38c2974ebe9163fb0a630911873
require_once("../html/header.html");
require_once("../php/database.php");


try{
  $dbCnx = new PDO($mysqlDsn,$myUserDb,$myPwdDb);
}catch(PDOException $e){
  echo "Connexion échouée : ".$e->getMessage();
  exit;
}
<<<<<<< HEAD
$sth = $dbCnx->prepare("SELECT * FROM parametre");
$sth->execute();
$parametre = $sth->fetchAll(PDO::FETCH_CLASS,'Parametre');
=======

$sth = $dbCnx->prepare("SELECT * FROM parametre");
$sth->execute();
$parametre = $sth->fetchAll(PDO::FETCH_CLASS,'Parametre');


>>>>>>> 05012683e885c38c2974ebe9163fb0a630911873
$Xpos = 0;
$XposIni= $parametre->getCorde()/ $parametre->getNb_point();
$sommedSiXgi = 0;
$sommeDsi=0;
$corde =$parametre->getCorde();
<<<<<<< HEAD
=======




>>>>>>> 05012683e885c38c2974ebe9163fb0a630911873
for ($i=0; $i < $parametre->getNb_point(); $i++) {
  $Xpos =$XposIni+$Xpos;
  $valeurCalculer = $Xpos/$corde;
  $Cambrure = -4*($valeurCalculer^2-$valeurCalculer)*$calculFmax;
  $epaisseur = -(1.015*$valeurCalculer^4-2.843*$valeurCalculer^3+3.516*$valeurCalculer^2-2.969*$valeurCalculer^0.5)*$epaisseurMax;
  $Xintrados = $Cambrure-$epaisseur/2;
  $Xextrados = $Cambrure+$epaisseur/2;
  $EpaisseurMoy = ($Xextrados-$Xintrados)/2;
  $Xgi = $Xpos/2;
  $Dsi = $Xpos + $EpaisseurMoy;
  $Sixgi = $Dsi * $Xgi;
  $sommedSiXgi = $sommedSiXgi + $Sixgi;
  $sth = $dbCnx->prepare("INSERT INTO Cambrure (x,t,f,yintra,yextra,igx,id_parametre)
                          VALUES ('$Xpos,$epaisseur,$Cambrure,$Xintrados,$Xextrados,$Xgi,$parametre->getId()");
  try {
      $sth->execute();
      echo "ok";
  } catch (Exception $e) {
      echo $e;
  }
<<<<<<< HEAD
}
// Some data
$ydata = array(11,25,8,12,5,1,9,13,5,7,7.5,7.75);
// Create the graph. These two calls are always required
$graph = new Graph(1400,1000);
$graph->SetScale('textlin');
// Create the linear plot
$lineplot=new LinePlot($ydata);
$lineplot->SetColor('blue');
=======



}




// Some data
$ydata = array(11,25,8,12,5,1,9,13,5,7,7.5,7.75);

// Create the graph. These two calls are always required
$graph = new Graph(1400,1000);
$graph->SetScale('textlin');

// Create the linear plot
$lineplot=new LinePlot($ydata);
$lineplot->SetColor('blue');

>>>>>>> 05012683e885c38c2974ebe9163fb0a630911873
// Add the plot to the graph
$graph->Add($lineplot);
// Display the graph
$graph->Stroke();
