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
				'price' => (int) $phone->price
			));
			// On précise que les données entrés précédement correspondent à la variable $cart pour les ajouter dans la session
			$_SESSION['cart'] = $cart;
			$_SESSION['cart']['phone_total'] = $_SESSION['cart']['phone_total'] + 1;
			$_SESSION['cart']['price_total'] = $_SESSION['cart']['price_total'] + $phone->price;
			
			$msg->success('Le téléphone a bien été ajouté au panier.', 'index.php?page=cart');
		}

		elseif ($_POST['action'] == 'remove') {
			unset($_SESSION['cart']['phones'][$_POST['id']]);
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
						<th>Total</th>
						<th>Supprimer</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if (!$empty) {
							foreach ($_SESSION['cart']['phones'] as $phone) {
								echo '
									<tr>
										<td>' . $phone['name'] . '</td>
										<td>' . money_format('%!i', $phone['price']) . '</td>
										<td></td>
										<td></td>
										<td>' . money_format('%!i', $phone['price']) . '</td>
										<td><a href="#" data-action="remove-cart" data-id="' . $phone['id'] . '" data-price="' . $phone['price'] . '" title="Retirer du panier"><i class="fa fa-trash"></i></a></td>
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
		</div>
	</div>
</div>
<?php } ?>