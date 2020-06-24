<div class="container">
    <?php
    // if accessed directly than exit
    if (!defined('ABSPATH')) exit;

    // Pagination
    $totalDrinks = $dbh->query("SELECT COUNT(*) AS total FROM boisson B")->fetchObject()->total;
    $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;

    $sql = "
        SELECT B.id, B.nom, B.prix, B.description, B.image
        FROM boisson B
        LIMIT " . $limit . ' , ' . MAX_DRINK;
    $resultDrink = $dbh->prepare($sql);
    $resultDrink->execute();
    $count = $resultDrink->rowCount();
    if ($count == 0):?>
        <?php require ABSPATH . 'includes/errors/404.inc.php'; ?>
    <?php else: ?>
        <!-- Drink | Content -->
        <div class="row">
            <div class="col-lg-9">
                <br><br>
                <!-- Drink List -->
                <div class="cats-block" id="ProductData">
                    <section class="section">
                        <!-- Single Drink | Content -->
                        <?php while ($drink = $resultDrink->fetchObject()): ?>
                            <div class="row wow fadeIn">
                                <!--First column-->
                                <div class="col-lg-5 mb-r">
                                    <!--Drink | Image-->
                                    <?php if (!empty($drink->image)): ?>
                                        <div class="view overlay hm-white-slight">
                                            <img src="img/product/boissons/<?php echo $drink->image; ?>"
                                                 class="img-fluid" alt="Drink | Picture">
                                            <div class="mask"></div>
                                        </div>
                                    <?php else: ?>
                                        <div class="view overlay hm-white-slight">
                                            <img src="img/product/boissons/no-img_boisson.png" class="img-fluid"
                                                 alt="Drink | None Picture">
                                            <div class="mask"></div>
                                        </div>
                                    <?php endif ?>
                                    <!--/.Drink | Image-->
                                </div>
                                <!--/First column-->

                                <!--Second column-->
                                <div class="col-lg-7 mb-r">
                                    <!--Drink | Name-->
                                    <h4><?php echo substr($drink->nom, 0, 11) ?>(...)</h4>
                                    <!-- Drink | Price -->
                                    <p class="blue-text" style="font-weight: bold;"><?php echo $drink->prix ?>&nbsp;<i
                                            class="fa fa-eur" aria-hidden="true"></i></p>
                                    <!-- Drink | Description -->
                                    <br>
                                    <p><?php echo substr($drink->description, 0, 200) ?>(...)</p>
                                    <!-- Drink | More details -->
                                    <a href="?page=drink&amp;id=<?php echo $drink->id; ?>"
                                       class="btn btn-secondary waves-effect waves-light">
                                        <i class="fa fa-eye" style="position: relative; bottom: 2px;"
                                           aria-hidden="true"></i>
                                        <span class="hidden-sm-down">View Details</span>
                                    </a>
                                </div>
                                <!--/Second column-->
                            </div>
                        <?php endwhile ?>
                        <!-- /.Single Drink | Content -->
                    </section>
                    <!-- /.Drink List -->
                </div>
            </div>
        </div>
        <?php
        // Affichage de la pagination
        echo '<nav>';
        echo '<ul class="pagination pg-amber">';
        // Flèches gauches
        echo '<li class="page-item"><a class="page-link" href="' . ($limit == 0 ? '#" onclick="return false"' : '?page=drinks&amp;limit=' . ($limit - MAX_DRINK)) . '">&laquo;</a></li>';
        // Valeurs numériques
        for ($i = 0; $i < $totalDrinks / MAX_DRINK; $i++) {
            echo '<li class="page-item ' . ($limit == $i * MAX_DRINK ? 'active' : '') . '"><a class="page-link" href="?page=drinks&amp;limit=' . $i * MAX_DRINK . '">' . ($i + 1) . '</a></li>';
        }
        // Flèches droites
        echo '<li class="page-item"><a class="page-link" href="' . ($limit + MAX_DRINK >= $totalDrinks ? '#" onclick="return false"' : '?page=drinks&amp;limit=' . ($limit + MAX_DRINK)) . '">&raquo;</a></li>';
        echo '</ul></nav>';
    endif; ?>
</div>
