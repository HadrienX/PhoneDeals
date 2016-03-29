<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<link rel="icon" href="img/favicon.png">
		<title><?php echo App::$siteTitle; ?></title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<div id="signin-modal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h1 class="modal-title">Connexion</h1>
					</div>

					<div class="modal-body">
						<form name="login" method="POST" action="index.php?page=login">
							<div class="form-group">
								<label for="login-email">Adresse email</label>
								<input type="text" name="email" class="form-control" id="login-email" value="admin" placeholder="Email">
							</div>

							<div class="form-group">
								<label for="login-password">Mot de passe</label>
								<input type="password" name="password" class="form-control" id="login-password" value="admin" placeholder="Mot de passe">
							</div>

							<input type="submit" class="btn btn-primary" value="Se connecter">
						</form>
					</div>
					<div class="modal-footer">
						<p><a href="index.php?page=signup">Pas encore membre ?</a></p>
					</div>
				</div>
			</div>
		</div>

		<nav class="navbar navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php?page=home"><?php echo App::$siteTitle; ?></a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li<?php App::isCurrentPage('home'); ?>><a href="index.php?page=home">Accueil</a></li>
						<li<?php App::isCurrentPage('list'); ?>><a href="index.php?page=list">Téléphones</a></li>
						<li<?php App::isCurrentPage('about'); ?>><a href="index.php?page=about">À propos</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="index.php?page=cart"><i class="fa fa-shopping-cart"></i> 0</a></li>
						<?php if (App::isLogged()) : ?>
							<?php $member = Member::getMemberById($_SESSION['id']); ?>
							<li class="dropdown">
								<a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" id="drop1">
									<img src="<?php echo App::getGravatar($member->email, 20); ?>" alt="Avatar de <?php echo $member->first_name; ?>" style="margin-right: 5px;" />
									<?php echo $member->first_name; ?>
									<span class="caret"></span>
								</a>
								<ul aria-labelledby="drop1" class="dropdown-menu">
									<li><a href="index.php?page=profile">Profil</a></li>
									<li><a href="index.php?page=orders">Mes commandes</a></li>
									<?php
										if ($member->admin) {
											echo '
												<li class="divider" role="separator"></li>
												<li><a href="index.php?page=admin/home">Administration</a></li>
											';
										}
									?>
								</ul>
							</li>
	                        <li><a href="index.php?page=signout">Déconnexion</a></li>
						<?php else: ?>
	                        <li<?php App::isCurrentPage('signup'); ?>><a href="index.php?page=signup">Inscription</a></li>
	                        <li<?php App::isCurrentPage('signin'); ?>><a href="#" data-toggle="modal" data-target="#signin-modal">Connexion</a></li>
	                    <?php endif; ?>
                    </ul>
				</div>
			</div>
		</nav>

		<?php
			if ($msg->hasMessages()) {
				$msg->display();
			}
		?>