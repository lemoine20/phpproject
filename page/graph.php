<?php // content="text/plain; charset=utf-8"
require_once ('../jpgraph/src/jpgraph.php');
require_once ('../jpgraph/src/jpgraph_line.php');


require_once("../html/header.html");
require_once("../php/database.php");


try{
  $dbCnx = new PDO($mysqlDsn,$myUserDb,$myPwdDb);
}catch(PDOException $e){
  echo "Connexion échouée : ".$e->getMessage();
  exit;
}

$sth = $dbCnx->prepare("SELECT * FROM parametre");
$sth->execute();
$parametre = $sth->fetchAll(PDO::FETCH_CLASS,'Parametre');


$Xpos = 0;
$XposIni= $parametre->getCorde()/ $parametre->getNb_point();
$sommedSiXgi = 0;
$sommeDsi=0;
$corde =$parametre->getCorde();




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



}




// Some data
$ydata = array(11,25,8,12,5,1,9,13,5,7,7.5,7.75);

// Create the graph. These two calls are always required
$graph = new Graph(1400,1000);
$graph->SetScale('textlin');

// Create the linear plot
$lineplot=new LinePlot($ydata);
$lineplot->SetColor('blue');

// Add the plot to the graph
$graph->Add($lineplot);

// Display the graph
$graph->Stroke();
?>
