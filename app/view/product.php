<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<?php
					if (!isset($_GET['id'])) {
						echo "Vous n'avez pas entré d'ID";
					}

					else {
						$id = $_GET['id'];
						$p = Phone::getPhoneById($id);

						echo "<h1 style='text-align:center;''>{$p->name}</h1>";

						echo '<div class="col-md-4 col-sm-6 col-xs-12" style="text-align: center; border: 1px solid #ededed; padding: 15px;">';
							
							echo '<span>';
							$colors = explode(",", $p->color);
							foreach($colors as $color){
								$c = Color::getColorById($color);
								echo '<div class="color" style="width:20px; height:20px; float:right; margin-right:5px; background-color:' . $c->hex . '; border:solid 1px silver;" onmouseover="this.style.cursor=\'pointer\';" onmouseout="this.style.cursor=\'\';"" value="' . $c->id . '"></div>';
							}
							echo '</span>';

							echo '<a href="index.php?page=product&id=' . $p->id . '">';
								echo '<img id="phone_img" src="' . Phone::getPhoneThumbnail($p->id) . '" alt="' . $p->name . '" style="width: 250px;">';
							echo '</a>';
						echo '</div>';

						echo '<div class="col-md-4 col-sm-6 col-xs-12" style="border: 1px solid #ededed; padding: 15px;">';
						$b = Brand::getBrandById($p->brand);
						echo '<p>Marque : ' . $b->brand_name . '</p>';
						foreach($p as $e) {
							echo "<p>$e</p>";
						}
						echo '</div>';

						echo '<div class="col-md-4 col-sm-6 col-xs-12" style="text-align: center; border: 1px solid #ededed; padding: 15px;">';
						echo '<span style="font-weight:bolder; font-size:3em;">' . $p->price . ' &euro;</span></br>';
						echo '<span>Quantité : <select>';
						for($i=1;$i<11;$i++){
							echo "<option>$i</option>";
						}
						echo '</select></span></br>';
						$capacities = explode(",", $p->capacity);
						echo '<span style="position:relative; top:10px;">Capacité : <select>';
						foreach($capacities as $e){
							echo "<option>$e</option>";
						}
						echo '</select></span></br>';
						echo '<button type="submit" class="btn btn-default btn-lg" style="margin-top:30px;">Acheter</button>';
						echo '</div>';
					}
				?>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.color').click(function(){
				console.log($(this).attr('value'));
				var id = $(this).attr('value');
				var lien = $('#phone_img').attr('src');
				var res = lien.split(/[-]/);
				var link = "";
				for(var i=0;i<res.length-1;i++){
					link += res[i] + '-';
				}
				link += id + '.jpg';
				$('#phone_img').attr('src', link);
			})
		});
	</script>
</div>
