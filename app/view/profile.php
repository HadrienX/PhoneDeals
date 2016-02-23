<?php if (App::isLogged()) { ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<h1>Votre profil</h1>
					<img src="<?php echo App::getGravatar($member->email); ?>" alt="Avatar de <?php echo $member->first_name; ?>" />
				</div>
			</div>
		</div>
	</div>
<?php
	}
	else {
		header("HTTP/1.0 404 Not Found");
	}
?>