<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 30/12/2016
 * Time: 17:12
 */
session_start();
require_once '../../load.php';
require_once '../../includes/config.inc.php';
spl_autoload_register(function($class) {
    require_once '../../lib/'.$class.'.php';
});
// Connexion
$dbh = DB::getInstance();

$response = array();

if ($_POST) {

    $date = date("Y-m-d H:i:s");

    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $pass = trim($_POST['cpassword']);

    $user_firstname = strip_tags($firstname);
    $user_lastname = strip_tags($lastname);
    $user_username = strip_tags($username);
    $user_email = strip_tags($email);
    $user_pass = strip_tags($pass);

    // Firstname, Lastname and username start with a letter and contain only letters.
    $user_firstname_replaced = preg_match('/^[a-z]+$/i', $user_firstname);
    $user_lastname_replaced = preg_match('/^[a-z]+$/i', $user_lastname);
    $user_username_replaced = preg_match('/^[a-z]+$/i', $user_username);


    // Valide email
    $valid_email = Helper::validateEmail($user_email);

    // Crypting password
    $hashed_password = password_hash($user_pass, PASSWORD_DEFAULT);

    // One digit and one letter only for password
    preg_match("/^[a-zA-Z0-9]+$/i", $hashed_password);


    /* ******************** SQL QUERY ************************** */

    // Check username
    $query = "SELECT login FROM commande WHERE login=:username";
    $resultUsername = $dbh->prepare( $query );
    $resultUsername->execute(array(
        ':username' => $user_username
    ));

    // If all the data are successfully filtered, insert the data
    if ($resultUsername->rowCount() != 1 && $user_firstname_replaced && $user_lastname_replaced && $user_username_replaced && $valid_email && intval($_POST['register_result']) == $_SESSION['register_valid_operation']) {
        $query = "INSERT INTO commande
                                (nom,prenom,login,mot_de_passe, mail, heure) 
              VALUES            
                                (:lastname, :firstname, :login, :pass, :email, :today)";

        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':lastname', $user_lastname);
        $stmt->bindParam(':firstname', $user_firstname);
        $stmt->bindParam(':login', $user_username);
        $stmt->bindParam(':pass', $hashed_password);
        $stmt->bindParam(':email', $user_email);
        $stmt->bindParam(':today', $date);


        // check for successfull registration
        if ($stmt->execute()) {

            $response['status'] = 'success';
            $response['message'] = '<span class="fa fa-check"></span> &nbsp; Greeting ! Thank you for registering at our Burger House !';

        } else {
            $response['status'] = 'error'; // could not register
            $response['message'] = '<span class="fa fa-exclamation-triangle"></span> &nbsp; Could not register, try again later.';
        }
    } else /* Else, it shows a message error */ {
        $response['status'] = 'error'; // could not register
        $response['message'] = '<span class="fa fa-exclamation-triangle"></span> &nbsp; Invalid data.';
    }
    echo json_encode($response);
}
