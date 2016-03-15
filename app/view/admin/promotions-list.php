<div class="col-md-12">
	<h1>Liste des promotions</h1>
	<?php if (Promotion::getPromotionsList()) : ?>
		<table class="table table-striped">
			<thead>
				<th>Téléphone</th>
				<th>Pourcentage</th>
				<th>Prix de base</th>
				<th>Prix réduit</th>
				<th></th>
				<th></th>
			</thead>
			<?php
				foreach (Promotion::getPromotionsList() as $promotion) {
				echo '<tr data-id="' . $promotion->id . '">';
						echo '<td><a href="index.php?page=admin/promotion-edit&amp;id=' . $promotion->id . '">' . Phone::getPhoneById($promotion->phone)->name . '</a></td>';
						echo '<td>' . $promotion->percent . ' %</td>';
						echo '<td>' . Phone::getPhoneById($promotion->phone)->price . ' &euro;</td>';
						echo '<td>' . Promotion::getNewPrice($promotion->phone) . ' &euro;</td>';
						echo '<td><a href="index.php?page=admin/promotion-edit&amp;id=' . $promotion->id . '"><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';
					echo '<td><a href="#" title="Supprimer" data-toggle="tooltip" data-action="delete" title="Supprimer"><i class="fa fa-trash"></i></a></td>';
					echo '</tr>';
				}
			?>
		</table>
		<a href="index.php?page=admin/add-promotion" class="btn btn-primary">Ajouter une promotion</a>
	<?php
		else :
			echo '<p>Aucune promotion n\'a été ajouté.</p>';
		endif;
	?>
</div>
<script>
	$('[data-action="delete"]').click(function(e) {
		e.preventDefault();

		eAjax(
			'public/webservice/admin/promotion-delete.php',
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