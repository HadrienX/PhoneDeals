<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h2>Téléphones</h2>
			<div class="row">
				<?php
					foreach (Phone::getPhonesList() as $phone) {
						echo '<div class="col-xs-12 col-md-4" style="text-align: center">';
							echo '<div style="border: 1px solid #ededed; padding: 15px;>';
								echo '<a href="index.php?page=product&id=' . $phone->id . '" class="thumbnail">';
								echo '<img src="" alt="">';
								echo $phone->name;
								echo '</a>';
							echo '</div>';
						echo '</div>';
					}

					// echo '<pre>';
					// 	var_dump($phonesList);
					// echo '</pre>';

					// $p = Phone::getPhonesList($id);
					
					// echo "<h1>{$p->name}</h1>";
					
					// foreach($p as $e) {
					// 	echo "$e<br/>";
					// }
				?>
			</div>
		</div>

		<div class="col-md-4">
			<h2>Promotions</h2>
			<p>Aucune promotion en ce moment</p>
		</div>
	</div>
</div>