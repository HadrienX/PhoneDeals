<div class="col-md-12">
	<h1>Liste des téléphones</h1>
	<table class="table table-striped">
		<thead>
			<th>ID</th>
			<th>Nom</th>
			<th>Marque</th>
			<th>Capacité</th>
			<th>Prix</th>
			<th>Couleur</th>
			<th>Description</th>
			<th></th>
		</thead>
		<?php
			foreach (Phone::getPhonesList() as $phone) {
				echo '<tr>';
					echo '<td>' . $phone->id . '</td>';
					echo '<td>' . $phone->name . '</td>';
					echo '<td>' . $phone->brand . '</td>';
					echo '<td>' . $phone->capacity . '</td>';
					echo '<td>' . $phone->price . '</td>';
					echo '<td>' . $phone->color . '</td>';
					echo '<td>' . $phone->description . '</td>';
					echo '<td><a href="#"><i class="fa fa-pencil"></i></a></td>';
					echo '<td><a href="#"><i class="fa fa-times"></i></a></td>';
				echo '</tr>';
			}
		?>
	</table>
</div>