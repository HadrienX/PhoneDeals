<div class="col-md-12">
	<h1>Liste des marques</h1>
	<table class="table table-striped">
		<thead>
			<th>#</th>
			<th>Nom</th>
			<th></th>
			<th></th>
		</thead>
		<?php
			foreach (Brand::getBrandList() as $brand) {
				echo '<tr>';
					echo '<td>' . $brand->id . '</td>';
					echo '<td>' . $brand->name . '</td>';
					echo '<td><a href="index.php?page=admin/brand-edit&amp;id=' . $brand->id . '"><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';
					echo '<td><a href="#"><i class="fa fa-trash" data-toggle="tooltip" title="Supprimer"></i></a></td>';
				echo '</tr>';
			}
		?>
	</table>
</div>