<?php

require_once("database.php");



try{
  $dbCnx = new PDO($mysqlDsn,$myUserDb,$myPwdDb);
}catch(PDOException $e){
  echo "Connexion échouée : ".$e->getMessage();
  exit;
}

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
echo "<br>".$date1;
echo "<br>".$fmax_mm;
print_r($date1);
//
 $sth = $dbCnx->prepare("INSERT INTO parametre (date_ajout,corde,tmax_p,tmax_mm,fmax_p,fmax_mm,nb_point,libelle) VALUES ('$date1',$corde,$tmax_p,$tmax_mm,$fmax_p,$fmax_mm,$nb_point,'$libelle')");


try {
  $sth->execute();
  echo "ok";
} catch (Exception $e) {
  echo $e;
}

 $parametre = $sth->fetchAll(PDO::FETCH_CLASS,'Parametre');

 ?>
