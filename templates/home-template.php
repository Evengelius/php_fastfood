<?php
// if accessed directly than exit
if (!defined('ABSPATH')) exit;

$template_folder = 'home';
?>
<!-- Main Container | HOME PAGE -->
<div class="container">
    <?php if (!empty($_SESSION['msg'])): ?>
        <div class="alert alert-info flex-center row wow fadeIn" role="alert">
            <strong><?php echo $_SESSION['msg'] ?></strong>
        </div>
        <?php unset($_SESSION['msg']);
        endif; ?>
    <?php require ABSPATH . 'includes/slider.inc.php'; ?>

    <?php get_template_part('our-menu', $template_folder); ?>

</div>
<!-- /.Main Container -->