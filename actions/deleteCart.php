<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 04/01/2017
 * Time: 03:05
 */
session_start();
require_once '../load.php';
require_once '../includes/config.inc.php';
spl_autoload_register(function($class){
    require_once '../lib/'.$class.'.php';
});
// Connexion
$dbh = DB::getInstance();

$sql = "DELETE FROM commande_boisson WHERE view = 0 AND commande_id=".$_SESSION['users']->id;
$sql2 = "DELETE FROM commande_burger WHERE view = 0 AND commande_id=".$_SESSION['users']->id;
$dbh->query($sql);
$dbh->query($sql2);



// Redirection
header('location:' . $_SERVER['HTTP_REFERER']);
