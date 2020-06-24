<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12/04/2017
 * Time: 15:27
 */

$result = $dbh->prepare("SELECT id, adresse, code_postal, ville FROM commande WHERE id = :idUser");
$result->execute(["idUser" => $_SESSION['users']->id]);
$count = $result->rowCount();
$address = $result->fetchObject();

$sql = "
        SELECT  C.burger_id, C.commande_id,
                C.quantite, C.view,
                B.nom, B.image, B.prix,
                Co.paye
                FROM    commande_burger C
                JOIN    burger B on C.burger_id = B.id
                JOIN    commande Co on C.commande_id = Co.id
                WHERE   Co.paye = 1 AND C.view = 1  AND commande_id=" . $_SESSION['users']->id . "";
$resultCartBurger = $dbh->query($sql);
$countBurger = $resultCartBurger->rowCount();
$total_amountBurger = 0;

$sql2 = "
        SELECT  C.commande_id, C.boisson_id,
                C.quantite, C.view,
                B.nom, B.image, B.prix,
                Co.paye
        FROM    commande_boisson C
        JOIN    boisson B on C.boisson_id = B.id
        JOIN    commande Co on C.commande_id = Co.id
        WHERE   Co.paye = 1 AND C.view = 1 AND commande_id=" . $_SESSION['users']->id . "";
$resultCartBoisson = $dbh->query($sql2);
$countBoisson = $resultCartBoisson->rowCount();
$total_amountBoisson = 0;
?>
<br>
<!-- User data -->
<div class="edge-header">
    <img class="img-fluid" src="img/header/profile.jpg">
