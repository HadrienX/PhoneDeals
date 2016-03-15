<?php
	
	if(isset($_POST['signup'])){

		if(isset($_POST['first_name']) && $_POST['first_name']!="" && preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['first_name']) &&
    		isset($_POST['last_name']) && $_POST['last_name']!="" && preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['last_name']) &&
    		isset($_POST['email']) && $_POST['email']!="" && preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']) &&
    		isset($_POST['email-confirm']) && $_POST['email-confirm']==$_POST['email'] &&
    	   	isset($_POST['password']) && $_POST['password']!="" && preg_match("#^\w{8,}$#", $_POST['password']) &&
    	   	isset($_POST['password-confirm']) && $_POST['password-confirm']==$_POST['password'] &&
    	   	isset($_POST['way_num'])&& $_POST['way_num']!="" && preg_match("#^[0-9]{1,}$#", $_POST['way_num']) &&
       		isset($_POST['way_type']) && $_POST['way_type']!="" &&
       		isset($_POST['way_name'])&& $_POST['way_name']!="" && preg_match("#^[a-zA-Z0-9._-]{2,30}#", $_POST['way_name']) &&
       		isset($_POST['city'])&& $_POST['city']!="" && preg_match("#^[a-zA-Z0-9._-]{2,30}#", $_POST['city']) &&
       		isset($_POST['zip_code']) && $_POST['zip_code']!="" && preg_match("#^[0-9]{5}$#", $_POST['zip_code']) &&
    	   	isset($_POST['accept_terms'])){
    	    
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$way_num = $_POST['way_num'];
			$way_type = $_POST['way_type'];
			$way_name = $_POST['way_name'];
			$city = $_POST['city'];
			$zip_code = $_POST['zip_code'];
    	    
    	    
			try{
				PDOConnexion::setParameters('phonedeals', 'root', 'root');
				$db = PDOConnexion::getInstance();
				$sql = "
					INSERT INTO member(`first_name`, `last_name`, `email`, `password`, `way_num`, `way_type`, `way_name`, `city`, `zip_code`)
							VALUES (:first_name, :last_name, :email, :password, :way_num, :way_type, :way_name, :city, :zip_code)";
				$sth = $db->prepare($sql);
				$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Member');
				$sth->execute(array(
					':first_name' => $first_name,
					':last_name' => $last_name,
					':email' => $email,
					':password' => Bcrypt::hashPassword($password),
					':way_num' => $way_num,
					':way_type' => $way_type,
					':way_name' => $way_name,
					':city' => $city,
					':zip_code' => $zip_code
				));

				/*if($_FILES['cv']){
    				echo "FILE UPLOADED!";
				}*/

				header("location:index.php?page=home");
			}
			catch(PDOException$e){
				echo"<p>Erreur:".$e->getMessage()."</p>";
				die();
			}
		}
		else{
			if((!isset($_POST['first_name']) || $_POST['first_name']=="") || 
			(!isset($_POST['last_name']) || $_POST['last_name']=="") ||
			(!isset($_POST['email']) || $_POST['email']=="") ||
			(!isset($_POST['email-confirm']) || $_POST['email-confirm']=="") ||
			(!isset($_POST['password']) || $_POST['password']=="") ||
			(!isset($_POST['password-confirm']) || $_POST['password-confirm']=="") ||
			(!isset($_POST['way_num']) || $_POST['way_num']=="") ||
			(!isset($_POST['way_type']) || $_POST['way_type']=="") ||
			(!isset($_POST['way_name']) || $_POST['way_name']=="") ||
			(!isset($_POST['city']) || $_POST['city']=="") ||
			(!isset($_POST['zip_code']) || $_POST['zip_code']=="")){
				App::error('Vous devez remplir tous les champs obligatoires');
			}
			if(!preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['first_name'])){
				App::error("Veuillez entrer un prénom approprié");
			}
			if(!preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['last_name'])){
				App::error("Veuillez entrer un nom approprié");
			}
			if(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])){
				App::error("Veuillez entrer un email approprié");
			}
			if(!preg_match("#^\w{8,}$#", $_POST['password'])){
				App::error("Veuillez entrer un mot de passe approprié");
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
			if($_POST['email']!=$_POST['email-confirm']){
				App::error("L'adresse email doit correspondre");
			}
			if($_POST['password']!=$_POST['password-confirm']){
				App::error("Le mot de passe doit correspondre");
			}
			if(!isset($_POST['accept_terms'])){
				App::error("Vous devez accepter les conditions d'utilisation");
			}
		}
	}

