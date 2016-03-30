<?php
	if (App::isLogged()) :
		$member = Member::getMemberById($_SESSION['id']);

		if (isset($_POST['delete'])){
			if (isset($_POST['password']) && $_POST['password'] == $_POST['password-confirm']) {
				if (Bcrypt::checkPassword($_POST['password'], $member->password)) {
					Member::deleteMember($member->id);

					session_unset();
					$msg->success('Votre compte à bien été supprimé', 'index.php?page=home');
				}

				else {
					echo $msg->error('Le mot de passe entré est incorrect, veuillez réessayer', 'index.php?page=profile');
				}
			}

			else {
				echo $msg->error('Les deux mots de passe ne correspondent pas', 'index.php?page=profile');
			}
		}

		if (isset($_POST['edit'])) :

			if(isset($_POST['first_name']) && $_POST['first_name']!="" && preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['first_name']) &&
    		isset($_POST['last_name']) && $_POST['last_name']!="" && preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['last_name']) &&
    		isset($_POST['email']) && $_POST['email']!="" && preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']) &&
    	   	isset($_POST['password']) && $_POST['password']!="" &&
    	   	isset($_POST['password-confirm']) && $_POST['password-confirm']==$_POST['password'] &&
    	   	isset($_POST['way_num'])&& $_POST['way_num']!="" && preg_match("#^[0-9]{1,}$#", $_POST['way_num']) &&
       		isset($_POST['way_type']) && $_POST['way_type']!="" &&
       		isset($_POST['way_name'])&& $_POST['way_name']!="" && preg_match("#^[a-zA-Z0-9._-]{2,30}#", $_POST['way_name']) &&
       		isset($_POST['city'])&& $_POST['city']!="" && preg_match("#^[a-zA-Z0-9._-]{2,30}#", $_POST['city']) &&
       		isset($_POST['zip_code']) && $_POST['zip_code']!="" && preg_match("#^[0-9]{5}$#", $_POST['zip_code'])) {
       		    	    
    	        	    
			try{
				PDOConnexion::setParameters('phonedeals', 'root', 'root');
				$db = PDOConnexion::getInstance();
				$sql = "
					UPDATE member
					SET first_name = :first_name,
						last_name = :last_name,
						email = :email,
						way_num = :way_num,
						way_type = :way_type,
						way_name = :way_name,
						city = :city,
					WHERE id = :id
				";
				$sth = $db->prepare($sql);
				$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Phone');
				$sth->execute(array(
					':id' => $id,
					':first_name' => $_POST['first_name'],
					':last_name' => $_POST['last_name'],
					':email' => $_POST['email'],
					':way_num' => $_POST['way_num'],
					':way_type' => $_POST['way_type'],
					':way_name' => $_POST['way_name'],
					':city' => $_POST['city'],
					':zip_code' => $_POST['zip_code']
				));

				header("location:index.php?page=home");
			}
			catch(PDOException$e){
				echo"<p>Erreur:".$e->getMessage()."</p>";
				die();
			}
		}
		else{
	
			if(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])){
				App::error("Veuillez entrer un email approprié");
			}

			if(!preg_match("#^[0-9]{1,}$#", $_POST['way_num'])){
				App::error("Veuillez entrer un numéro de voie approprié");
			}
			if(!preg_match("#^[a-zA-Z0-9._-]{2,30}#", $_POST['way_name'])){
				App::error("Veuillez entrer un nom de voie approprié");
			}
			if(!preg_match("#^[a-zA-Z0-9._-]{2,30}#", $_POST['city'])){
				App::error("Veuillez entrer une ville approprié");
			}
			if(!preg_match("#^[0-9]{5}$#", $_POST['zip_code'])){
				App::error("Veuillez entrer code postal approprié");
			}

			if (isset($_POST['password']) && $_POST['password'] == $_POST['password-confirm']) {
				if (Bcrypt::checkPassword($_POST['password'], $member->password)) {
					if (isset($_POST['new-password']) && !empty($_POST['new-password'])) {
						if (preg_match("#^[a-zA-Z\@._-]{2,32}#", $_POST['new-password'])) {
							$new_password = Bcrypt::hashPassword($_POST['new-password']);
							Member::changePassword($new_password, $member);							
							

							$msg->success('Votre mot de passe a bien été modifié', 'index.php?page=profile');
						}

						else {
							$msg->error('Veuillez entrer un nouveau mot de passe approprié', 'index.php?page=profile');
						}	
					}
				}

				else {
					echo $msg->error('Le mot de passe entré est incorrect, veuillez réessayer', 'index.php?page=profile');
				}
			}

			else {
				echo $msg->error('Les deux mots de passe ne correspondent pas', 'index.php?page=profile');
			}
		}
		else:
