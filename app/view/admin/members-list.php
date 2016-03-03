<div class="col-md-12">
	<h1>Liste des membres</h1>
	<table class="table table-striped">
		<thead>
			<th>#</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Email</th>
			<th>Ville</th>
			<th>Admin</th>
			<th>Date d'inscription</th>
			<th></th>
			<th></th>
		</thead>
		<?php
			foreach (Member::getMembersList() as $member) {
				echo '<tr>';
					echo '<td>' . $member->id . '</td>';
					echo '<td><a href="index.php?page=admin/member-edit&amp;id=' . $member->id . '">' . $member->last_name . '</a></td>';
					echo '<td>' . $member->first_name . '</td>';
					echo '<td>' . $member->email . '</td>';
					echo '<td>' . $member->city . '</td>';
					if ($member->admin) {
						echo '<td><i class="fa fa-check" style="color: #27ae60;"></i></td>';
					}

					else {
						echo '<td><i class="fa fa-times" style="color: #c0392b;"></i></td>';
					}
					echo '<td>' . $member->register_date . '</td>';
					echo '<td><a href="index.php?page=admin/member-edit&amp;id=' . $member->id . '"><i class="fa fa-pencil"></i></a></td>';
					echo '<td><a href="#"><i class="fa fa-trash"></i></a></td>';
				echo '</tr>';
			}
		?>
	</table>
</div>