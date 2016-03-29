<?php
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$id = htmlentities($_GET['id']);
		$phone = Phone::getPhoneById($id);
		$brand = Brand::getBrandById($id);
		if (isset($_POST['edit'])){
			if(isset($_POST['name']) && preg_match("#^[a-zA-Z0-9]{2,32}#", $_POST['name']) &&
				isset($_POST['brand']) && preg_match("#^[0-9]{1}#", $_POST['brand']) &&
				isset($_POST['capacity']) &&
				isset($_POST['price']) && preg_match("#^[0-9]#", $_POST['price']) &&
				isset($_POST['color']) &&
				isset($_POST['description']) && preg_match("#^[a-zA-Z0-9._-]#", $_POST['description'])) {

				PDOConnexion::setParameters('phonedeals', 'root', 'root');
				$db = PDOConnexion::getInstance();
				$sql = "
					UPDATE phone
					SET name = :name,
						brand = :brand,
						capacity = :capacity,
						price = :price,
						color = :color,
						description = :description
					WHERE id = :id
				";
				$sth = $db->prepare($sql);
				$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Phone');
				$sth->execute(array(
					':id' => $id,
					':name' => $_POST['name'],
					':brand' => $_POST['brand'],
					':capacity' => implode(',', $_POST['capacity']),
					':price' => $_POST['price'],
					':color' => implode(',', $_POST['color']),
					':description' => $_POST['description']
				));
				
				if ($sth) {
					App::success('Ce téléphone a bien été modifié');
				}
			}
			else{
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
		
		if ($phone) :
?>
				<div class="col-md-8">
					<div class="page-header">
						<h1>Éditer un téléphone</h1>
					</div>

					<form action="index.php?page=admin/phone-edit&amp;id=<?php echo $id; ?>" method="POST">
						<div class="form-group">
							<label for="phone-name">Nom</label>
							<input type="text" class="form-control" id="phone-name" value="<?php echo $phone->name; ?>" name="name" placeholder="Nom du téléphone">
						</div>

						<div class="form-group">
							<label for="phone-brand" style="width: 100%;">Marque</label>
							<select name="brand">
								<?php
									foreach (Brand::getBrandList() as $brand) {
										$selected = '';
										
										if ($brand->id == $phone->brand) {
											$selected = 'selected';
										}
										echo '<option name="' . $brand->name . '" value="' . $brand->id . '"' . $selected . '>' . $brand->name . '</option>';
									}
								?>
							</select>
						</div>

						<div class="form-group">
							<label for="phone-capacity" style="width: 100%;">Capacité</label>
							<?php
								$phone->capacity = explode(',', $phone->capacity);
								foreach (Capacity::getCapacityList() as $capacity) {
									$checked = '';
									if (in_array($capacity->storage, $phone->capacity)) {
										$checked = 'checked';
									}
									echo '
										<label class="checkbox-inline"><input type="checkbox" name="capacity[]" value="' . $capacity->storage . '"' . $checked . '> ' . $capacity->storage . ' Go</label>
									';
								}
							?>
						</div>

						<div class="form-group">
							<label for="phone-color" style="width: 100%;">Couleur</label>
							<?php
								$phone->color = explode(',', $phone->color);
								foreach (Color::getColorList() as $color) {
									$checked = '';
									if (in_array($color->id, $phone->color)) {
										$checked = 'checked';
									}
									echo '
										<label class="checkbox-inline"><input type="checkbox" name="color[]" value="' . $color->id . '"' . $checked . '> ' . $color->name . '</label>
									';
								}
							?>
						</div>

						<div class="form-group">
							<label for="phone-description">Description</label>
							<textarea class="form-control" id="phone-description" name="description" placeholder="Description du téléphone" rows="6"><?php echo $phone->description; ?></textarea>
						</div>

						<div class="form-group">
							<label for="phone-price">Prix</label>
							<div class="input-group">
								<input type="text" class="form-control" id="phone-price" name="price" value="<?php echo money_format('%!i', $phone->price); ?>" placeholder="Prix du téléphone">
								<div class="input-group-addon">&euro;</div>
							</div>
						</div>

						<button type="submit" class="btn btn-lg btn-primary" name="edit">Éditer</button>
					</form>
				</div>
<?php
		else:
			App::redirect('index.php?page=admin/phones-list');
		endif;
	}
	else {
		App::redirect('index.php?page=admin/phones-list');
	}
?>
