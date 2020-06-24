<?php
session_start();
require_once '../load.php';
require_once '../includes/config.inc.php';
spl_autoload_register(function ($class) {
    require_once '../lib/' . $class . '.php';
});
// Connexion
$dbh = DB::getInstance();


//        <!-- ------------------------- BURGERS ------------------------- -->
$viewBurger = 1;
// Set "view" to 1
$queryBurger = "
            UPDATE  commande_burger
            SET     view=    :view
            WHERE   commande_id = :userId";

$stmtBurger = $dbh->prepare($queryBurger);
$stmtBurger->bindParam(':view', $viewBurger);
$stmtBurger->bindParam(':userId', $_SESSION['users']->id);
$stmtBurger->execute();

// Get the boisson_id from the cart
$cartBurgerResult = $dbh->prepare("SELECT CB.burger_id, CB.quantite
					FROM commande_burger CB
					WHERE commande_id = :connectedUser");
$cartBurgerResult->execute(['connectedUser' => $_SESSION['users']->id]);

// Gestion de stock
while ($cartBurger = $cartBurgerResult->fetchObject()) {

// SELECT Burgers
    $sql = " SELECT B.id, B.quantite_stock FROM burger B WHERE B.id = :burgerId";
    $burger_result = $dbh->prepare($sql);
    $burger_result->execute(['burgerId' => $cartBurger->burger_id]);

// Set new quantity
    if ($burger_result->rowCount() == 1) {
        $burger = $burger_result->fetchObject();
        $new_qty = $burger->quantite_stock - $cartBurger->quantite;
        $burger_update_sql = "UPDATE burger SET quantite_stock = :NewQuantity WHERE id = :ID";
        $burger_update_result = $dbh->prepare($burger_update_sql);
        $burger_update_result->execute([
            'NewQuantity' => $new_qty,
            'ID' => $burger->id,
        ]);
    }
}

//        <!-- ------------------------- BOISSONS ------------------------- -->

$viewBoisson = 1;
// Set "view" to 1
$queryBoisson = "
            UPDATE  commande_boisson
            SET     view=    :view
            WHERE   commande_id = :userId";

$stmtBoisson = $dbh->prepare($queryBoisson);
$stmtBoisson->bindParam(':view', $viewBoisson);
$stmtBoisson->bindParam(':userId', $_SESSION['users']->id);
$stmtBoisson->execute();

// Get the boisson_id from the cart
$cartBoissonResult = $dbh->prepare("SELECT CB.boisson_id, CB.quantite
					FROM commande_boisson CB
					WHERE commande_id = :connectedUser");
$cartBoissonResult->execute(['connectedUser' => $_SESSION['users']->id]);

// Gestion de stock
while ($cartBoisson = $cartBoissonResult->fetchObject()) {

// SELECT Boisson
    $sql = " SELECT B.id, B.quantite_stock FROM boisson B WHERE B.id = :boissonId";
    $boisson_result = $dbh->prepare($sql);
    $boisson_result->execute(['boissonId' => $cartBoisson->boisson_id]);

// Set new quantity
    if ($boisson_result->rowCount() == 1) {
        $boisson = $boisson_result->fetchObject();
        $new_qty = $boisson->quantite_stock - $cartBoisson->quantite;
        $boisson_update_sql = "UPDATE boisson SET quantite_stock = :NewQuantity WHERE id = :ID";
        $boisson_update_result = $dbh->prepare($boisson_update_sql);
        $boisson_update_result->execute([
            'NewQuantity' => $new_qty,
            'ID' => $boisson->id,
        ]);
    }
}

//        <!-- ------------------------- COMMANDE ------------------------- -->

$paye = 1;
// Set "paye" to 1
$query = "
            UPDATE  commande
            SET     paye=    :paye
            WHERE   id = :userId";

$stmt = $dbh->prepare($query);
$stmt->bindParam(':paye', $paye);
$stmt->bindParam(':userId', $_SESSION['users']->id);
$stmt->execute();


// Redirection
header('location:' . $_SERVER['HTTP_REFERER']);