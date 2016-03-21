<?php

		if (isset($_POST['add']) && App::isAdmin()) {

			if (isset($_POST['name']) && preg_match("#^[a-zA-Z]{2,32}#", $_POST['name']) &&
				isset($_POST['hex']) && (preg_match("#^[a-zA-Z0-9]{3}#", $_POST['hex']) || preg_match("#^[a-zA-Z0-9]{6}#", $_POST['hex']))){

				$name = $_POST['name'];
				$hex = '#' . $_POST['hex'];

				PDOConnexion::setParameters('phonedeals', 'root', 'root');
				$db = PDOConnexion::getInstance();
				$sql = "
					INSERT INTO color(name, hex)
					VALUES (:name, :hex)
				";
				$sth = $db->prepare($sql);
				$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Color');
				$sth->execute(array(
					':name' => $name,
					':hex' => $hex
				));
			
				if ($sth) {
					App::success('Cette couleur a bien été ajouté.','index.php?page=admin/color-list');
				}
			}
			
			else {
				if(!preg_match("#^[a-zA-Z]{2,32}#", $_POST['name'])){
					App::error('Veuillez entrer une couleur valide.','index.php?page=admin/add-color');
				}
				if(!preg_match("#^[a-zA-Z0-9]{3}#", $_POST['hex']) && !preg_match("#^[a-zA-Z0-9]{6}#", $_POST['hex'])){
					App::error('Veuillez entrer un code hexadecimal valide.','index.php?page=admin/add-color');
				}
			}
		}
?>
				<div class="col-md-8">
					<div class="page-header">
						<h1>
							Ajouter une Couleur
						</h1>
					</div>

					<form action="index.php?page=admin/add-color" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="color-name">Nom</label>
							<input type="text" class="form-control" id="color-name" required="required" name="name" placeholder="Votre couleur">
						</div>

						<div class="form-group">
							<label for="color-hex">Code hexadecimal</label>
							<input type="text" class="form-control" id="color-hex" required="required" name="hex" placeholder="Code hexadecimal (Ex : fff ou ffffff)">
						</div>
						<button type="submit" class="btn btn-lg btn-primary" name="add">Ajouter</button>
					</form>
				</div>