</div>
<div class="container free-bird col-md-10 offset-md-1 jumbotron wow fadeInUp">
    <div class="col-md-8 offset-md-2">
        <div>
            <!-- json response will be here -->
            <div class="error_change_pass error_add_address"></div>
            <!-- json response will be here -->

            <!-- Connection -->
            <div class="userTitle">
                <h5>Connection</h5>
            </div>
            <div>
                <div>
                    <!-- Display user connection data -->
                    <label>Username :</label>
                    <input type="text" value="<?= $_SESSION['users']->login ?>" disabled><br>
                    <button id="editPassword" type="button" class="btn btn-outline-info waves-effect">Edit your
                        password
                    </button>
                </div>
                <!-- It is hidden : onclick through the button above : id="editPassword" => it displays -->
                <div id="showEditPassword" hidden>
                    <div class="userTitle">
                        <h5>Password</h5>
                    </div>
                    <form method="post" role="form" id="change_pass" autocomplete="off">
                        <!-- Current Password -->
                        <div class="md-form-password">
                            <label for="old_password">Current password</label>
                            <input type="password" name="old_password" id="old_password" required>
                            <span class="help-block" id="error"></span>
                        </div>
                        <!-- Password New -->
                        <div class="md-form-password">
                            <label for="new_password">New password</label>
                            <input type="password" name="new_password" id="new_password" required>
                            <span class="help-block" id="error"></span>
                        </div>
                        <!-- Confirm Password New -->
                        <div class="md-form-password">
                            <label for="con_newpassword">Confirm your new password</label>
                            <input type="password" name="con_newpassword" id="con_newpassword" required>
                            <span class="help-block" id="error"></span>
                        </div>
                        <!-- Password Send -->
                        <input type="hidden" name="userId" value="<?= $_SESSION['users']->id ?>">

                        <button class="btn btn-outline-info waves-effect" id="btn-change_pass">Submit</button>
                    </form>
                </div>
            </div>

            <!-- Billing address -->
            <div class="userTitle">
                <h5>Billing address</h5>
            </div>
            <div>
                <!-- If the connected user has an address -->
                <?php if (isset($address->adresse) && isset($address->code_postal) && isset($address->ville)): ?>
                    <form method="post" role="form" id="edit_address_form">
                        <div class="md-form-address">
                            <label>Address :</label>
                            <input type="text" value="<?= $address->adresse ?>" disabled><br>
                        </div>
                        <div class="md-form-address">
                            <label>Postal Code :</label>
                            <input type="text" value="<?= $address->code_postal ?>" disabled><br>
                        </div>
                        <div class="md-form-address">
                            <label>City :</label>
                            <input type="text" value="<?= $address->ville ?>" disabled><br>
                        </div>
                        <button type="button" id="editAddress" class="btn btn-outline-info waves-effect">Edit your
                            address
                        </button>
                    </form>
                    <!-- Else : we propose him to add a billing address-->
                <?php else: ?>
                    <p class="hideTextAddress">No billing address</p>
                    <button type="button" id="addAddress" class="btn btn-outline-info waves-effect">Add a
                        billing address
                    </button>
                <?php endif; ?>
                <!-- It is hidden : onclick through the button above : id="editAddress" => it displays -->
                <div id="showAddAddress" hidden>
                    <form method="post" role="form" id="billing_address" autocomplete="off">
                        <?php if (isset($address->adresse)): ?>
                            <!-- Address -->
                            <div class="md-form-address">
                                <label for="address">Address :</label>
                                <input type="text" value="<?= $address->adresse ?>" id="address"
                                       name="address"
                                       class="form-control" required>
                                <span class="help-block" id="error"></span>
                            </div>
                        <?php else: ?>
                            <!-- Address -->
                            <div class="md-form-address">
                                <label for="address">Address :</label>
                                <input type="text" id="address" name="address" class="form-control" required>
                                <span class="help-block" id="error"></span>
                            </div>
                        <?php endif;
                        if (isset($address->code_postal)):?>
                            <!-- Postal Code -->
                            <div class="md-form-address">
                                <label for="postalCode">Postal code :</label>
                                <input type="text" value="<?= $address->code_postal ?>" id="postalCode"
                                       name="postalCode"
                                       class="form-control" required>
                                <span class="help-block" id="error"></span>
                            </div>
                        <?php else: ?>
                            <!-- Postal Code -->
                            <div class="md-form-address">
                                <label for="postalCode">Postal code :</label>
                                <input type="text" id="postalCode" name="postalCode" class="form-control" required>
                                <span class="help-block" id="error"></span>
                            </div>
                        <?php endif;
                        if (isset($address->ville)):?>
                            <!-- City -->
                            <div class="md-form-address">
                                <label for="city">City :</label>
                                <input type="text" value="<?= $address->ville ?>" id="city" name="city"
                                       class="form-control" required>
                                <span class="help-block" id="error"></span>
                            </div>
                        <?php else: ?>
                            <!-- City -->
                            <div class="md-form-address">
                                <label for="city">City :</label>
                                <input type="text" id="city" name="city" class="form-control" required>
                                <span class="help-block" id="error"></span>
                            </div>
                        <?php endif;
                        if (isset($address->id)):?>
                            <!-- Address ID -->
                            <input type="hidden" name="addressId" value="<?= $address->id ?>">
                        <?php endif; ?>
                        <!-- Address Send -->
                        <button class="btn btn-outline-info waves-effect" id="btn-address">Submit</button>
                    </form>
                </div>
            </div>

            <!-- Orders -->
            <div class="userTitle">
                <h5>Orders</h5>
            </div>
            <?php if ($countBurger <= 0 && $countBoisson <= 0): ?>
                <p class="grey-text text-md-center">There is no order</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped ">

                        <!-- ------------------------- BURGERS ------------------------- -->
                        <!--Table head-->
                        <thead class="blue-grey lighten-4">
                        <tr>
                            <th class="text-xs-center">Burger</th>
                            <th></th>
                            <th>Price</th>
                            <th class="text-xs-center">Quantity</th>
                            <th class="text-xs-center">Amount</th>
                        </tr>
                        </thead>
                        <!--/Table head-->

                        <!--Table body-->
                        <tbody>
                        <?php if ($countBurger <= 0):
                            $custom_colspan = 6;
                            ?>
                            <tr>
                                <td class="grey-text text-md-center" colspan="<?php echo $custom_colspan; ?>">
                                    You haven't chosen any burgers.
                                </td>
                            </tr>
                        <?php else:
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
                                </tr>
                            <?php endwhile;
                        endif; ?>
                        </tbody>
                        <!--/Table body-->

                        <!-- ------------------------- BOISSONS ------------------------- -->
                        <!--Table head-->
                        <thead class="blue-grey lighten-4">
                        <tr>
                            <th class="text-xs-center">Drink</th>
                            <th></th>
                            <th>Price</th>
                            <th class="text-xs-center">Quantity</th>
                            <th class="text-xs-center">Amount</th>
                        </tr>
                        </thead>
                        <!--/Table head-->

                        <!--Table body-->
                        <tbody>
                        <?php if ($countBoisson <= 0):
                            $custom_colspan = 6;
                            ?>
                            <tr>
                                <td class="grey-text text-md-center" colspan="<?php echo $custom_colspan; ?>">
                                    You haven't chosen any drinks.
                                </td>
                            </tr>
                        <?php else:
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
                                </tr>
                            <?php endwhile;
                        endif; ?>
                        </tbody>
                        <!--/Table body-->
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>