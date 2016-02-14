<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h2>Téléphones</h2>
			<div class="row">
				<?php
					foreach (Phone::getPhonesList() as $phone) {
						echo '<div class="col-md-4 col-sm-6 col-xs-12" style="text-align: center">';
							echo '<div style="border: 1px solid #ededed; padding: 15px;">';
								echo '<a href="index.php?page=product&id=' . $phone->id . '">';
									echo '<img src="' . Phone::getPhoneThumbnail($phone->id) . '" alt="' . $phone->name . '" style="width: 100px;">';
									echo '<h4>' . $phone->name . '</h4>';
								echo '</a>';
								echo '<span class="badge">' . $phone->price . ' &euro;</span>';
							echo '</div>';
						echo '</div>';
					}
				?>
			</div>
		</div>

		<div class="col-md-4">
			<h2>Promotions</h2>
			<p>Aucune promotion en ce moment</p>
		</div>
	</div>
</div>
