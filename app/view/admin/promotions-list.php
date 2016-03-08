<div class="col-md-12">
	<h1>Liste des promotions</h1>
	<?php if (Promotion::getPromotionsList()) : ?>
		<table class="table table-striped">
			<thead>
				<th>#</th>
				<th>Téléphone</th>
				<th>Pourcentage</th>
				<th>Prix de base</th>
				<th>Prix réduit</th>
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
						echo '<td><a href="index.php?page=admin/promotion-edit&amp;id=' . $promotion->id . '"><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';
						echo '<td><a href="#"><i class="fa fa-trash" data-toggle="tooltip" title="Supprimer"></i></a></td>';
					echo '</tr>';
				}
			?>
		</table>
	<?php
		else :
			echo '<p>Aucune promotion n\'a été ajouté.</p>';
		endif;
	?>
</div>