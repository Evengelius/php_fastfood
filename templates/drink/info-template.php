<?php
// if accessed directly than exit
if(!defined('ABSPATH')) exit;

; ?>

<br>
<img class="img-fluid d-block mx-auto" src="img/product/boissons/<?php echo $drink->image; ?>">

<!--Drink | Info-->
<section class="section section-blog-fw">
	<div class="row">
		<div class="col-md-12 wow fadeIn">
			<!--Drink data-->
			<div class="jumbotron wow fadeIn" data-wow-delay="0.2s">
				<!--Drink | Name-->
				<h1 class="h1-responsive"><?php echo $drink->nom; ?></h1>
				<hr class="mb-1">
				<!--Drink | Insert to Cart-->
				<form id="form-info-product" <?php echo ($drink->quantite_stock == 0) ? 'disabled' : ''; ?>>
					<!--Quantity panel-->
					<!-- Get the drinkId -->
					<input type="hidden" name="idDrink" id="idDrink" value="<?php echo $drink->id; ?>">
					<!-- /.Get the drinkId -->
					
					<div class="card-block">
						<div class="row">
							<div class="col-sm-4">
								<?php if($drink->quantite_stock > 0): ?>
									<div class="md-form">
										<label for="quantity" id="quantity">
											<span class="quantity_hide"><?php _e('Quantity');?></span>
										</label>
										<input type="text" id="qty" name="quantity" class="form-control input-number" value="1" min="1" max="<?php echo $drink->quantite_stock; ?>" readonly="readonly">
								</div>
                            </div>
								<?php else: ?>
                                    <div class="col-sm-12 push-sm-12">
                                        <div class="md-form">
                                            <h3 class="pt-1 pb-1 red-text" style="font-weight: bolder;">
                                                <em><?php _e('Product is out of stock');?>!</em>
                                            </h3>
                                        </div>
                                    </div>
								<?php endif; ?>
							<div class="col-sm-4">
                                <?php if($drink->quantite_stock > 0): ?>
                                    <!--Prix-->
                                    <h1 class="pt-1 pb-1">
                                        <strong><span id="price-amount"><?php echo $drink->prix; ?></span>&euro;</strong>
                                    </h1>
                                <?php endif; ?>
							</div>
							<div class="col-sm-4">
								<br>
								<?php if($drink->quantite_stock > 0): ?>
								<div class="btn-group radio-group" data-toggle="buttons">
									<label class="btn btn-sm btn-primary btn-rounded btn-number" disabled="disabled" data-type="minus" data-field="quantity">
										<input type="radio" name="options" id="option1">&mdash; <!-- &mdash; = -(moins) -->
									</label>
									<label class="btn btn-sm btn-primary btn-rounded btn-number" data-type="plus" data-field="quantity">
										<input type="radio" name="options" id="option2">+
									</label>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<!--/.Quantity panel-->

					<?php if($drink->quantite_stock > 0): ?>
						<!-- Add to Cart | Submit -->
						<div class="card-block">
							<div class="row">
								<div class="col-md-12 text-md-right">
									<button class="btn btn-primary is_selected" onclick="return addToDrinkCart('cart');" id="cart" name="subject" value="cart">
										<i class="fa fa-cart-plus" aria-hidden="true"></i>
                                        <span class="hidden-sm-down">&nbsp;&nbsp;&nbsp;<?php _e('Cart');?></span>
									</button>
								</div>
							</div>
						</div>

						<div class="card-block">
							<div class="row">
							<div id="result_drink" style="display:none;"></div>
							</div>
						</div>
						<!-- /.Add to Cart | Submit -->
					<?php endif; ?>
				</form>
				<!--Drink | Insert to Cart-->
			</div>
			<!--/Drink data-->
		</div>
	</div>
</section>
<!--Drink | Info-->