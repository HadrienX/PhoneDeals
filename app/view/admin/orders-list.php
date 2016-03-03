<div class="col-md-12">
	<h1>Liste des commandes</h1>
	<table class="table table-striped">
		<thead>
			<th>#</th>
			<th>Membre</th>
			<th>Date</th>
			<th>Prix HT</th>
			<th>Prix TTC</th>
			<th>Méthode d'envoi</th>
			<th>Téléphone</th>
			<th></th>
			<th></th>
		</thead>
		<?php
			foreach (Promotion::getPromotionsList() as $promotion) {
				echo '<tr>';
					echo '<td>' . $member->id . '</td>';
					echo '<td><a href="index.php?page=admin/promotion-edit&amp;id=' . $promotion->id . '">' . Phone::getPhoneById($promotion->phone)->name . '</a></td>';
					echo '<td>' . $promotion->percent . ' %</td>';
					echo '<td>' . Phone::getPhoneById($promotion->phone)->price . ' &euro;</td>';
					echo '<td>' . Promotion::getNewPrice($promotion->phone) . ' &euro;</td>';
					echo '<td><a href="index.php?page=admin/promotion-edit&amp;id=' . $promotion->id . '"><i class="fa fa-pencil"></i></a></td>';
					echo '<td><a href="#"><i class="fa fa-trash"></i></a></td>';
				echo '</tr>';
			}
		?>
	</table>
</div>