<div class="col-md-12">
	<h1>Liste des téléphones</h1>
	<table class="table table-striped">
		<thead>
			<th>#</th>
			<th>Nom</th>
			<th>Marque</th>
			<th>Capacité</th>
			<th>Prix</th>
			<th>Couleur</th>
			<th>Description</th>
			<th></th>
			<th></th>
		</thead>
		<?php
			foreach (Phone::getPhonesList() as $phone) {
				echo '<tr>';
					echo '<td>' . $phone->id . '</td>';
					echo '<td><a href="index.php?page=admin/phone-edit&amp;id=' . $phone->id . '">' . $phone->name . '</a></td>';
					echo '<td>' . Brand::getBrandById($phone->brand) . '</td>';
					echo '<td>' . $phone->capacity . ' Go</td>';
					echo '<td>' . money_format('%!i', $phone->price) . ' &euro;</td>';
					echo '<td>' . Color::getColorsNames($phone->color, true) . '</td>';
					echo '<td style="max-width: 400px;">' . $phone->description . '</td>';

					echo '<td><a href="index.php?page=admin/phone-edit&amp;id=' . $phone->id . '"><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';
					echo '<td><a href="#"><i class="fa fa-trash" data-toggle="tooltip" title="Supprimer"></i></a></td>';
				echo '</tr>';
			}
		?>
	</table>
</div>
