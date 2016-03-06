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
					echo '<td><a href="index.php?page=admin/phone-edit&amp;id=' . $capacity->id . '"><i class="fa fa-pencil"></i></a></td>';
					echo '<td><a href="#"><i class="fa fa-trash"></i></a></td>';
				echo '</tr>';
			}
		?>
	</table>
</div>