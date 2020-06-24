<?php
// if accessed directly than exit
if(!defined('ABSPATH')) exit;
?>
<!-- Burger | Content -->
<section id="burgerDetails">
	<!-- Burger | Row-->
	<div class="row">
		<!-- Burger | Content -->
		<div class="col-md-12">
			<!--Accordion wrapper-->
			<div class="product-accordion accordion mb-r" id="accordion" role="tablist" aria-multiselectable="true">
				<!--Storage panel-->
				<div class="panel panel-default">
					<!--Storage heading-->
					<div class="panel-heading" role="tab" id="headingTwo">
						<h5 class="panel-title">
							<a class="arrow-r" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
								Storage
								<i class="fa fa-angle-down rotate-icon"></i>
							</a>
						</h5>
					</div>
					<!--Storage body-->
					<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
						<?php echo ($burger->quantite_stock > 0) ? $burger->quantite_stock.' burger(s) available.' : 'Out of stock'; ?>
					</div>
				</div>
				<!--/.Storage panel-->

				<!--Description panel-->
				<div class="panel panel-default">
					<!--Description heading-->
					<div class="panel-heading" role="tab" id="headingThree">
						<h5 class="panel-title">
							<a class="arrow-r" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
								Description
								<i class="fa fa-angle-down rotate-icon"></i>
							</a>
						</h5>
					</div>
					<!--Description body-->
					<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
						<?php echo (empty($burger->description)) ? 'No description available' : $burger->description; ?>
					</div>
				</div>
				<!--/.Description panel-->

				<!--Recette panel-->
				<div class="panel panel-default">
					<!--Recette heading-->
					<div class="panel-heading" role="tab" id="headingFour">
						<h5 class="panel-title">
							<a class="arrow-r" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
								Recette
								<i class="fa fa-angle-down rotate-icon"></i>
							</a>
						</h5>
					</div>
					<!--Recette body-->
					<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
						<?php echo (empty($burger->recette)) ? 'No details available' : $burger->recette; ?>
					</div>
				</div>
				<!--/.Recette panel-->
			</div>
			<!--/.Accordion wrapper-->
		</div>
		<!--/.Burger | Content -->
	</div>
	<!--/.Burger | Row-->
</section>
<!--/.Burger | Content -->