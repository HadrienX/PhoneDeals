<div class="col-md-8">
	<h1>Liste des membres</h1>
	<table class="table table-striped">
		<thead>
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
				echo '<tr data-id="' . $member->id . '">';
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
					echo '<td><a href="index.php?page=admin/member-edit&amp;id=' . $member->id . '"><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';
					echo '<td><a href="#" title="Supprimer" data-toggle="tooltip" data-action="delete" title="Supprimer"><i class="fa fa-trash"></i></a></td>';
				echo '</tr>';
			}
		?>
	</table>
</div>
<script>
	$('[data-action="delete"]').click(function(e) {
		e.preventDefault();

		eAjax(
			'public/webservice/admin/member-delete.php',
			{'delete': true, 'id': $(this).parent().parent().data('id')},
			'deleteRow'
		);
	});

	var eAjaxData = '';

	function eAjax(url, parameters, callback) {
	    if (!confirm('Êtes-vous sûr ?')) {
	        return false;
	    }

	    $.post(url, parameters, function(data) {
	        eAjaxData = data;
	        var func = callback + "()";
	        eval(func);
	    }, "json");
	}

	function deleteRow() {
	    if (eAjaxData.status == 'true') {
	        $('[data-id="' + eAjaxData.id + '"]').fadeTo('slow', 0.01).slideUp('slow');
	    }
	    
	    else {
	        alert(eAjaxData.status);
	    }
	}
</script>