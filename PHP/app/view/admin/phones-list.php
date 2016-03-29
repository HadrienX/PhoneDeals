<div class="col-md-12">
	<h1>Liste des téléphones
		<a href="index.php?page=admin/add-phone" class="btn btn-primary pull-right">Ajouter un téléphone</a>
	</h1>
	<table class="table table-striped">
		<thead>
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
				echo '<tr data-id="' . $phone->id . '">';
					echo '<td><a href="index.php?page=admin/phone-edit&amp;id=' . $phone->id . '">' . $phone->name . '</a></td>';
					echo '<td>' . Brand::getBrandById($phone->brand) . '</td>';
					echo '<td>' . $phone->capacity . ' Go</td>';
					echo '<td>' . $phone->price . ' &euro;</td>';
					echo '<td>' . Color::getColorsNames($phone->color, true) . '</td>';
					echo '<td style="max-width: 400px;">' . $phone->description . '</td>';

					echo '<td><a href="index.php?page=admin/phone-edit&amp;id=' . $phone->id . '"><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';
					echo '<td><a href="#" title="Supprimer" data-toggle="tooltip" data-action="delete" title="Supprimer"><i class="fa fa-trash"></i></a></td>';
				echo '</tr>';
			}
		?>
	</table>
	<a href="index.php?page=admin/add-phone" class="btn btn-primary">Ajouter un téléphone</a>
</div>

<script>
	$('[data-action="delete"]').click(function(e) {
		e.preventDefault();

		eAjax(
			'public/webservice/admin/phone-delete.php',
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
