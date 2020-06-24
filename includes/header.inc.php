<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <?php if ($_GET['page'] == 'home'): ?>
        <title>Burger House | Home</title>
        <meta name="description" content="Burger House, Drinks">
    <?php endif; ?>

    <?php if ($_GET['page'] == 'burgers'): ?>
        <title>Burger House | Burgers</title>
        <meta name="description" content="Burger House, Burgers">
    <?php endif; ?>

    <?php if ($_GET['page'] == 'burger'): ?>
        <title>Burger House | Burger</title>
        <meta name="description" content="Burger House, Burger">
    <?php endif; ?>

    <?php if ($_GET['page'] == 'drinks'): ?>
        <title>Burger House | Drinks</title>
        <meta name="description" content="Burger House, Drinks">
    <?php endif; ?>

    <?php if ($_GET['page'] == 'drink'): ?>
        <title>Burger House | Drink</title>
        <meta name="description" content="Burger House, Drink">
    <?php endif; ?>

    <?php if ($_GET['page'] == 'profile'): ?>
        <title>Burger House | Profile</title>
        <meta name="description" content="Burger House, Profile">
    <?php endif; ?>

    <?php if ($_GET['page'] == 'cart'): ?>
        <title>Burger House | Cart</title>
        <meta name="description" content="Burger House, Cart">
    <?php endif; ?>

    <meta name="keywords" content="html5, molimo, abel">
    <meta name="author" content="Molimo Abel">

    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon.ico">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="css/mdb.css" rel="stylesheet">

    <!-- Data-table css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap4.min.css"/>

    <!-- Material Design Bootstrap -->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- Customizer -->
    <link rel="stylesheet" href="css/customizer.css">
    <!-- Mon CSS Personnel -->
    <link href="css/style.css" rel="stylesheet">

    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
</head>


