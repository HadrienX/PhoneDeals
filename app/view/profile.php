<?php if (App::isLogged()) { ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row" style="margin-bottom: 15px;">
					<div class="col-md-12">
						<h1>Votre profil</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<img src="<?php echo App::getGravatar($member->email); ?>" alt="Avatar de <?php echo $member->first_name; ?>" />
					</div>
					<div class="col-md-9">
						<h3>Email</h3>
						<?php echo $member->email; ?>
						<h3>Adresse</h3>
						<?php echo $member->way_num; ?>
						<?php echo $member->way_type; ?>
						<?php echo $member->way_name; ?><br />
						<?php echo $member->zip_code; ?>
						<?php echo $member->city; ?>
						<h3>Inscrit depuis le</h3>
						<?php echo $member->register_date; ?><br />
						<a href="#" class="btn btn-lg btn-primary" style="margin-top: 30px;">Éditer</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	}

	else {
		App::getHeader(404);
	}
?>