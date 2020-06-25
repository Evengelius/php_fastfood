<?php
session_start();
require_once '../../load.php';
require_once '../../includes/config.inc.php';
require_once '../../includes/functions.php';
spl_autoload_register(function ($class) {
    require_once '../../lib/' . $class . '.php';
});
// Connexion
$dbh = DB::getInstance();


$subject = (isset($_POST['subject']) && $_POST['subject'] != '') ? $_POST['subject'] : '';

$idDrink = (isset($_POST['idDrink']) && $_POST['idDrink'] != '') ? $_POST['idDrink'] : '';

$quantity = (isset($_POST['quantity']) && $_POST['quantity'] != '') ? $_POST['quantity'] : '';


if (isset($_SESSION['users'])) {

    // Get the paye field
    $result = $dbh->prepare("SELECT id, paye FROM commande WHERE id = :idUser");
    $result->execute(["idUser" => $_SESSION['users']->id]);
    $count = $result->rowCount();
    $address = $result->fetchObject();

    if ($address->paye == 0) {
        if ($subject == 'cart') {
            $cart_result = $dbh->prepare("SELECT * FROM commande_boisson LEFT JOIN boisson b on b.id = commande_boisson.boisson_id WHERE boisson_id = :boissonId AND commande_id = :user_id");
            $cart_result->execute([
                'boissonId' => $idDrink,
                'user_id' => $_SESSION['users']->id
            ]);
            /*
             * If there is already the product in the cart,
             * and we want to insert the same product,
             * => it updates the quantity with the following parameters :
             * productId, user_id, variation. (from $cart_result).
             */
            if ($cart_result->rowCount() > 0) {
                $cart_row = $cart_result->fetchObject();
                /*
                 * The data we fetch inside the cart ($cart_row),
                 * Are equal to $cart_result.
                 * So that it doesn't have the same product twice or more inside the cart,
                 * But update the quantity dynamically.
                 */
                $new_qty = $quantity + $cart_row->quantite;
                if ($new_qty <= $cart_row->quantite_stock) {
                    // Quantity = the number we set in the form + the number already inside the cart.
                    $req = $dbh->prepare("UPDATE commande_boisson SET quantite = :new_quantity WHERE boisson_id = :boissonId");
                    $req->execute([
                        'new_quantity' => $new_qty,
                        'boissonId' => $cart_row->boisson_id
                        // The product quantity is updated according to its id in the cart table
                    ]);

                    $sql = "SELECT DISTINCT boisson_id FROM commande_boisson WHERE commande_id=" . $_SESSION['users']->id;
                    $sql2 = "SELECT DISTINCT burger_id FROM commande_burger WHERE commande_id=" . $_SESSION['users']->id;

                    $resultCartDrink = $dbh->query($sql);
                    $resultCartBurgerAlready = $dbh->query($sql2);
                    $count = $resultCartDrink->rowCount() + $resultCartBurgerAlready->rowCount();

                    $response['status'] = 'success';
                    $response['count'] = $count;
                    $response['message'] = '<span class="fa fa-check"></span> &nbsp; The drink does already exists inside the cart, the desired amount is updated.';

                    // Else it simply insert the product inside the cart if it ain't in the cart already.
                } else {
                    $response['status'] = 'error';
                    $response['message'] = '<span class="fa fa-exclamation-triangle"></span> &nbsp; Sorry the amount you have set is too high!';
                }
            } else {
                $req = $dbh->prepare("INSERT INTO commande_boisson
			(boisson_id, quantite, commande_id)
			VALUES
			(:boissonId, :quantite, :userId)");
                $req->execute([
                    'boissonId' => $idDrink,
                    'quantite' => $quantity,
                    'userId' => $_SESSION['users']->id
                ]);

                $sql = "SELECT DISTINCT boisson_id FROM commande_boisson WHERE commande_id=" . $_SESSION['users']->id;
                $sql2 = "SELECT DISTINCT burger_id FROM commande_burger WHERE commande_id=" . $_SESSION['users']->id;

                $resultCartBoisson = $dbh->query($sql);
                $resultCartBurgerFreshNew = $dbh->query($sql2);
                $count = $resultCartBoisson->rowCount() + $resultCartBurgerFreshNew->rowCount();


                $response['status'] = 'success';
                $response['count'] = $count;
                $response['message'] = '<span class="fa fa-check"></span> &nbsp; The drink has been added to cart !';
            }
        }
    }

    if ($address->paye == 1) {
        $response['status'] = 'error';
        $response['message'] = '<span class="fa fa-exclamation-triangle"></span> &nbsp; Sorry this command has already been achieved, make a new one !';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = '<span class="fa fa-exclamation-triangle"></span> &nbsp; Please login !';
}

echo json_encode($response);
?>