<?php
    require_once("../html/header.html");


    require_once("../php/database.php");
?>
<form action="index.php" method="post">
    Date : <input type="date" name="date1"/> <!-- possible ajout auto. Avoir-->
    <br>
    Corde : <input type="number" min="0" name="corde"/> en mm.
    <br>
    Nombre de points : <input type="number" min="0" name="nb_point"/>
    <br>
    libelle : <input type="text" name="libelle"/>
    <br>
    Tmax : <input type="number" max="100" min ="0" name="tmax_p"/>%
    <br>
    Fmax : <input type="number" max="100" min ="0" name="fmax_p"/>%
    <br>
    <input type="submit" name="submit"><br>

    <?php
        $length = 78;
        // $token = bin2hex(random_bytes($length));
        // $token = random(20);
        // echo $token."<br>test<br>";
        // vérifiez que les données sont présentes
        $_POST["corde"]."<br>"; //corde
        // echo filter_has_var(INPUT_POST, 'corde') ? 'Yes' : 'No';

        $_POST["date1"]."<br>"; //date
        // echo filter_has_var(INPUT_POST, 'date1') ? 'Yes' : 'No';

        $_POST["nb_point"]."<br>"; //nb_point
        // echo filter_has_var(INPUT_POST, 'nb_point') ? 'Yes' : 'No';

        $_POST["libelle"]."<br>"; //libelle
        // echo filter_has_var(INPUT_POST, 'libelle') ? 'Yes' : 'No';

        $_POST["tmax_p"]."<br>";
        // echo filter_has_var(INPUT_POST, 'tmax_p') ? 'Yes' : 'No';

        $_POST["fmax_p"]."<br>";
        // echo filter_has_var(INPUT_POST, 'fmax_p') ? 'Yes' : 'No';

        $corde = $_POST["corde"];
        echo addslashes($corde)."<br>";

        $date1 = $_POST["date1"];

        echo addslashes($date1)."<br>";

        $nb_point = $_POST["nb_point"];
        echo addslashes($nb_point)."<br>";

        $libelle = $_POST["libelle"];
        echo addslashes($libelle)."<br>";

        $tmax_p = $_POST["tmax_p"];
        echo addslashes($tmax_p)."<br>";

        $fmax_p = $_POST["fmax_p"];
        echo addslashes($fmax_p)."<br>";


        if (isset($corde)&&isset($date1)&&isset($nb_point)&&isset($libelle)&&isset($tmax_p)&&isset($fmax_p)){
            $testons=$dbCnx->prepare("INSERT INTO parametre(corde, tmax_p,fmax_p) VALUES($corde,, $tmax_p, $fmax_p)");
            $testons->execute();
        }else{
            echo "aucun insertion";
        }
    ?>
</form>


<?php
    require_once("../html/footer.html");
?>
