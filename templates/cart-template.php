<?php
// if accessed directly than exit
if (!defined('ABSPATH')) exit;
?>

<!-- /.Main Container | Cart -->
<br><br><br><br>
<div class="container">
    <?php
    $sql = "
                SELECT  C.burger_id, C.commande_id,
                        C.quantite, C.view,
                        B.nom, B.image, B.prix
                FROM    commande_burger C
                JOIN    burger B on C.burger_id = B.id
                WHERE   C.view = 0 AND commande_id=" . $_SESSION['users']->id . "";
    $resultCartBurger = $dbh->query($sql);
    $countBurger = $resultCartBurger->rowCount();
    $total_amountBurger = 0;

    $sql2 = "
                SELECT  C.commande_id, C.boisson_id,
                        C.quantite, C.view,
                        B.nom, B.image, B.prix
                FROM    commande_boisson C
                JOIN    boisson B on C.boisson_id = B.id
                WHERE   C.view = 0 AND commande_id=" . $_SESSION['users']->id . "";
    $resultCartBoisson = $dbh->query($sql2);
    $countBoisson = $resultCartBoisson->rowCount();
    $total_amountBoisson = 0;

    $result = $dbh->prepare("SELECT id, adresse, code_postal, ville, paye FROM commande WHERE id = :idUser");
    $result->execute(["idUser" => $_SESSION['users']->id]);
    $count = $result->rowCount();
    $address = $result->fetchObject();
    ?>
    <!-- Header image -->
    <div class="edge-header">
        <img class="img-fluid" src="img/header/cart.jpg">
    </div>
    <div class="container free-bird col-md-10 offset-md-1 jumbotron wow fadeInUp">
        <div class="row">
            <?php if (isset($_SESSION['msg'])): ?>
                <div class="alert alert-success" role="alert">
                    <strong><?= $_SESSION['msg'] ?></strong>
                </div>
                <?php unset($_SESSION['msg']);
            endif;
            ?>
            <div class="titleCart">
                <h2 class="h2-responsive">Order(s)</h2>
            </div>
            <div>
                <!--Shopping Cart table-->
                <div class="table-responsive">
                    <table class="table table-striped ">

                        <!-- ------------------------- BURGERS ------------------------- -->
                        <!--Table head-->
                        <thead class="thead-inverse">
                        <tr>
                            <th class="text-xs-center">Burger</th>
                            <th></th>
                            <th>Price</th>
                            <th class="text-xs-center">Quantity</th>
                            <th class="text-xs-center">Amount</th>
                            <?php if (!isset($_GET['order'])): ?>
                                <th>Delete</th>
                            <?php endif; ?>
                        </tr>
                        </thead>
                        <!--/Table head-->

                        <!--Table body-->
                        <tbody>
                        <?php if ($countBurger <= 0):
                            $custom_colspan = 6;
                            ?>
                            <tr>
                                <td class="grey-text text-md-center" colspan="<?php echo $custom_colspan; ?>">You haven't chosen any burgers</td>
                            </tr>
                        <?php else:
                            $a = 1;
                            while ($cartBurger = $resultCartBurger->fetchObject()):
                                $priceVAT = round($helper->priceVAT($cartBurger->prix, VAT), 2);
                                $amount = $priceVAT * $cartBurger->quantite;
                                ?>
                                <tr>
                                    <td>
                                        <h5 class="text-xs-center"><strong><a
                                                        href="?page=burger&id=<?= $cartBurger->burger_id ?>"
                                                        target="_blank"><?php echo $cartBurger->nom; ?></a></strong>
                                        </h5>
                                    </td>
                                    <td>
                                        <div class="view overlay hm-white-slight">
                                            <?php if (!empty($cartBurger->image)): ?>
                                                <img class="img-fluid"
                                                     src="img/product/burgers/<?php echo $cartBurger->image; ?>"
                                                     alt="Burger | Picture" width="150" height="150">
                                            <?php else: ?>
                                                <div class="view overlay hm-white-slight">
                                                    <img class="img-fluid" src="img/product/burgers/no-img_burger.png"
                                                         alt="Burger | None Picture" width="150" height="150">
                                                </div>
                                                <div class="mask"></div>
                                            <?php endif ?>
                                            <div class="mask"></div>
                                        </div>
                                    </td>
                                    <td><?php echo $priceVAT; ?>&euro;</td>
                                    <td class="qty text-xs-center"><?php echo $cartBurger->quantite; ?></td>
                                    <td class="text-xs-center"><?php echo $amount ?>&euro;</td>
                                    <!-- Delete Cart | One Burger -->
                                    <td>
                                        <a class="red-text" href="#" data-toggle="modal"
                                           data-target="#delete_modal_cart_one_burger<?= $a ?>">
                                            <i class="fa fa-trash-o" aria-hidden="true" data-toggle="tooltip"
                                               data-placement="bottom" title="Remove item"></i>
                                        </a>

                                        <!-- Modal Delete | One Burger -->
                                        <div class="modal fade modal-ext"
                                             id="delete_modal_cart_one_burger<?= $a++ ?>" tabindex="-1"
                                             role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <!-- Modal Delete | Container -->
                                                <div class="modal-content">
                                                    <!-- Modal Delete | Title -->
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h4 class="modal-title" id="myModalLabel">Remove this
                                                            burger?</h4>
                                                    </div>
                                                    <!-- Modal Delete | Title -->

                                                    <!-- Modal Delete Cart | Content -->
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-xs-6 cartButton">
                                                                <form action="actions/deleteBurger.php"
                                                                      method="post">
                                                                    <!-- Get the burgerId -->
                                                                    <input type="hidden" name="burgerId"
                                                                           value="<?php echo $cartBurger->burger_id; ?>">
                                                                    <!-- Get the userId -->
                                                                    <input type="hidden" name="cartUser"
                                                                           value="<?php echo $_SESSION['users']->id; ?>">
                                                                    <!-- Sending -->
                                                                    <button name="cartSubmit"
                                                                            class="btn btn-outline-info btn-rounded waves-effect">
                                                                        Yes
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            <div class="col-xs-6 cartButton">
                                                                <button type="button"
                                                                        class="btn btn-outline-info btn-rounded waves-effect"
                                                                        data-dismiss="modal">No
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.Modal Delete Cart | Content -->
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ Modal Delete Cart | One Burger -->
                                    </td>
                                </tr>
                                <?php
                                $total_amountBurger += $priceVAT * $cartBurger->quantite;
                            endwhile;

                            $custom_colspan = 4;
                            ?>
                            <tr>
                                <td colspan="<?php echo $custom_colspan; ?>"></td>
                                <td class="total_amount" colspan="1">
                                    <h5>Total :</h5>
                                </td>
                                <td class="total_amount">
                                    <h5><?php echo $total_amountBurger ?>&nbsp;&euro;</h5>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="<?php echo $custom_colspan; ?>"></td>
                                <td class="total_amount" colspan="1"><h5>VAT :</h5></td>
                                <td class="total_amount"><h5><?php echo constant("VAT"); ?>&#37;</h5></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                        <!--/Table body-->

                        <!-- ------------------------- BOISSONS ------------------------- -->
                        <!--Table head-->
                        <thead class="thead-inverse">
                        <tr>
                            <th class="text-xs-center">Drink</th>
                            <th></th>
                            <th>Price</th>
                            <th class="text-xs-center">Quantity</th>
                            <th class="text-xs-center">Amount</th>
                            <?php if (!isset($_GET['order'])): ?>
                                <th>Delete</th>
                            <?php endif; ?>
                        </tr>
                        </thead>
                        <!--/Table head-->

                        <!--Table body-->
                        <tbody>
                        <?php if ($countBoisson <= 0):
                            $custom_colspan = 6;
                            ?>
                            <tr>
                                <td class="grey-text text-md-center" colspan="<?php echo $custom_colspan; ?>">You haven't chosen any drinks.</td>
                            </tr>
                        <?php else:
                            $b = 1;
                            while ($cartBoisson = $resultCartBoisson->fetchObject()):
                                $priceVAT = round($helper->priceVAT($cartBoisson->prix, VAT), 2);
                                $amount = $priceVAT * $cartBoisson->quantite;
                                ?>
                                <tr>
                                    <td>
                                        <h5 class="text-xs-center"><strong><a
                                                        href="?page=drink&id=<?= $cartBoisson->boisson_id ?>"
                                                        target="_blank"><?php echo $cartBoisson->nom; ?></a></strong>
                                        </h5>
                                    </td>
                                    <td>
                                        <div class="view overlay hm-white-slight">
                                            <?php if (!empty($cartBoisson->image)): ?>
                                                <img class="img-fluid"
                                                     src="img/product/boissons/<?php echo $cartBoisson->image; ?>"
                                                     alt="Burger | Picture" width="150" height="150">
                                            <?php else: ?>
                                                <div class="view overlay hm-white-slight">
                                                    <img class="img-fluid" src="img/product/boissons/no-img_boisson.png"
                                                         alt="Burger | None Picture" width="150" height="150">
                                                </div>
                                                <div class="mask"></div>
                                            <?php endif ?>
                                            <div class="mask"></div>
                                        </div>
                                    </td>
                                    <td><?php echo $priceVAT; ?>&euro;</td>
                                    <td class="qty text-xs-center"><?php echo $cartBoisson->quantite; ?></td>
                                    <td class="text-xs-center"><?php echo $amount ?>&euro;</td>
                                    <td>
                                        <a class="red-text" href="#" data-toggle="modal"
                                           data-target="#delete_modal_cart_one_drink<?= $b ?>">
                                            <i class="fa fa-trash-o" aria-hidden="true" data-toggle="tooltip"
                                               data-placement="bottom" title="Remove item"></i>
                                        </a>

                                        <!-- Modal Delete | One Drink -->
                                        <div class="modal fade modal-ext"
                                             id="delete_modal_cart_one_drink<?= $b++ ?>" tabindex="-1" role="dialog"
                                             aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <!-- Modal Delete | Container -->
                                                <div class="modal-content">
                                                    <!-- Modal Delete | Title -->
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h4 class="modal-title" id="myModalLabel">Remove this
                                                            drink?</h4>
                                                    </div>
                                                    <!-- Modal Delete | Title -->

                                                    <!-- Modal Delete Cart | Content -->
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-xs-6 cartButton">
                                                                <form action="actions/deleteBoisson.php"
                                                                      method="post">
                                                                    <!-- Get the drinkId -->
                                                                    <input type="hidden" name="drinkId"
                                                                           value="<?php echo $cartBoisson->boisson_id; ?>">
                                                                    <!-- Get the userId -->
                                                                    <input type="hidden" name="cartUser"
                                                                           value="<?php echo $_SESSION['users']->id; ?>">
                                                                    <!-- Sending -->
                                                                    <button name="cartSubmit"
                                                                            class="btn btn-outline-info btn-rounded waves-effect">
                                                                        Yes
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            <div class="col-xs-6 cartButton">
                                                                <button type="button"
                                                                        class="btn btn-outline-info btn-rounded waves-effect"
                                                                        data-dismiss="modal">No
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.Modal Delete Cart | Content -->
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ Modal Delete Cart | One Drink -->
                                    </td>
                                </tr>
                                <?php
                                $total_amountBoisson += $priceVAT * $cartBoisson->quantite;
                            endwhile;

                            $custom_colspan = 4;
                            ?>
                            <tr>
                                <td colspan="<?php echo $custom_colspan; ?>"></td>
                                <td class="total_amount" colspan="1">
                                    <h5>Total :</h5>
                                </td>
                                <td class="total_amount">
                                    <h5><?php echo $total_amountBoisson ?>&nbsp;&euro;</h5>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="<?php echo $custom_colspan; ?>"></td>
                                <td class="total_amount" colspan="1"><h5>VAT :</h5></td>
                                <td class="total_amount"><h5><?php echo constant("VAT"); ?>&#37;</h5></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                        <!--/Table body-->
                    </table>
                </div>
                <!--Shopping Cart table-->
            </div>
            <!-- Empty & Purchase | Cart -->
            <div class="row">
                <?php if (($countBurger > 0 || $countBoisson > 0) && isset($address->adresse) && isset($address->code_postal) && isset($address->ville)): ?>
                <!--/ Empty Cart -->
                <div class="col-xs-6 cartButton">
                    <a href="#" data-toggle="modal" data-target="#delete_modal_cart_all">
                        <button type="button" class="btn btn-outline-info btn-rounded waves-effect">Empty Cart
                        </button>
                    </a>
                </div>
                <!--/ Purchase Cart -->
                <div class="col-xs-6 cartButton">
                    <a href="#" data-toggle="modal" data-target="#purchase_modal_cart_all">
                        <button type="button" class="btn btn-outline-info btn-rounded waves-effect">Purchase
                        </button>
                    </a>
                </div>

                <!-- Modal Empty Cart -->
                <div class="modal fade modal-ext" id="delete_modal_cart_all" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <!-- Modal Empty | Container -->
                        <div class="modal-content">
                            <!-- Modal Empty | Title -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Empty your cart?</h4>
                            </div>
                            <!-- Modal Empty | Title -->

                            <!-- Modal Empty Cart | Content -->
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-6 cartButton">
                                        <a href="actions/deleteCart.php">
                                            <button type="button"
                                                    class="btn btn-outline-info btn-rounded waves-effect">Yes
                                            </button>
                                        </a>
                                    </div>
                                    <div class="col-xs-6 cartButton">
                                        <button type="button"
                                                class="btn btn-outline-info btn-rounded waves-effect"
                                                data-dismiss="modal">No
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.Modal Empty Cart | Content -->
                        </div>
                    </div>
                </div>
                <!--/ Modal Empty Cart -->

                <!-- Modal Purchase Cart -->
                <div class="modal fade modal-ext" id="purchase_modal_cart_all" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <!-- Modal Purchase | Container -->
                        <div class="modal-content">
                            <!-- Modal Purchase | Title -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Do you want to purchase?</h4>
                            </div>
                            <!-- Modal Purchase | Title -->

                            <!-- Modal Purchase Cart | Content -->
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-6 cartButton">
                                        <a href="actions/purchase.php">
                                            <button type="button"
                                                    class="btn btn-outline-info btn-rounded waves-effect">Yes
                                            </button>
                                        </a>
                                    </div>
                                    <div class="col-xs-6 cartButton">
                                        <button type="button"
                                                class="btn btn-outline-info btn-rounded waves-effect"
                                                data-dismiss="modal">No
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.Modal Empty Cart | Content -->
                        </div>
                    </div>
                </div>
                <!--/ Modal Purchase Cart -->
            </div>
        <?php else: ?>
            <div class="col-xs-6 cartButton">
                <a href="?page=home" class="btn btn-outline-info btn-rounded waves-effect">Home</a>
            </div>
            <div class="col-xs-6 cartButton">
                <a href="?page=profile"
                   class="btn btn-outline-info btn-rounded waves-effect"><?php $address->paye == 0 && empty($address->adresse) && empty($address->code_postal) && empty($address->ville) ? _e("Add an address") : _e("Orders") ?></a>
            </div>
        <?php endif; ?>
            <!-- Empty & Purchase | Cart -->
        </div>
    </div>
</div>
<!-- /.Main Container -->