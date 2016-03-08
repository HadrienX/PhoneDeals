<div class="col-md-12">
	<h1>Liste des couleurs</h1>
	<table class="table table-striped">
		<thead>
			<th>#</th>
			<th>Nom</th>
			<th>Code</th>
			<th></th>
			<th></th>
		</thead>
		<?php
			foreach (Color::getColorList() as $color) {
				echo '<tr>';
					echo '<td>' . $color->id . '</td>';
					echo '<td>' . $color->name . '</td>';
					echo '<td><div style="background-color: ' . $color->hex . ';display: inline-block; margin-right: 7px; float: left; border: 2px solid #ededed; border-radius: 20px; width: 20px; height: 20px;"></div>' . $color->hex . '</td>';
					echo '<td><a href="index.php?page=admin/color-edit&amp;id=' . $color->id . '"><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';
					echo '<td><a href="#"><i class="fa fa-trash" data-toggle="tooltip" title="Supprimer"></i></a></td>';
				echo '</tr>';
			}
		?>
	</table>
</div>