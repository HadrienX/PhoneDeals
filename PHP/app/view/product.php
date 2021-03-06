<div class="container">
	<div class="row">
		<?php
			if (!isset($_GET['id']) || empty($_GET['id'])) {
				App::redirect('index.php?page=list');
			}
			
			else {
				$id = $_GET['id'];
				$phone = Phone::getPhoneById($id);
				$promotion = Promotion::getPromotionByPhoneId($phone->id);
				$brand = Brand::getBrandById($phone->brand);
		?>
			<div class="col-sm-12" style="margin-bottom: 30px;">
				<h1 style="margin-bottom: 0;"><?php echo $phone->name; ?></h1>
				<span style="color: #bfbfbf; display: block; font-size: 18px;"><?php echo $brand->name; ?></span>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<a href="index.php?page=product&amp;id=<?php echo $phone->id; ?>" style="display: inline-block; padding: 15px; border: 1px solid #ededed;">
					<img id="phone_img" src="<?php echo Phone::getPhoneThumbnail($phone->id); ?>" alt="<?php echo $phone->name; ?>" style="width: 300px;">
				</a>
				<div id="phone-colors" style="text-align: center; margin-top: 15px;">
					<?php
						$colors = explode(',', $phone->color);
						
						foreach($colors as $color) {
							$c = Color::getColorById($color);
							echo '<div class="color" style="width:20px; height:20px; display: inline-block; border-radius: 20px; margin-right:5px; background-color:' . $c->hex . '; border:solid 1px silver;" onmouseover="this.style.cursor=\'pointer\';" onmouseout="this.style.cursor=\'\';" value="' . $c->id . '" title="' . $c->name . '"></div>';
						}
					?>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<?php
					if ($promotion) {
						echo '<span style="font-weight:bolder; font-size:3em;">' . Promotion::getNewPrice($promotion->phone) . ' &euro;</span>';
						echo ' Au lieu de ' . $phone->price . ' &euro; <span class="badge" style="background-color: #e85142;">Promotion</span><br />';
						echo 'Économisez ' . Promotion::getPromotionByPhoneId($phone->id)->percent . ' %';
					}

					else {
						echo '<span style="font-weight:bolder; font-size:3em;">' . $phone->price . ' &euro;</span><br />';
					}
				?>
				<form action="index.php?page=cart" method="POST">
					<div id="amount" style="margin-top: 30px;">
						Quantité :
						<select name="amount">
							<?php
								for ($i = 1; $i < 11; $i++) {
									echo '<option>' . $i . '</option>';
								}
							?>
						</select>
					</div>
					<div id="capacity" style="margin-top: 10px;">
						<?php $capacities = explode(',', $phone->capacity); ?>
						Capacité :
						<select name="capacity">
							<?php
								foreach($capacities as $e) {
									echo '<option value="' . $e . '">' . $e . ' Go</option>';
								}
							?>
						</select>
					</div>
					<div id="color" style="margin-top: 10px;">
						<?php $colors = explode(',', $phone->color); ?>
						Couleur :
						<select name="color">
							<?php
								foreach($colors as $color) {
									$c = Color::getColorById($color);
									echo '<option value="' . $c->id . '">' . $c->name . '</option>';
								}
							?>
						</select>
					</div>
					<input type="hidden" name="id" value="<?php echo $phone->id; ?>">
					<input type="hidden" name="action" value="add">
					<button type="submit" class="btn btn-primary btn-lg" style="margin-top:30px;">Acheter</button>
				</form>
			</div>
			<div class="col-md-12">
				<h3>Description</h3>
				<p><?php echo $phone->description; ?></p>
			</div>
		<?php
			}
		?>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.color').click(function() {
				var id = $(this).attr('value');
				var oldLink = $('#phone_img').attr('src');
				var result = oldLink.split(/[-]/);
				var link = '';

				for (var i = 0; i < result.length - 1; i++) {
					link += result[i] + '-';
				}

				link += id + '.jpg';
				$('#phone_img').attr('src', link);
			})
		});
	</script>
</div>