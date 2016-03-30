<?php
	if (isset($_POST['action'])) {
		if ($_POST['action'] == 'add') {
			$phone = Phone::getPhoneById($_POST['id']);
			// Si la session existe, alors on initialise la valeur dans une variable
			if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
				$cart = $_SESSION['cart'];
			}
			// Sinon, on initialise simplement la variable vide
			else {
				$cart = array(
					'phones' => array(),
					'phone_total' => (int) 0,
					'price_total' => (int) 0,
				);
			}
			// Lorsqu'on ajoute un téléphone, on le stocke dans un tableau
			array_push($cart['phones'], array(
				'id' => (int) $phone->id,
				'name' => $phone->name,
				'price' => (int) $_POST['price'],
				'amount' => (int) $_POST['amount'],
				'capacity' => (int) $_POST['capacity'],
				'color' => (int) $_POST['color']
			));
			// On précise que les données entrés précédement correspondent à la variable $cart pour les ajouter dans la session
			$_SESSION['cart'] = $cart;
			$_SESSION['cart']['phone_total'] = $_SESSION['cart']['phone_total'] + $_POST['amount'];
			$_SESSION['cart']['price_total'] = $_SESSION['cart']['price_total'] + $phone->price;
			
			$msg->success('Le téléphone a bien été ajouté au panier.', 'index.php?page=cart');
		}

		elseif ($_POST['action'] == 'remove') {
			$_SESSION['cart']['phone_total'] = $_SESSION['cart']['phone_total'] - $_SESSION['cart']['phones'][$_POST['id']]['amount'];
			$_SESSION['cart']['price_total'] = $_SESSION['cart']['price_total'] - ($_SESSION['cart']['phones'][$_POST['id']]['price'] * $_SESSION['cart']['phones'][$_POST['id']]['amount']);
			unset($_SESSION['cart']['phones'][$_POST['id']]);
			// App::dd($_SESSION['cart']['phones']);

			$msg->success('Le produit a bie été supprimé de votre panier', 'index.php?page=cart');
		}

		else {
			echo 'Erreur';
		}
	}
	
	else {
		$empty = true;
		$phonesTotal = 0;

		if (isset($_SESSION['cart']['phones']) && !empty($_SESSION['cart']['phones'])) {
			$empty = false;
			$phonesTotal = $_SESSION['cart']['phone_total'];
		}
?>

<div class="container">
	<h1>Panier d'achats</h1>

	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th>Produits ajoutés au panier (<?php echo $phonesTotal; ?>)</th>
						<th>Prix</th>
						<th>Couleur</th>
						<th>Capacité</th>
						<th>Quantité</th>
						<th>Prix total</th>
						<th>Supprimer</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if (!$empty) {
							foreach ($_SESSION['cart']['phones'] as $key => $phone) {
								echo '
									<tr>
										<td>' . $phone['name'] . '</td>
										<td>' . money_format('%!i', $phone['price']) . ' &euro;</td>
										<td><div style="background: ' . Color::getColorById($phone['color'])->hex . '; border: 1px solid #ededed; display: inline-block; width: 15px; height: 15px; border-radius: 17px;"></div> ' . Color::getColorById($phone['color'])->name . '</td>
										<td>' . $phone['capacity'] . ' Go</td>
										<td>' . $phone['amount'] . '</td>
										<td>' . money_format('%!i', $phone['price'] * $phone['amount']) . ' &euro;</td>
										<td>
											<form action="index.php?page=cart" method="POST">
												<input type="hidden" name="id" value="' . $key . '">
												<input type="hidden" name="action" value="remove">
												<button action="submit" title="Retirer du panier" class="remove-cart" style="border: none; background: transparent;"><i class="fa fa-trash"></i></button>
											</form>
										</td>
									</tr>
								';
							}
						}
						else {
							echo '
								<tr>
									<td>Vous n\'avez ajouté aucun produit au panier</td>
								</tr>
							';
						}
					?>
				</tbody>
			</table>

			<?php if ($phonesTotal) { ?>
			<a href="#" class="btn btn-primary">
				<i class="fa fa-shopping-basket" style="padding-right: 7px;"></i>
				Passer la commande
			</a>
			<?php } ?>
		</div>
	</div>
</div>
<?php } ?>

<script>
	$('.remove-cart').click(function() {
		if (!confirm('Voulez vous vraiment supprimer ce téléphone de votre panier ?')) {
			return false;
		}
	});
</script>