<body class="fixed-sn red-skin animated">
<!--Double navigation-->
<header>

    <!-- Sidebar navigation -->
    <ul id="slide-out" class="side-nav fixed custom-scrollbar">

        <!--Social-->
        <li>
            <ul class="social">
                <li><a class="icons-sm fb-ic" href="https://www.facebook.com"><i class="fa fa-facebook"> </i></a></li>
                <li><a class="icons-sm pin-ic" href="https://www.pinterest.com"><i class="fa fa-pinterest"> </i></a>
                </li>
                <li><a class="icons-sm gplus-ic" href="https://www.gmail.com"><i class="fa fa-google-plus"> </i></a>
                </li>
                <li><a class="icons-sm tw-ic" href="https://www.twitter.com"><i class="fa fa-twitter"> </i></a></li>
            </ul>
        </li>
        <!--/Social-->

        <!--Search Form-->
        <li>
            <form class="search-form" role="search" action="">
                <div class="form-group waves-light">
                    <input name="search" class="form-control" type="text" placeholder="Search" disabled>
                </div>
            </form>
        </li>
        <!--/.Search Form-->

        <!-- Side navigation links -->
        <li>
            <ul class="collapsible collapsible-accordion">
                <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-home"></i> Burger House<i
                                class="fa fa-angle-down rotate-icon"></i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="?page=home" class="waves-effect">Home</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
        <!--/. Side navigation links -->
    </ul>
    <!--/. Sidebar navigation -->

    <!--Navbar-->
    <nav class="navbar navbar-fixed-top scrolling-navbar double-nav">

        <!-- SideNav slide-out button -->
        <div class="pull-left">
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
        </div>

        <!-- IF LOGGED-->
        <ul class="nav navbar-nav pull-right">

            <?php if (isset($_SESSION['users'])): ?>
                <li class="nav-item ">
                    <a class="nav-link" href="?page=cart">
                        <?php
                        //        <!-- BURGERS -->
                        $sql = " 
                                    SELECT DISTINCT burger_id 
                                    FROM      commande_burger
                                    WHERE     view = 0 AND commande_id=" . $_SESSION['users']->id;
                        $resultBurger = $dbh->query($sql);
                        $countBurger = $resultBurger->rowCount();
                        //        <!-- BOISSONS -->
                        $sql2 = " 
                                    SELECT DISTINCT boisson_id 
                                    FROM      commande_boisson
                                    WHERE     view = 0 AND commande_id=" . $_SESSION['users']->id;
                        $resultBoisson = $dbh->query($sql2);
                        $countBoisson = $resultBoisson->rowCount();
                        $totalCart = $countBurger + $countBoisson;
                        ?>
                        <!-- COUNT TOTAL BURGERS & BOISSONS -->
                        <span class="tag red" id="cart_count"><?= $totalCart ?></span>
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <span class="hidden-sm-down">Cart</span>
                    </a>
                </li>
            <?php endif; ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> Account</a>
                <div class="dropdown-menu dropdown-primary dd-right" aria-labelledby="dropdownMenu1"
                     data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                    <?php if (!isset($_SESSION['users'])): ?>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-register"><i
                                    class="fa fa-user-plus"></i>&nbsp;Sign up</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-login"><i
                                    class="fa fa-sign-in"></i>&nbsp;Sign in</a>
                    <?php else: ?>
                        <a class="dropdown-item" href="#">Hello&nbsp;&nbsp;
                            <strong>
                                <?= $_SESSION['users']->nom ?>&nbsp;<?= $_SESSION['users']->prenom ?>
                            </strong>
                        </a>
                        <a class="dropdown-item" href="?page=profile"><i class="fa fa-user"></i>&nbsp;My account</a>
                        <a class="dropdown-item" href="actions/ajax/login.php"><i class="fa fa-sign-out"></i>&nbsp;Sign
                            out</a>
                    <?php endif ?>
                </div>
            </li>
        </ul>
    </nav>
    <!--/.Navbar-->

    <!-- -------------------------- THE USER MODALS -------------------------- -->

    <!-- Modal Register -->
    <div class="modal fade modal-ext modal-register" id="modal-register" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!-- Modal Register | Container -->
            <div class="modal-content">
                <!-- Modal Register | Form-->
                <form method="post" role="form" id="register-form" autocomplete="off">
                    <!-- Modal Register | Title -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Sign up</h4>
                    </div>
                    <!--/.Modal Register | Title -->

                    <!-- Modal Register | Content -->
                    <div class="modal-body">

                        <!-- json response will be here -->
                        <div id="register_result"></div>
                        <!-- json response will be here -->


                        <div class="progress">
                            <div class="progress-bar progress-bar-custom progress-bar-striped active" role="progressbar"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <!-- Modal Register | Firstname -->
                        <div class="step">
                            <br>
                            <div class="md-form modal_md_form">
                                <i class="fa fa-user prefix"></i>
                                <input type="text" id="firstname" name="firstname" class="form-control" required>
                                <label for="firstname">Firstname</label>
                                <span class="help-block" id="error"></span>
                            </div>

                            <!-- Modal Register | Lastname -->
                            <div class="md-form modal_md_form">
                                <i class="fa fa-circle prefix"></i>
                                <input type="text" id="lastname" name="lastname" class="form-control" required>
                                <label for="lastname">Lastname</label>
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>

                        <!-- Modal Register | Username -->
                        <div class="step">
                            <br>
                            <div class="md-form modal_md_form">
                                <i class="fa fa-user prefix"></i>
                                <input type="text" id="username" name="username" class="form-control" required>
                                <label for="username">Username</label>
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>

                        <!-- Modal Register | Password -->
                        <div class="step">
                            <br>
                            <div class="md-form modal_md_form">
                                <i class="fa fa-lock prefix"></i>
                                <input type="password" id="password" name="password" class="form-control" required>
                                <label for="password">Password</label>
                                <span class="help-block" id="error"></span>
                            </div>

                            <!-- Modal Register | Retype Password -->
                            <div class="md-form modal_md_form">
                                <i class="fa fa-asterisk prefix"></i>
                                <input type="password" id="cpassword" name="cpassword" class="form-control" required>
                                <label for="cpassword">Retype Password</label>
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>

                        <!-- Modal Register | Email -->
                        <div class="step">
                            <br>
                            <div class="md-form modal_md_form">
                                <i class="fa fa-envelope prefix"></i>
                                <input type="email" id="email" name="email" class="form-control"
                                       pattern="[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9.-]+">
                                <label for="email">Mail</label>
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>

                        <!-- Modal Login | Check -->
                        <?php
                        $number_a = rand(1, 5);
                        $number_b = rand(0, 4);
                        $_SESSION['register_valid_operation'] = $number_a + $number_b;
                        ?>
                        <div class="step">
                            <br>
                            <div class="md-form modal_md_form">
                                <i class="fa fa-calculator prefix"></i>
                                <input type="text" id="register_result" name="register_result" class="form-control"
                                       required>
                                <label for="register_result"><?php echo($number_a) ?> + <?php echo($number_b) ?> =
                                    ?</label>
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                        <br>
                        <div class="step display">
                            <h5>&nbsp;&nbsp;&nbsp;Confirm details</h5>
                            <br>
                            <div class="modal_md_form">
                                <div>
                                    <label class="col-xs-2 control-label">Firstname</label>
                                    <div class="col-xs-10">
                                        <label data-id="firstname"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal_md_form">
                                <label class="col-xs-2 control-label">Lastname</label>
                                <div class="col-xs-10">
                                    <label data-id="lastname"></label>
                                </div>
                            </div>
                            <div class="modal_md_form">
                                <label class="col-xs-2 control-label">Username</label>
                                <div class="col-xs-10">
                                    <label data-id="username"></label>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Register | Send -->
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="pull-left">
                                    <button type="button" class="action back btn btn-primary">Back</button>
                                    <button type="button" class="action next btn btn-primary">Next</button>
                                    <button class="action submit btn btn-primary" id="btn-signup">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--/.Modal Register | Content -->

                    <!--Footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
                <!--/.Modal Register | Form-->
            </div>
            <!--/.Modal Register | Container -->
        </div>
    </div>
    <!--/ Modal Register -->

    <!-- Modal Login -->
    <div class="modal fade modal-ext modal-login" id="modal-login" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!-- Modal Login | Container-->
            <div class="modal-content">
                <!-- Modal Login | Form-->
                <form method="post" role="form" id="login-form" autocomplete="off">
                    <!-- Modal Login | Title -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Sign in</h4>
                    </div>
                    <!--/.Modal Login | Title -->

                    <!-- Modal Login | Content -->
                    <div class="modal-body">

                        <!-- json response will be here -->
                        <div id="login_result"></div>
                        <br>
                        <!-- json response will be here -->

                        <!-- Modal Login | Username -->
                        <div class="md-form modal_md_form">
                            <i class="fa fa-user prefix"></i>
                            <input type="text" id="username" name="username" class="form-control" required>
                            <label for="username">Username</label>
                            <span class="help-block" id="error"></span>
                        </div>

                        <!-- Modal Login | Password -->
                        <div class="md-form modal_md_form">
                            <i class="fa fa-lock prefix"></i>
                            <input type="password" id="password" name="password" class="form-control" required>
                            <label for="password">Password</label>
                            <span class="help-block" id="error"></span>
                        </div>

                        <!-- Modal Login | Check -->
                        <?php
                        $num_a = rand(1, 5);
                        $num_b = rand(0, 4);
                        $_SESSION['valid_operation'] = $num_a + $num_b;
                        ?>
                        <div class="md-form modal_md_form">
                            <i class="fa fa-calculator prefix"></i>
                            <input type="text" id="valid_result" name="valid_result" class="form-control" required>
                            <label for="valid_result"><?php echo($num_a) ?> + <?php echo($num_b) ?> = ?</label>
                            <span class="help-block" id="error"></span>
                        </div>

                        <!-- Modal Login | Send -->
                        <div class="text-xs-center">
                            <button class="btn btn-primary" name="submit" id="btn-signin">Submit</button>
                        </div>
                    </div>
                    <!--/.Modal Login | Content -->

                    <!--Footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
                <!--/.Modal Login | Form-->
            </div>
            <!--/.Modal Login | Container-->
        </div>
    </div>
    <!--/ Modal login -->
</header>
<!--/Double navigation-->