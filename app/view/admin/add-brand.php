<?php

		if (isset($_POST['add']) && App::isAdmin()) {

			if (isset($_POST['name']) && preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['name'])){

				$name = $_POST['name'];

				PDOConnexion::setParameters('phonedeals', 'root', 'root');
				$db = PDOConnexion::getInstance();
				$sql = "
					INSERT INTO brand(name)
					VALUES (:name)
				";
				$sth = $db->prepare($sql);
				$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Brand');
				$sth->execute(array(
					':name' => $name,
				));
			
				if ($sth) {
					App::success('Cette marque a bien été ajouté.','index.php?page=admin/brands-list');
				}
			}
			
			else {

				App::error('Veuillez entrer une marque valide.','index.php?page=admin/add-brand');

			}
		}
?>
				<div class="col-md-8">
					<div class="page-header">
						<h1>
							Ajouter une Marque
						</h1>
					</div>

					<form action="index.php?page=admin/add-brand" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="brand-name">Nom</label>
							<input type="text" class="form-control" id="brand-name" required="required" name="name" placeholder="Votre marque">
						</div>

						<button type="submit" class="btn btn-lg btn-primary" name="add">Ajouter</button>
					</form>
				</div>
