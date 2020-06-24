<?php
// if accessed directly than exit
if (!defined('ABSPATH')) exit;

$template_folder = 'drink';
?>
<!-- Main Container | PRODUCT INFO -->
<div class="container">
    <?php
    if (isset($_GET['id'])):
        $sql = " 
                SELECT B.id,
                B.nom, B.prix,
                B.description, B.image,
                B.calories, B.quantite_stock
                FROM boisson B
                WHERE B.id = :id";
        $result = $dbh->prepare($sql);
        $result->execute(['id' => $_GET['id']]);
        // Execution de la requête sql
        $count = $result->rowCount();
        if ($count == 0 || empty($_GET['id'])): ?>
            <?php require ABSPATH . 'includes/errors/404.inc.php'; ?>
        <?php else: ?>
            <?php $drink = $result->fetchObject(); ?>

            <?php get_template_part('info', $template_folder, array('result' => $result, 'drink' => $drink)); ?>

            <hr class="between-sections">

            <?php get_template_part('content', $template_folder, array('result' => $result, 'drink' => $drink)); ?>

            <hr class="between-sections">

            <?php get_template_part('related-product', $template_folder, array('result' => $result, 'drink' => $drink)); ?>

        <?php endif;
    else:
        require ABSPATH . 'includes/errors/404.inc.php';
    endif; ?>
</div>
<!-- /.Main Container -->