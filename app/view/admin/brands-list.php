<div class="col-md-4">
	<h1>Liste des marques</h1>
	<table class="table table-striped">
		<thead>
			<th>Nom</th>
			<th></th>
			<th></th>
		</thead>
		<?php
			foreach (Brand::getBrandList() as $brand) {
				echo '<tr data-id="' . $brand->id . '">';
					echo '<td>' . $brand->name . '</td>';
					echo '<td><a href="index.php?page=admin/brand-edit&amp;id=' . $brand->id . '"><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';
					echo '<td><a href="#" title="Supprimer" data-action="delete" data-toggle="tooltip" title="Supprimer"><i class="fa fa-trash"></i></a></td>';
				echo '</tr>';
			}
		?>
	</table>
	<a href="index.php?page=admin/add-brand" class="btn btn-primary">Ajouter un marque</a>
</div>
<script>
	$('[data-action="delete"]').click(function(e) {
		e.preventDefault();

		eAjax(
			'public/webservice/admin/brand-delete.php',
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
