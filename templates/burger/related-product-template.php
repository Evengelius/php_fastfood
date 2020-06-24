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
            B.recette, B.quantite_stock
            FROM burger B
            WHERE B.id != $burger->id
            ORDER BY RAND()
            LIMIT 2";
	$resultRelated = $dbh->query($sql);
    $countRelated = $resultRelated->rowCount();
	$r = 1;
    if ( $countRelated > 0):
	while($burgerRelated = $resultRelated->fetchObject()): ?>
	<!-- Related Burger | Content -->
	<div class="col-lg-6 col-sm-6 mb-1">
		<!-- Related Burger | Card Content -->
		<div class="card card-cascade narrower">
			<!--Burger Related | Image-->
			<?php
			if(!empty($burgerRelated->image)): ?>
				<div class="view overlay hm-white-slight">
					<img src="img/product/burgers/<?php echo $burgerRelated->image;?>" class="img-fluid" alt="Burger Related | Picture">
					<div class="mask"></div>
				</div>
			<?php else: ?>
				<div class="view overlay hm-white-slight">
					<img src="img/product/burgers/no-img_burger.png" class="img-fluid" alt="Burger Related | None Picture">
					<div class="mask"></div>
				</div>
			<?php endif;?>
			<div class="mask waves-light"></div>
			<!--/.Burger Related | Image-->

			<!-- Card content -->
			<div class="card-block text-xs-center">
				<!-- Description -->
				<p class="card-text"><?php echo (!empty($burgerRelated->description)) ? substr($burgerRelated->description,0,98).'(...)' : __('No description available') ;?></p>

				<!-- Card footer -->
				<div class="card-footer">
					<span class="left"><?php echo $burgerRelated->prix;?>&euro;</span>
					<span class="right">
						<span data-placement="bottom" data-toggle="tooltip" title="Go to the product">
							<a class="" href="?page=burger&id=<?php echo $burgerRelated->id;?>">
								<i class="fa fa-eye"></i>
							</a>
						</span>
					</span>
				</div>
				<!-- /.Card footer -->
			</div>
			<!-- /.Card content -->
		</div>
		<!-- /. Related Burger | Card Content -->
	</div>
	<!-- /.Related Burger | Content -->
    <?php endwhile;
    else:?>
        <p class="text-xs-center text-color">There is no related burger.</p>
    <?php endif;?>


</div>
<!-- /.Related Products | Content -->