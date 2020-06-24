<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11/04/2017
 * Time: 16:49
 */

// Authentification
session_start();
require '../../includes/config.inc.php';
require '../../lib/DB.php';
spl_autoload_register(function($class) {
    require_once '../../lib/'.$class.'.php';
});

// Connection
$dbh = DB::getInstance();

// Deleting white spaces
$username = trim($_POST['username']);
$pass = trim($_POST['password']);

// Remove unecessery tags
$user_username = strip_tags($username);
$user_pass = strip_tags($pass);

// Username start with a letter and contain only letters.
preg_match('/^[a-z]+$/i', $user_username);

// Is array $response
$response = array();

/* ********************************************** */

// Disconnection if connected
if (isset($_SESSION['users'])) {
    // Détruit toutes les variables de session
    $_SESSION = array();

// Si vous voulez détruire complètement la session, effacez également
// le cookie de session.
// Note : cela détruira la session et pas seulement les données de session !
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

// Finalement, on détruit la session.
    session_destroy();
    header('location: ../../?page=home');
    exit;
}

// Check if the password field exist
elseif(isset($_POST['password'])) {
    extract($_POST); // Data are extracted.

    /* ******************** SQL QUERY ************************** */

    $sql = "SELECT login, mot_de_passe FROM commande WHERE login = :login";
    $result = $dbh->prepare($sql);
    $result->execute(['login' => $_POST['username']]);
    $row = $result->fetchObject();

    // We check if the password from the form field is equal to the password from the database. | We got the password from the database => $row->password
    if($result->rowCount() == 1 && password_verify($_POST['password'], $row->mot_de_passe) && intval($_POST['valid_result']) == $_SESSION['valid_operation']) {
        // Connect the user
            $sql = "SELECT id, login, nom , prenom, mail, adresse, code_postal, ville, paye FROM commande WHERE login = :login";
            $result = $dbh->prepare($sql);
            $result->execute(['login' => $_POST['username']]);
            $row = $result->fetchObject();
            $_SESSION['users'] = $row;
            $response['status'] = 'success';
            $response['message'] = '<span class="fa fa-check"></span> &nbsp; Logged successfully !';
    }
    else{
        $response['status'] = 'error'; // Could not login
        $response['message'] = '<span class="fa fa-exclamation-triangle"></span> &nbsp; Could not login, please re-check your data.';
    }
    echo json_encode($response);
} else {
    header ('location: ../../index.php');
    exit;
}