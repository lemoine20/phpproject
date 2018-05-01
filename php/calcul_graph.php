<?php // content="text/plain; charset=utf-8"
require_once ('../jpgraph/src/jpgraph.php');
require_once ('../jpgraph/src/jpgraph_line.php');
//require_once("../html/header.html");
require_once("../php/database.php");
    try{
        $dbCnx = new PDO($mysqlDsn,$myUserDb,$myPwdDb);
    }catch(PDOException $e){
        echo "Connexion échouée : ".$e->getMessage();
        exit;
    }


    $id_recover = $_GET['var1'];
    //error_log($id_recover);
    $sth = $dbCnx->prepare("SELECT * FROM cambrure WHERE id_parametre = $id_recover");
    try {
        $sth->execute();
      //  echo "ok";
    } catch (Exception $e) {
        echo $e;
    }
    $cambrures = $sth->fetchAll(PDO::FETCH_CLASS,'Cambrure');


    $i = 0;

    foreach ($cambrures as $cambrure) {
      $yextra[$i] = $cambrure->getYextra();
      $yintra[$i] = $cambrure->getYintra();
      $x_array[$i] = $cambrure->getX();
      $i++;
    }


$datay1 = $yextra;
$datay2 = $yintra;


// Setup the graph
$graph = new Graph(1200,800);
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Filled Y-grid');
$graph->SetBox(false);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
//$graph->xaxis->SetTickLabels($x_array);
$graph->xgrid->SetColor('#E3E3E3');

// Create the first line
$p1 = new LinePlot($datay1);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend('Line 1');

// Create the second line
$p2 = new LinePlot($datay2);
$graph->Add($p2);
$p2->SetColor("#B22222");
$p2->SetLegend('Line 2');


$graph->legend->SetFrameWeight(1);

// Output line
$graph->Stroke();

?>
