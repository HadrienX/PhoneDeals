<style type="text/css">
	.badge.old-price::before {
		transform: rotate(-45deg) translate(-6px, 4px);
		border: 1px solid #777;
		display: block;
		content: '';
		width: 25px;
	}
	.unactive {
		opacity: 0.15;
	}
</style>

<?php
	$url = 'index.php?page=list';
	$sort = array(
		'brand' => null,
		'color' => null,
		'capacity' => null
	);
	$toaddurl =array (
		'brand' => "",
		'color' => "",
		'capacity' => ""
	);
	if (isset($_GET['brand'])) {
		$sort['brand'] = htmlentities($_GET['brand']);
		//$url .= '&brand=' . $sort['brand'];
		$toaddurl['brand']='&brand=' . $sort['brand'];
	}
	if (isset($_GET['color'])) {
		$sort['color'] = htmlentities($_GET['color']);
		//$url .= '&color=' . $sort['color'];
		$toaddurl['color']='&color=' . $sort['color'];
	}
	if (isset($_GET['capacity'])) {
		$sort['capacity'] = htmlentities($_GET['capacity']);
		//$url .= '&capacity=' . $sort['capacity'];
		$toaddurl['capacity']=	'&capacity=' . $sort['capacity'];
	}
?>

<div class="container">
	<div class="row">
		<div class="col-md-12 page-header">
			<h1>Liste des téléphones</h1>
		</div>
	</div>

	<div class="row">
		<!-- STAR SORT -->
		<div class="col-md-3">
			<!-- START BRAND -->
			<div style="display: block; width: 100%; overflow: hidden;">
				<h4>Marques</h4>
				<div class="list-group">
					<?php
						$newurl=$url.$toaddurl['capacity'].$toaddurl['color'];
						foreach (Brand::getBrandList() as $brand) {
							$active = ($sort['brand'] == strtolower($brand->name)) ? ' active' : '';
							echo '<a href="' . $newurl . '&brand=' . strtolower($brand->name) . '" class="list-group-item' . $active . '">' . $brand->name . '</a>';
						}
					?>
				</div>
			</div>
			<!-- END BRAND -->
			<!-- START COLOR -->
			<div style="display: block; width: 100%; overflow: hidden;">
				<h4>Couleur</h4>
				<ul style="list-style: none; margin: 0; padding: 0; width: 195px;">
					<?php
						$newurl=$url.$toaddurl['brand'].$toaddurl['capacity'];
						foreach (Color::getColorList() as $color) {
							$unactive = ($sort['color'] != $color->id) ? ' class="unactive"' : '';
							echo '<li style="float: left; margin: 0 0 10px 10px;"><a href="' . $newurl . '&color=' . strtolower($color->id) . '" ' . $unactive . 'style="background: ' . $color->hex . '; border: 1px solid #ededed; display: inline-block; width: 30px; height: 30px; border-radius: 30px;" title="' . $color->name . '"></a></li>';
						}
					?>
				</ul>
			</div>
			<!-- END COLOR -->
			<!-- START CAPACITY -->
			<div style="display: block; width: 100%; overflow: hidden;">
				<h4>Capacité</h4>
				<div class="list-group">
					<?php
						$newurl=$url.$toaddurl['brand'].$toaddurl['color'];
						foreach (Capacity::getCapacityList() as $capacity) {
							$active = ($sort['capacity'] == $capacity->storage) ? ' active' : '';
							echo '<a href="' . $newurl . '&capacity=' . $capacity->storage . '" class="list-group-item' . $active . '">' . $capacity->storage . ' Go</a>';
						}
					?>
				</div>
			</div>
			<!-- END CAPACITY -->
		</div>
		<!-- END SORT -->
		<div class="col-md-9">
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
								
								if (isset($phone->promotionPrice)) {
									echo '<span class="badge old-price" style="background-color: transparent; color: #777;">' . $phone->price . ' &euro;</span> <span class="badge" style="background: #e74c3c;">' . $phone->promotionPrice . ' &euro;</span>';
								}
								else {
									echo '<span class="badge">' . $phone->price . ' &euro;</span>';
								}
							echo '</div>';
						echo '</div>';
					}
				?>
			</div>
		</div>
	</div>
</div>