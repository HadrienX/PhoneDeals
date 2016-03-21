<div class="col-md-12">
	<h1>Liste des commandes</h1>
	<table class="table table-striped">
		<thead>
			<th>Membre</th>
			<th>Date</th>
			<th>Prix HT</th>
			<th>Prix TTC</th>
			<th>Méthode d'envoi</th>
			<th>Téléphone</th>
			<th></th>
			<th></th>
		</thead>
		<?php
			foreach (Order::getOrdersList() as $order) {
				echo '<tr data-id="' . $order->id . '">';
					echo '<td>' . Member::getMemberById($order->member)->first_name . ' ' . Member::getMemberById($order->member)->last_name . '</td>';
					echo '<td>' . $order->date . '</td>';
					echo '<td>' . $order->paid_price . ' &euro;</td>';
					echo '<td>' . $order->paid_price_vat . ' &euro;</td>';
					echo '<td>' . $order->sent_method . '</td>';
					echo '<td>' . $order->phones . '</td>';

					echo '<td><a href="index.php?page=admin/order-edit&amp;id=' . $order->id . '"><i class="fa fa-pencil" data-toggle="tooltip" title="Modifier"></i></a></td>';
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
			'public/webservice/admin/order-delete.php',
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
