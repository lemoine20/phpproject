<buttton><a href='index.php'>Page Principale</a></button><br>
<?php // content="text/plain; charset=utf-8"
require_once ('../jpgraph/src/jpgraph.php');
require_once ('../jpgraph/src/jpgraph_line.php');
require_once("../html/header.html");
require_once("../php/database.php");


require_once("../php/database.php");
    try{
        $dbCnx = new PDO($mysqlDsn,$myUserDb,$myPwdDb);
    }catch(PDOException $e){
        echo "Connexion échouée : ".$e->getMessage();
        exit;
    }

    $id_recover = $_POST['id_recover'];
    echo "<img src='"."../php/calcul_graph.php?var1=".$id_recover."'>";
    require_once("../html/footer.html");
 ?>
