<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/04/2017
 * Time: 15:43
 */
require_once '../load.php';
require_once '../includes/config.inc.php';
spl_autoload_register(function($class){
    require_once '../lib/'.$class.'.php';
});
// Connexion
$dbh = DB::getInstance();

if ( isset($_REQUEST['email']) && !empty($_REQUEST['email']) ) {

    $email = trim($_REQUEST['email']); // Delete white space
    $email = strip_tags($email); //Remove unnecessary tags

    $query = "SELECT mail FROM commande WHERE mail=:email";
    $stmt = $dbh->prepare( $query );
    $stmt->execute(array(':email'=>$email));

    if ($stmt->rowCount() == 1) {
        echo 'false'; // email already taken
    } else {
        echo 'true';
    }
}

if ( isset($_REQUEST['username']) && !empty($_REQUEST['username']) ) {

    $username = trim($_REQUEST['username']);
    $username = strip_tags($username);

    $query = "SELECT login FROM commande WHERE login=:username";
    $stmt = $dbh->prepare( $query );
    $stmt->execute(array(':username'=>$username));

    if ($stmt->rowCount() == 1) {
        echo 'false'; // username already taken
    } else {
        echo 'true';
    }
}