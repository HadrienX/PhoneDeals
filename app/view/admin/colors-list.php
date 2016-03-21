<div class="col-md-4">
	<h1>Liste des couleurs</h1>
	<table class="table table-striped">
		<thead>
			<th>Nom</th>
			<th>Code</th>
			<th></th>
			<th></th>
		</thead>
		<?php
			foreach (Color::getColorList() as $color) {
				echo '<tr data-id="'. $color->id . '">';
					echo '<td>' . $color->name . '</td>';
					echo '<td><div style="background-color: ' . $color->hex . ';display: inline-block; margin-right: 7px; float: left; border: 2px solid #ededed; border-radius: 20px; width: 20px; height: 20px;"></div>' . $color->hex . '</td>';
					echo '<td><a href="index.php?page=admin/color-edit&amp;id=' . $color->id . '"><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';	
					echo '<td><a href="#" title="Supprimer" data-action="delete" data-toggle="tooltip" title="Supprimer"><i class="fa fa-trash"></i></a></td>';
				echo '</tr>';
			}
		?>
	</table>
	<a href="index.php?page=admin/add-color" class="btn btn-primary">Ajouter une couleur</a>
</div>
<script>
	$('[data-action="delete"]').click(function(e) {
		e.preventDefault();

		eAjax(
			'public/webservice/admin/color-delete.php',
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
