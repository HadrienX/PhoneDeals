<?php

		if (isset($_POST['add']) && App::isAdmin()) {

			if (isset($_POST['phone']) && isset($_POST['pourcentage']) && preg_match("#^([0-9]{1,2}|100)$#", $_POST['pourcentage'])){ 
		
				PDOConnexion::setParameters('phonedeals', 'root', 'root');
				$db = PDOConnexion::getInstance();
				$sql = "
					INSERT INTO promotion(phone,percent)
					VALUES (:phone,:percent)
				";
				$sth = $db->prepare($sql);
				$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Promotion');
				$sth->execute(array(
					':phone' => $_POST['phone'],
					':percent' => $_POST['pourcentage']
				));
			
				if ($sth) {
					App::success('Ce pourcentage a bien été ajouté.','index.php?page=admin/promotions-list');
				}
			}
			
			else {

				App::error('Veuillez entrer un pourcentage entre 0 et 100.','index.php?page=admin/add-promotion');

			}
		}
?>
				<div class="col-md-4">
					<div class="page-header">
						<h1>
							Ajouter un promotion
						</h1>
					</div>

					<form action="index.php?page=admin/add-promotion" method="POST" enctype="multipart/form-data">

						<div class="form-group">
							<label for="phones" style="width: 100%;">Téléphone</label>
							<select name="phone">
							<option selected="selected"> Selectionnez un téléphone</option>
								<?php
									foreach (Phone::getPhonesList() as $phone) {
										$selected = '';
										
										if ($phone->id == $phone->brand) {
											$selected = 'selected';
										}

										echo '<option name="' . $phone->name . '" value="' . $phone->id . '">' . $phone->name . '</option>';
									}
								?>
							</select>
						</div>

						<div class="form-group">
							<label for="pourcentage"> Pourcentage de réduction </label>
							<input type="text" class="form-control" id="pourcentage" required="required" name="pourcentage" placeholder="Entrez le pourcentage à appliquer au téléphone ">
						</div>

						<button type="submit" class="btn btn-lg btn-primary" name="add">Ajouter</button>
					</form>
				</div>
