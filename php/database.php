<?php
$mysqlServerIp = 'localhost';
$mysqlServerPort = "3306";
$mysqlDbName = "projetphp";
$mysqlDbCharset = "UTF8";
$mysqlDsn = "mysql:host=".$mysqlServerIp.";port=".$mysqlServerPort.";dbname=".$mysqlDbName.";charset=".$mysqlDbCharset.";";
$myUserDb = 'projetphp' ;
$myPwdDb = 'phpprojet' ;
class Parametre{
  private $id;
  private $libelle;
  private $date_ajout;
  private $tmax_p;
  private $tmax_mm;
  private $fmax_p;
  private $fmax_mm;
  private $nb_point;
  private $corde;
  private $fic_img;
  private $fic_csv;
  public function getLibelle()
  {
    return $this->libelle;
  }
  public function getId()
  {
    return $this->id;
  }
  public function getDate_ajout()
  {
    return $this->date_ajout;
  }
  public function getCorde()
  {
    return $this->corde;
  }
  public function getTmax_p()
  {
    return $this->tmax_p;
  }
  public function getTmax_mm()
  {
    return $this->tmax_mm;
  }
  public function getFmax_p()
  {
    return $this->fmax_p;
  }
  public function getFmax_mm()
  {
    return $this->fmax_mm;
  }
  public function getFic_img()
  {
    return $this->fic_img;
  }
  public function getFic_csv()
  {
    return $this->fic_csv;
  }
  public function getNb_point()
  {
    return $this->nb_point;
  }
}
class Cambrure{
  private $id;
  private $x;
  private $y;
  private $t;
  private $f;
  private $yintra;
  private $yextra;
  private $igx;
  private $id_parametre;
  private $libelle;
  public function getId()
  {
    return $this->id;
  }
  public function getId_parametre()
  {
    return $this->id_parametre;
  }
  public function getX()
  {
    return $this->x;
  }
  public function getY()
  {
    return $this->y;
  }
  public function getT()
  {
    return $this->t;
  }
  public function getF()
  {
    return $this->f;
  }
  public function getLibelle()
  {
    return $this->libelles;
  }
  public function getIgx()
  {
    return $this->igx;
  }
  public function getYintra()
  {
    return $this->yintra;
  }
  public function getYextra()
  {
    return $this->yextra;
  }
}
?>
