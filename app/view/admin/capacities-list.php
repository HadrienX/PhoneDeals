<div class="col-md-12">
	<h1>Liste des capacités</h1>
	<table class="table table-striped">
		<thead>
			<th>#</th>
			<th>Capacité</th>
			<th></th>
			<th></th>
		</thead>
		<?php
			foreach (Capacity::getCapacityList() as $capacity) {
				echo '<tr>';
					echo '<td>' . $capacity->id . '</td>';
					echo '<td>' . $capacity->storage . ' Go</td>';
					echo '<td><a href="index.php?page=admin/capacity-edit&amp;id=' . $capacity->id . '"><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';
					echo '<td><a href="#"><i class="fa fa-trash" data-toggle="tooltip" title="Supprimer"></i></a></td>';
				echo '</tr>';
			}
		?>
	</table>
	<a href="index.php?page=admin/add-capacity" class="btn btn-primary">Ajouter une capacité</a>
</div>
