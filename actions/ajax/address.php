<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12/04/2017
 * Time: 19:11
 */

session_start();
require_once '../../load.php';
require_once '../../includes/config.inc.php';
spl_autoload_register(function ($class) {
    require_once '../../lib/' . $class . '.php';
});

// Connection
$dbh = DB::getInstance();

$response = array();

if ($_POST) {

    // Getting the connected user
    $connectedUser = $_SESSION['users']->id;

    // Getting the data from the form

    $address = trim($_POST['address']);
    $postalCode = trim($_POST['postalCode']);
    $city = trim($_POST['city']);

    $user_address = strip_tags($address);
    $user_postalCode = strip_tags($postalCode);
    $user_city = strip_tags($city);

    // City and country start with a letter and contain only letters.
    preg_match('/^[a-z]+$/i', $user_city);

    // Only digits
    is_numeric($user_postalCode);

    // One digit and one letter only for password
    preg_match("/^[a-zA-Z0-9]+$/i", $user_address);


    /* ******************** SQL QUERY ************************** */

    // Getting the current connected user
    $sql = "SELECT id FROM commande WHERE id = :connectedUser";
    $result = $dbh->prepare($sql);
    $result->execute(
        ['connectedUser' => $connectedUser]
    );
    $count = $result->rowCount();

    // Updating data into table
    $query = "UPDATE  commande
            SET     adresse=    :address,
                    code_postal=    :postalCode,
                    ville=    :city
            WHERE   id = :userId";

    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':address', $user_address);
    $stmt->bindParam(':postalCode', $user_postalCode);
    $stmt->bindParam(':city', $user_city);
    $stmt->bindParam(':userId', $_POST['addressId']);

    // check for successfull adding address
    if ($stmt->execute()) {
        $response['status'] = 'success';

    } else {
        $response['status'] = 'error'; // could not register
        $response['message'] = '<span class="fa fa-exclamation-triangle"></span> &nbsp; Could not insert your address, contact admin for further supply';
    }
    echo json_encode($response);
}
