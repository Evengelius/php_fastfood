<?php
session_start();
require_once '../load.php';
require_once '../includes/config.inc.php';
require_once '../includes/functions.php';
spl_autoload_register(function($class){
    require_once '../lib/'.$class.'.php';
});
// Connexion
$dbh = DB::getInstance();
$return = array('status'=> 0); // We create an associative table where the key is "status" and its value "0".

// Burger Price Ajax
if( isset($_POST['action']) && $_POST['action'] == 'get_burger_price_by_ajax'){
    extract($_POST); // Extract data from the $.ajax();
    if(isset($burger_id) && $burger_id != NULL && $burger_id != '' && $burger_id != 0 && isset($qty) && $qty != NULL && $qty != '' && $qty != 0){

        $sql = "SELECT B.id, B.prix, B.quantite_stock FROM burger B WHERE B.id = :burgerId";
        $result = $dbh->prepare($sql);
        $result->execute(['burgerId' => $burger_id]); // Get the burger_id
        $count = $result->rowCount(); // Count all the data inside the table burger.
        if($count == 1){
            // If the data does exist in the table
            $burger = $result->fetchObject(); // We fetch the objects.
            $qty = ($qty == '' || $qty == 0) ? 1 : $qty; // If $qty is empty or equal to 0 we set it 1, else we get the quantity.
            if($burger->quantite_stock == 0){
                $return = array('status'=> 2); // In the key "status" we store the value "2" used in the JS.
            }else{
                if($qty <= $burger->quantite_stock){
                    $price = $burger->prix * $qty;
                    $price = round($price, 2);
                    $return= array('status'=> 1,'price' => $price);
                }
            }
        }
    }
}

// Drink Price Ajax
if( isset($_POST['action']) && $_POST['action'] == 'get_drink_price_by_ajax'){
    extract($_POST); // Extract data from the $.ajax();
    if(isset($drink_id) && $drink_id != NULL && $drink_id != '' && $drink_id != 0 && isset($qty) && $qty != NULL && $qty != '' && $qty != 0){

        $sql = "SELECT B.id, B.prix, B.quantite_stock FROM boisson B WHERE B.id = :drinkId";
        $result = $dbh->prepare($sql);
        $result->execute(['drinkId' => $drink_id]); // Get the drink_id
        $count = $result->rowCount(); // Count all the data inside the table boisson.
        if($count == 1){
            // If the data does exist in the table
            $drink = $result->fetchObject(); // We fetch the objects.
            $qty = ($qty == '' || $qty == 0) ? 1 : $qty; // If $qty is empty or equal to 0 we set it 1, else we get the quantity.
            if($drink->quantite_stock == 0){
                $return = array('status'=> 2); // In the key "status" we store the value "2" used in the JS.
            }else{
                if($qty <= $drink->quantite_stock){
                    $price = $drink->prix * $qty;
                    $price = round($price, 2);
                    $return= array('status'=> 1,'price' => $price);
                }
            }
        }
    }
}

echo json_encode($return);
exit();

/*
My personal State Description
0 The request is not initialized
1 The request is sent.
2 The request is complete.
*/