?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<img src="<?php echo App::getGravatar($member->email); ?>" alt="Avatar de <?php echo $member->first_name; ?>" />
					</div>
					
					<div class="col-md-9">
						<form action="index.php?page=profile" method="POST" class="form-horizontal" enctype="multipart/form-data">
							<div class="form-group">
								<label class="col-sm-2 control-label">Nom</label>
								<div class="col-sm-10">
									<p class="form-control-static"><?php echo $member->last_name; ?></p>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Prénom</label>
								<div class="col-sm-10">
									<p class="form-control-static"><?php echo $member->first_name; ?></p>
								</div>
							</div>

							<div class="form-group">
								<label for="email" class="col-sm-2 control-label">Email</label>
								<div class="col-sm-10">
									<input type="text" name="email" class="form-control" required="required" id="email" value="<?php echo $member->email; ?>" placeholder="Adresse">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label" for="adress">Adresse</label>
								<div class="col-sm-2">
									<input type="text" name="way_num" class="form-control" required="required" id="way_num" value="<?php echo $member->way_num; ?>" placeholder="Adresse">
								</div>
								<div class="col-sm-4">	
									<select name="way_type" required="required" id="way_type" class="form-control">
										<option value=""></option>
										<?php
											foreach (Member::getWayTypes() as $way) {

												$selected = ($way == $member->way_type) ? $selected = 'selected' : $selected = '';

												echo '<option value="' . strtolower($way) . '"' . $selected . '>' . $way . '</option>';
											}
										?>
									</select>
								</div>
								<div class="col-sm-4">
									<input type="text" name="way_name" class="form-control" required="required" id="way_name" value="<?php echo $member->way_name; ?>" placeholder="Adresse">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label" for="city">Ville</label>
								<div class="col-sm-6">
									<input type="text" name="city" class="form-control" required="required" id="city" value="<?php echo $member->city; ?>" placeholder="Adresse">
								</div>
								<label class="col-sm-2 control-label" for="zip_code">Code postal</label>
								<div class="col-sm-2">
									<input type="text" name="zip_code" class="form-control" required="required" id="zip_code" value="<?php echo $member->zip_code; ?>"placeholder="Code postal">
								</div>
							</div>

							<div class="form-group">
								<label for="profile-new-password" class="col-sm-2 control-label">Nouveau mot de passe</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="profile-new-password" name="new-password" placeholder="Si vous désirez changer de mot de passe">
								</div>
							</div>

							<div class="form-group">
								<label for="profile-password" class="col-sm-2 control-label">Entrer votre mot de passe *</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="profile-password" required='required' name="password" placeholder="Mot de passe actuel">
								</div>
							</div>

							<div class="form-group">
								<label for="profile-password-confirm" class="col-sm-2 control-label">Confirmer votre mot de passe *</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="profile-password-confirm" required='required' name="password-confirm" placeholder="Confirmer le mot de passe">
									<p class="help-block">Entrez votre mot de passe pour confirmer votre identité et valider les modifications</p>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary" name="edit">Mettre à jour</button>

									<button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-controls="collapse" name="delete"> Supprimer votre profil </button>
								</div>

							</div>

							<div class="collapse" id="collapse">
							  <div class="form-group">
							    La suppression de votre profil est irreversible, vous ne pourrez plus avoir accès à vos données et votre compte sera supprimé.
							    <button type="submit" class="btn btn-default btn-sm" name="delete" style="color:#d9534f"> Supprimer </button>
							  </div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
		endif;
	else :
		App::getHeader(404);
	endif;
?>
