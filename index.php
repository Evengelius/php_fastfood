<?php
session_start();
if (!defined('ABSPATH'))
    define('ABSPATH', dirname(__FILE__) . '/');
// Root folder => We make sure we are in this root folder and not anywhere else.

require ABSPATH . 'includes/config.inc.php';
require ABSPATH . 'includes/functions.php';

// Autoload.
spl_autoload_register(function ($class) {
    require_once ABSPATH . 'lib/' . $class . '.php';
});

// Connexion.
$dbh = DB::getInstance();
// Class
$helper = new Helper();

// Requête
$_GET['page'] = isset($_GET['page']) ? $_GET['page'] : 'home';
// If the RequestGet page does exist, we set it to its value from the URL, else we set it to home.
require ABSPATH . '/includes/header.inc.php'; // Constante magique (retourne le chemin absolu).
?>
    <!--Main layout-->
    <main>
        <?php if ($_GET['page'] == 'home'): ?>

            <?php get_template_part('home'); ?>

        <?php elseif ($_GET['page'] == 'burger'): ?>

            <?php get_template_part('burger'); ?>

        <?php elseif ($_GET['page'] == 'burgers'): ?>

            <?php get_template_part('burgers'); ?>

        <?php elseif ($_GET['page'] == 'drink'): ?>

            <?php get_template_part('drink'); ?>

        <?php elseif ($_GET['page'] == 'drinks'): ?>

            <?php get_template_part('drinks'); ?>

        <?php elseif ($_GET['page'] == 'profile'): ?>

            <?php get_template_part('profile'); ?>

        <?php elseif ($_GET['page'] == 'cart'): ?>

            <?php get_template_part('cart'); ?>
        <?php else: ?>

            <?php get_template_part('error'); ?>

        <?php endif; ?>
    </main>
    <!--/Main layout-->
<?php
require ABSPATH . '/includes/footer.inc.php';