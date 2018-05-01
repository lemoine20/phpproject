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
    $sth = $dbCnx->prepare("DELETE FROM parametre WHERE id='".$id_recover."'");
    $sth->execute();
    $parametre = $sth->fetchAll(PDO::FETCH_CLASS,'Parametre');

    $std = $dbCnx->prepare("DELETE FROM cambrure WHERE id_parametre='".$id_recover."'");
    $std->execute();
    $parametre = $std->fetchAll(PDO::FETCH_CLASS,'Cambrure');

    echo "<p class='text-center'> Données supprimées</p>";
?>
<br>
<a href = 'index.php' class='btn btn-primary'>Page Principale</a>
<?php
    require_once("../html/footer.html");
?>
