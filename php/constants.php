<?php
/**
 * @Author: Yohann DUMORTIER
 * @Company: ISEN Yncréa Ouest
 * @Email: yohann.dumortier@isen-ouest.yncrea.fr
 * @Created Date: 04-Avr-2018
 * @Last Modified: 04-Avr-2018
 */
 $mysqlServerIp = "127.0.0.1";
 $mysqlServerPort = "3306";
 $mysqlDbName = "projetphp";
 $mysqlDbCharset = "UTF8";
 $mysqlDsn = "mysql:host=".$mysqlServerIp.";port=".$mysqlServerPort.";dbname=".
 $mysqlDbName.";charset=".$mysqlDbCharset.";";
 $myUserDb = 'projetphp' ;
 $myPwdDb = 'phpprojet' ;

 try{
     $dbCnx = new PDO($mysqlDsn, $myUserDb, $myPwdDb);
 }catch(PDOExeption $e){
     echo "Faild db connect".$e->Message();
     exit;
 }
?>
