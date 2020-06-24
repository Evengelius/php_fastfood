<div class="container">
    <?php
    // if accessed directly than exit
    if (!defined('ABSPATH')) exit;

    // Pagination
    $totalBurgers = $dbh->query("SELECT COUNT(*) AS total FROM burger B")->fetchObject()->total;
    $limit = isset($_GET['limit']) ? $_GET['limit'] : 0;

    $sql = "
        SELECT B.id, B.nom, B.prix, B.description, B.image
        FROM burger B
        LIMIT " . $limit . ' , ' . MAX_BURGER;
    $resultBurger = $dbh->prepare($sql);
    $resultBurger->execute();
    $count = $resultBurger->rowCount();
    if ($count == 0):?>
        <?php require ABSPATH . 'includes/errors/404.inc.php'; ?>
    <?php else: ?>
        <!-- Burger | Content -->
        <div class="row">
            <div class="col-lg-9">
                <br><br>
                <!-- Burger List (shown with "while" loop) -->
                <div class="cats-block" id="ProductData">
                    <section class="section">
                        <!-- Single Burger | Content -->
                        <?php while ($burger = $resultBurger->fetchObject()): ?>
                            <div class="row wow fadeIn">
                                <!--First column-->
                                <div class="col-lg-5 mb-r">
                                    <!--Burger | Image-->
                                    <?php if (!empty($burger->image)): ?>
                                        <div class="view overlay hm-white-slight">
                                            <img src="img/product/burgers/<?php echo $burger->image; ?>"
                                                 class="img-fluid" alt="Burger | Picture">
                                            <div class="mask"></div>
                                        </div>
                                    <?php else: ?>
                                        <div class="view overlay hm-white-slight">
                                            <img src="img/product/burgers/no-img_burger.png" class="img-fluid"
                                                 alt="Burger | None Picture">
                                            <div class="mask"></div>
                                        </div>
                                    <?php endif ?>
                                    <!--/.Burger | Image-->
                                </div>
                                <!--/First column-->

                                <!--Second column-->
                                <div class="col-lg-7 mb-r">
                                    <!--Burger | Name-->
                                    <h4><?php echo substr($burger->nom, 0, 11) ?>(...)</h4>
                                    <!-- Burger | Price -->
                                    <p class="blue-text" style="font-weight: bold;"><?php echo $burger->prix ?>&nbsp;<i
                                                class="fa fa-eur" aria-hidden="true"></i></p>
                                    <!-- Burger | Description -->
                                    <br>
                                    <p><?php echo substr($burger->description, 0, 200) ?>(...)</p>
                                    <!-- Burger | More details -->
                                    <a href="?page=burger&amp;id=<?php echo $burger->id; ?>"
                                       class="btn btn-secondary waves-effect waves-light">
                                        <i class="fa fa-eye" style="position: relative; bottom: 2px;"
                                           aria-hidden="true"></i>
                                        <span class="hidden-sm-down">View Details</span>
                                    </a>
                                </div>
                                <!--/Second column-->
                            </div>
                        <?php endwhile ?>
                        <!-- /.Single Burger | Content -->
                    </section>
                    <!-- /.Burger List -->
                </div>
            </div>
        </div>
        <?php
        // Affichage de la pagination
        echo '<nav>';
        echo '<ul class="pagination pg-amber">';
        // Flèches gauches
        echo '<li class="page-item"><a class="page-link" href="' . ($limit == 0 ? '#" onclick="return false"' : '?page=burgers&amp;limit=' . ($limit - MAX_BURGER)) . '">&laquo;</a></li>';
        // Valeurs numériques
        for ($i = 0; $i < $totalBurgers / MAX_BURGER; $i++) {
            echo '<li class="page-item ' . ($limit == $i * MAX_BURGER ? 'active' : '') . '"><a class="page-link" href="?page=burgers&amp;limit=' . $i * MAX_BURGER . '">' . ($i + 1) . '</a></li>';
        }
        // Flèches droites
        echo '<li class="page-item"><a class="page-link" href="' . ($limit + MAX_BURGER >= $totalBurgers ? '#" onclick="return false"' : '?page=burgers&amp;limit=' . ($limit + MAX_BURGER)) . '">&raquo;</a></li>';
        echo '</ul></nav>';
    endif; ?>
</div>
