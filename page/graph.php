<?php
require_once("../html/header.html");

// connexion à la base de données
require_once("../php/database.php");
try{
    $dbCnx = new PDO($mysqlDsn,$myUserDb,$myPwdDb);
}catch(PDOException $e){
    echo "Connexion échouée : ".$e->getMessage();
    exit;
}

// appel des bibliothèque de jpgraph
require_once ('../jpgraph-4.2.0/src/jpgraph.php');
require_once ('../jpgraph-4.2.0/src/jpgraph_line.php');


//Valeur dans le graphe
/*
$ydata = array(11,3,8,12,5,1,9,13,5,7);
*/

// Create the graph. These two calls are always required
/*$graph = new Graph(350,250);
$graph->SetScale('textlin');*/

// Create the linear plot
/*
$lineplot=new LinePlot($ydata);
$lineplot->SetColor('blue');
*/

// Add the plot to the graph
/*
$graph->Add($lineplot);
*/

// Display the graph
/*
$graph->Stroke();
*/
?>
