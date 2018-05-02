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
    // suppression des données de cambrure pour l'id selectionner
    sql_requete("DELETE FROM cambrure WHERE id_parametre='".$id_recover."'",$mysqlDsn,$myUserDb,$myPwdDb);

    // suppression des données de parametre pour l'id selectionner
    sql_requete("DELETE FROM parametre WHERE id='".$id_recover."'",$mysqlDsn,$myUserDb,$myPwdDb);


    echo "<p class='text-center'> Données supprimées</p>";
?>
<br>
<a href = '../index.php' class='btn btn btn-success btn-block'>OK</a>
<?php
    require_once("../html/footer.html");
?>
