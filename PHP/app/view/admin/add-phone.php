<?php

		if (isset($_POST['add']) && App::isAdmin()) {

			if (isset($_POST['name']) && preg_match("#^[a-zA-Z0-9]{2,32}#", $_POST['name']) &&
				isset($_POST['brand']) && preg_match("#^[0-9]{1}#", $_POST['brand']) &&
				isset($_POST['capacity']) &&
				isset($_POST['price']) && preg_match("#^[0-9]#", $_POST['price']) &&
				isset($_POST['color']) &&
				isset($_POST['description']) && preg_match("#^[a-zA-Z0-9._-]#", $_POST['description'])){

				PDOConnexion::setParameters('phonedeals', 'root', 'root');
				$db = PDOConnexion::getInstance();
				$sql = "
					INSERT INTO phone(name, brand, capacity, price, color, description)
						VALUES (:name, :brand, :capacity, :price, :color, :description)
				";
				$sth = $db->prepare($sql);
				$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Phone');
				$sth->execute(array(
					':name' => $_POST['name'],
					':brand' => $_POST['brand'],
					':capacity' => implode(',', $_POST['capacity']),
					':price' => $_POST['price'],
					':color' => implode(',', $_POST['color']),
					':description' => $_POST['description']
				));
				
				if ($sth) {
					App::success('Ce téléphone a bien été ajouté');
				}
			}
			
			else {
				if(!preg_match("#^[a-zA-Z0-9]{2,32}#", $_POST['name'])){
					App::error('Veuillez entrer un nom valide.','index.php?page=admin/add-phone');
				}
				if(!preg_match("#^[0-9]{1}#", $_POST['brand'])){
					App::error('Veuillez choisir une marque valide.','index.php?page=admin/add-phone');
				}
				if(!preg_match("#^[0-9.,]#", $_POST['price'])){
					App::error('Veuillez entrer un prix valide.','index.php?page=admin/add-phone');
				}
				if(!preg_match("#^[a-zA-Z0-9._-]#", $_POST['description'])){
					App::error('Veuillez entrer une description valide.','index.php?page=admin/add-phone');
				}
			}
		}
?>
				<div class="col-md-8">
					<div class="page-header">
						<h1>
							Ajouter un Téléphone
						</h1>
					</div>

					<form action="index.php?page=admin/add-phone" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="phone-name">Nom</label>
							<input type="text" class="form-control" id="phone-name" required="required" name="name" placeholder="Téléphone">
						</div>

						<div class="form-group">
							<label for="phone-brand">Marque</label>
							<select id="phone-brand" required="required" name="brand" class="form-control">
								<option value="" disabled selected>Marque</option>
								<?php
									foreach (Brand::getBrandList() as $brand) {
										echo '<option value="' . $brand->id . '">' . $brand->name . '</option>';
									}
								?>
							</select>
						</div>

						<div class="form-group">
							<label for="phone-capacities">Capacité</label>
							<div class="form-control" id="phone-capacities" required="required" name="capacities">
								<?php
									foreach (Capacity::getCapacityList() as $capacity) {
										echo '<label class="checkbox-inline"><input type="checkbox" name="capacity[]" value="' . $capacity->storage . '"> ' . $capacity->storage . ' Go</label>';
									}
								?>
					        </div>
						</div>

						<div class="form-group">
							<label for="phone-price">Prix</label>
							<input type="text" class="form-control" id="phone-price" required="required" name="price" placeholder="Prix">
						</div>

						<div class="form-group">
							<label for="phone-color">Capacité</label>
							<div id="phone-color" required="required" name="color">
								<?php
									foreach (Color::getColorList() as $color) {
										echo '<label class="checkbox-inline"><input type="checkbox" name="color[]" value="' . $color->id . '"> ' . $color->name . '</label>';
									}
								?>
					        </div>
						</div>

						<div class="form-group">
							<label for="phone-description">Description</label>
							<input type="text" class="form-control" id="phone-description" required="required" name="description" placeholder="Description">
						</div>

						<button type="submit" class="btn btn-lg btn-primary" name="add">Ajouter</button>
					</form>
				</div>