?>
<style type="text/css">
	form .row {
		margin-bottom: 20px;
	}
</style>

<div class="container">
	<h1>Inscription</h1>

	<div class="row">
		<div class="col-md-8">
			<form name="login" method="POST" action="index.php?page=signup">
				<div class="row">
					<div class="col-md-6">
						<label for="signup-firstname">Prénom</label>
						<input type="text" name="first_name" class="form-control" required="required" id="signup-firstname" placeholder="Prénom">
					</div>

					<div class="col-md-6">
						<label for="signup-lastname">Nom</label>
						<input type="text" name="last_name" class="form-control" required="required" id="signup-lastname" placeholder="Nom">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label for="signup-email">Adresse email</label>
						<input type="text" name="email" class="form-control" required="required" id="signup-email" placeholder="Adresse email">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label for="signup-email-confirm">Confirmez votre adresse email</label>
						<input type="text" name="email-confirm" class="form-control" required="required" id="signup-email-confirm" placeholder="Confirmez votre adresse email">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label for="signup-email">Mot de passe</label>
						<input type="password" name="password" class="form-control" required="required" id="signup-password" placeholder="Mot de passe">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label for="signup-email-confirm">Confirmez votre mot de passe</label>
						<input type="password" name="password-confirm" class="form-control" required="required" id="signup-password-confirm" placeholder="Confirmez votre mot de passe">
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="signup-waynum">Numéro de voie</label>
						<input type="text" name="way_num" class="form-control" required="required" id="signup-waynum" placeholder="Numéro de voie">
					</div>

					<div class="col-md-6">
						<label for="signup-waytype">Type de voie</label>
						<select name="way_type" id="signup-waytype" required="required" class="form-control">
							<option value=""></option>
							<?php
								foreach (Member::getWayTypes() as $way) {
									$selected = ($way == 'Rue') ? $selected = 'selected' : $selected = '';

									echo '<option value="' . strtolower($way) . '"' . $selected . '>' . $way . '</option>';
								}
							?>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label for="signup-wayname">Adresse</label>
						<input type="text" name="way_name" class="form-control" required="required" id="signup-wayname" placeholder="Adresse">
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="signup-city">Ville</label>
						<input type="text" name="city" class="form-control" required="required" id="signup-city" placeholder="Ville">
					</div>

					<div class="col-md-6">
						<label for="signup-zipcode">Code postal</label>
						<input type="text" name="zip_code" class="form-control" required="required" id="signup-zipcode" placeholder="Code postal">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label for="signup-terms">Conditions d'utilisation</label>
						<textarea class="form-control">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse at quam eget dolor mattis dapibus sit amet in ante. Nunc mattis euismod dapibus. Nunc ullamcorper finibus metus dapibus tristique. Maecenas malesuada bibendum metus, quis lacinia nisl consectetur in. In nec ex ac nulla sagittis tempus sed eu sem. Maecenas ac tortor eu justo volutpat tincidunt. Etiam commodo magna consequat risus pharetra, at interdum velit congue. Morbi sed leo congue, placerat libero ut, pretium lorem. Fusce maximus nisl eu lectus lacinia malesuada. Ut placerat eget odio eget commodo. Duis venenatis tincidunt blandit. Ut vitae hendrerit massa. Donec elementum semper dolor quis varius. Nam sollicitudin lacus vel elit porttitor mollis.</textarea>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="accept_terms" required="required" id="signup-terms">
								J'ai lu et j'accepte les <a href="index.php?page=conditions">conditions d'utilisations</a> et la <a href="index.php?page=privacy">politique de confidentialité</a>
							</label>
						</div>
					</div>
				</div>

				<input type="submit" name="signup" class="btn btn-primary" value="Se connecter">
			</form>
		</div>
	</div>
</div>
