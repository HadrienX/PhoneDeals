<style type="text/css">
	form .row {
		margin-bottom: 20px;
	}
</style>

<div class="container">
	<h1>Inscription</h1>

	<div class="row">
		<div class="col-md-8">
			<form name="login" method="POST" action="index.php?page=login">
				<div class="row">
					<div class="col-md-6">
						<label for="signup-firstname">Prénom</label>
						<input type="text" name="first_name" class="form-control" id="signup-firstname" placeholder="Prénom">
					</div>

					<div class="col-md-6">
						<label for="signup-lastname">Nom</label>
						<input type="text" name="last_name" class="form-control" id="signup-lastname" placeholder="Nom">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label for="signup-email">Adresse email</label>
						<input type="text" name="email" class="form-control" id="signup-email" placeholder="Adresse email">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label for="signup-email-confirm">Confirmez votre adresse email</label>
						<input type="text" name="email" class="form-control" id="signup-email-confirm" placeholder="Confirmez votre adresse email">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label for="signup-email">Mot de passe</label>
						<input type="password" name="password" class="form-control" id="signup-password" placeholder="Mot de passe">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label for="signup-email-confirm">Confirmez votre mot de passe</label>
						<input type="password" name="password" class="form-control" id="signup-password-confirm" placeholder="Confirmez votre mot de passe">
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="signup-waynum">Numéro de voie</label>
						<input type="text" name="way_num" class="form-control" id="signup-waynum" placeholder="Numéro de voie">
					</div>

					<div class="col-md-6">
						<label for="signup-waytype">Type de voie</label>
						<select name="way_type" id="signup-waytype" class="form-control">
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
						<input type="text" name="way_name" class="form-control" id="signup-wayname" placeholder="Adresse">
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="signup-city">Ville</label>
						<input type="text" name="city" class="form-control" id="signup-city" placeholder="Ville">
					</div>

					<div class="col-md-6">
						<label for="signup-zipcode">Code postal</label>
						<input type="text" name="zip_code" class="form-control" id="signup-zipcode" placeholder="Code postal">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label for="signup-terms">Conditions d'utilisation</label>
						<textarea class="form-control">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse at quam eget dolor mattis dapibus sit amet in ante. Nunc mattis euismod dapibus. Nunc ullamcorper finibus metus dapibus tristique. Maecenas malesuada bibendum metus, quis lacinia nisl consectetur in. In nec ex ac nulla sagittis tempus sed eu sem. Maecenas ac tortor eu justo volutpat tincidunt. Etiam commodo magna consequat risus pharetra, at interdum velit congue. Morbi sed leo congue, placerat libero ut, pretium lorem. Fusce maximus nisl eu lectus lacinia malesuada. Ut placerat eget odio eget commodo. Duis venenatis tincidunt blandit. Ut vitae hendrerit massa. Donec elementum semper dolor quis varius. Nam sollicitudin lacus vel elit porttitor mollis.</textarea>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="accept_terms" id="signup-terms">
								J'ai lu et j'accepte les <a href="#">conditions d'utilisations</a> et la <a href="#">politique de confidentialité</a>
							</label>
						</div>
					</div>
				</div>

				<input type="submit" class="btn btn-primary" value="Se connecter">
			</form>
		</div>
	</div>
</div>