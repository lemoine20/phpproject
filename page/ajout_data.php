<?php
require_once("../html/header.html");


require_once("../php/database.php");
try{
  $dbCnx = new PDO($mysqlDsn,$myUserDb,$myPwdDb);
}catch(PDOException $e){
  echo "Connexion échouée : ".$e->getMessage();
  exit;
}
echo "<a href = 'index.php' class='btn btn-primary'>Page Principale</a>";
?>




  <form  method="post" action="confirmed.php">
    <div class="form-group">
      Date : <input type="date" class="form-control" name="date1" required/> <!-- possible ajout auto. Avoir-->
      <br>
      Corde : <input type="number" class="form-control" min="0" name="corde" required/> en mm.
      <br>
      Nombre de points : <input type="number" class="form-control" min="0" name="nb_point" required/>
      <br>
      libelle : <input type="text" class="form-control" name="libelle" required/>
      <br>
      Tmax (%) : <input type="number" class="form-control" max="100" min ="0" name="tmax_p" required/>
      <br>
      Fmax (%) : <input type="number" class="form-control" max="100" min ="0" name="fmax_p" required/>
      <br>
      <br>
      <input type="submit" name="submit" class="btn btn-primary" ><br>
    </div>
    <?php

    require_once("../html/footer.html");

    ?>
