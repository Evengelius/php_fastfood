<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 08/01/2017
 * Time: 13:20
 */

session_start();
require_once '../../load.php';
require_once '../../includes/config.inc.php';
spl_autoload_register(function ($class) {
    require_once '../../lib/' . $class . '.php';
});

// Connection
$dbh = DB::getInstance();

if (isset($_POST['old_password'])):
    $sql = "SELECT login, mot_de_passe FROM commande WHERE login = :login";
    $result = $dbh->prepare($sql);
    $result->execute(['login' => $_SESSION['users']->login]);
    $row = $result->fetchObject();

    if ($result->rowCount() == 1 && password_verify($_POST['old_password'], $row->mot_de_passe)):

        if ($_POST['new_password'] == $_POST['con_newpassword']):
            /*
             * If the new password matches its confirmation input
             */
            $pass_hache = password_hash($_POST['con_newpassword'], PASSWORD_DEFAULT);
            /*
             * New hashing key is generated randomly with the new password on the confirmation input.
             * This new hashing key is put in the variable $pass_hache
             */
            $sql = "UPDATE  commande
            SET     mot_de_passe=    :pass
            WHERE   id = :id";
            $result = $dbh->prepare($sql);
            $update = $result->execute(
                [
                    'pass' => $pass_hache,
                    'id' => $_POST['userId']
                ]
            );

            $response['status'] = 'success';
            /*
             * Sending data to ajax if error which custom message => change_pass.js
             */
        else:
            $response['status'] = 'error'; // New password doesn't match with confirmation => as an example since using Jquery validate
            $response['message'] = '<span class="fa fa-exclamation-triangle"></span> &nbsp; Please make sure your new password matches the confirmation.';
            /*
             * Sending data to ajax if error which custom message => change_pass.js
             */
        endif;
    else:
        $response['status'] = 'error'; // Current doesn't match
        $response['message'] = '<span class="fa fa-exclamation-triangle"></span> &nbsp; Your current password doesn\'t match.';
        /*
         * Sending data to ajax if error which custom message => change_pass.js
         */
    endif;
    echo json_encode($response);
    /*
     * Sending the response contained in "$response" into ajax.
     */
endif;
