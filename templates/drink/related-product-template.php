<?php
// if accessed directly than exit
if(!defined('ABSPATH')) exit;

;?>
<!-- Related Products | Content -->
<div class="row pb-4">
	<div class="col-lg-12 pb-4">
		<h1 class="section-heading"><?php _e('Related Products');?>	</h1>
	</div>
	<?php
	$sql = "
            SELECT B.id,
            B.nom, B.prix,
            B.description, B.image,
            B.calories, B.quantite_stock
            FROM boisson B
            WHERE B.id != $drink->id
            ORDER BY RAND()
            LIMIT 2";
	$resultRelated = $dbh->query($sql);
    $countRelated = $resultRelated->rowCount();
	$r = 1;
    if ( $countRelated > 0):
	while($drinkRelated = $resultRelated->fetchObject()): ?>
	<!-- Related Drink | Content -->
	<div class="col-lg-6 col-sm-6 mb-1">
		<!-- Related Drink | Card Content -->
		<div class="card card-cascade narrower">
			<!--Drink Related | Image-->
			<?php
			if(!empty($drinkRelated->image)): ?>
				<div class="view overlay hm-white-slight">
					<img src="img/product/boissons/<?php echo $drinkRelated->image;?>" class="img-fluid" alt="Drink Related | Picture">
					<div class="mask"></div>
				</div>
			<?php else: ?>
				<div class="view overlay hm-white-slight">
					<img src="img/product/boisson/no-img_boisson.png" class="img-fluid" alt="Drink Related | None Picture">
					<div class="mask"></div>
				</div>
			<?php endif;?>
			<div class="mask waves-light"></div>
			<!--/.Drink Related | Image-->

			<!-- Card content -->
			<div class="card-block text-xs-center">
				<!-- Description -->
				<p class="card-text"><?php echo (!empty($drinkRelated->description)) ? substr($drinkRelated->description,0,98).'(...)' : __('No description available') ;?></p>

				<!-- Card footer -->
				<div class="card-footer">
					<span class="left"><?php echo $drinkRelated->prix;?>&euro;</span>
					<span class="right">
						<span data-placement="bottom" data-toggle="tooltip" title="Go to the product">
							<a class="" href="?page=drink&id=<?php echo $drinkRelated->id;?>">
								<i class="fa fa-eye"></i>
							</a>
						</span>
					</span>
				</div>
				<!-- /.Card footer -->
			</div>
			<!-- /.Card content -->
		</div>
		<!-- /. Related Drink | Card Content -->
	</div>
	<!-- /.Related Drink | Content -->
    <?php endwhile;
    else:?>
        <p class="text-xs-center text-color">There is no related drink.</p>
    <?php endif;?>


</div>
<!-- /.Related Products | Content -->