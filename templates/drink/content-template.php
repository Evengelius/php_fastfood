<?php
// if accessed directly than exit
if(!defined('ABSPATH')) exit;
?>
<!-- Drink | Content -->
<section id="drinkDetails">
	<!-- Drink | Row-->
	<div class="row">
		<!-- Drink | Content -->
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
						<?php echo ($drink->quantite_stock > 0) ? $drink->quantite_stock.' drink(s) available.' : 'Out of stock'; ?>
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
						<?php echo (empty($drink->description)) ? 'No description available' : $drink->description; ?>
					</div>
				</div>
				<!--/.Description panel-->

				<!--Calories panel-->
				<div class="panel panel-default">
					<!--Calories heading-->
					<div class="panel-heading" role="tab" id="headingFour">
						<h5 class="panel-title">
							<a class="arrow-r" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
								Calories
								<i class="fa fa-angle-down rotate-icon"></i>
							</a>
						</h5>
					</div>
					<!--Calories body-->
					<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
						<?php echo $drink->calories; ?>
					</div>
				</div>
				<!--/.Calories panel-->
			</div>
			<!--/.Accordion wrapper-->
		</div>
		<!--/.Drink | Content -->
	</div>
	<!--/.Drink | Row-->
</section>
<!--/.Drink | Content -->