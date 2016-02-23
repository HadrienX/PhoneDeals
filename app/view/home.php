<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h2>Téléphones</h2>
			<div class="row">
				<?php
					foreach (Phone::getPhonesList() as $phone) {
						if (Promotion::getPromotionByPhoneId($phone->id)) {
							$phone->promotionPrice = $phone->price - ((Promotion::getPromotionByPhoneId($phone->id)->percent) * 0.01) * $phone->price;
						}

						echo '<div class="col-md-4 col-sm-6 col-xs-12" style="text-align: center">';
							echo '<div style="border: 1px solid #ededed; padding: 30px; margin: 20px 0;">';
								echo '<a href="index.php?page=product&id=' . $phone->id . '">';
									echo '<img src="' . Phone::getPhoneThumbnail($phone->id) . '" alt="' . $phone->name . '" style="width: 100px;">';
									echo '<h4>' . $phone->name . '</h4>';
								echo '</a>';
								echo '<span class="badge">';
									if (isset($phone->promotionPrice)) {
										echo $phone->promotionPrice . ' &euro; au lieu de ' . $phone->price;
									}

									else {
										echo $phone->price;
									}
								echo '&euro;</span>';
							echo '</div>';
						echo '</div>';
					}
				?>
			</div>
		</div>

		<div class="col-md-4">
			<h2>Promotions</h2>
			<?php
				if (Promotion::getPromotionsList()) {
					echo '<div class="list-group">';
						foreach (Promotion::getPromotionsList() as $promotion) {
							echo '<a href="index.php?page=product&id=' . $promotion->phone . '" class="list-group-item">';
								echo Phone::getPhoneById($promotion->phone)->name;
								echo ' <span style="background-color: #e85142;" class="badge">- ' . $promotion->percent . ' %</span>';
							echo '</a>';
						}
					echo '</div>';
				}

				else {
					echo '<p>Aucune promotion en ce moment</p>';
				}
			?>
		</div>
	</div>
</div>
