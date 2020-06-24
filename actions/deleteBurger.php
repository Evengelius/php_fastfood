<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 04/01/2017
 * Time: 15:55
 */

session_start();
require_once '../load.php';
require_once '../includes/config.inc.php';
spl_autoload_register(function($class){
    require_once '../lib/'.$class.'.php';
});

if (isset($_POST['cartSubmit'])):

// Connexion
$dbh = DB::getInstance();

    $view = 0;
    // Deleting the burgerId in the database
    $sql = "DELETE FROM commande_burger WHERE burger_id = ? AND commande_id = ? AND view = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $_POST['burgerId'], PDO::PARAM_INT);
    $stmt->bindParam(2, $_POST['cartUser'], PDO::PARAM_INT);
    $stmt->bindParam(3,  $view, PDO::PARAM_INT);
    $stmt->execute();


// Redirection
    header('location:' . $_SERVER['HTTP_REFERER']);
endif;