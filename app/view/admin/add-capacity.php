<?php

		if (isset($_POST['add']) && App::isAdmin()) {

			if (isset($_POST['capacity']) && is_numeric($_POST['capacity'])){

				$storage = $_POST['capacity'];

				PDOConnexion::setParameters('phonedeals', 'root', 'root');
				$db = PDOConnexion::getInstance();
				$sql = "
					INSERT INTO capacity(storage)
					VALUES (:storage)
				";
				$sth = $db->prepare($sql);
				$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Capacity');
				$sth->execute(array(
					':storage' => $storage
				));
			
				if ($sth) {
					App::success('Cette capacité a bien été ajouté.','index.php?page=admin/capacities-list');
				}
			}
			
			else {

				App::error('Veuillez entrer une capacité valide.','index.php?page=admin/add-capacity');

			}
		}
?>
				<div class="col-md-8">
					<div class="page-header">
						<h1>
							Ajouter une Capacité
						</h1>
					</div>

					<form action="index.php?page=admin/add-capacity" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="capacity">Capacité</label>
							<input type="text" class="form-control" id="capacity" required="required" name="capacity" placeholder="Votre capacité">
						</div>

						<button type="submit" class="btn btn-lg btn-primary" name="add">Ajouter</button>
					</form>
				</div>
