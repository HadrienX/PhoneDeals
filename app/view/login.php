<?php
	if (!App::isLogged()) {
		try {
			$email = $_POST['email'];
			$password = $_POST['password'];

			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();

			$sql = "SELECT id, admin, password FROM member WHERE email = :email";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Member');
			$sth->execute(array(':email' => $email));

			$member = $sth->fetch();

			if ($member) {
				if (Bcrypt::checkPassword($password, $member->password)) {
					if ($member->id > 0) {
						$_SESSION['id'] = $member->id;
						$_SESSION['email'] = $email;

						if ($member->admin) {
							$_SESSION['admin'] = true;
						}
					}

					App::redirect('index.php?page=home');
				}
			}

			App::error('Identifiants incorrects !');
		}

		catch(PDOException $e) {
			echo 'Erreur de connexion : ' . $e->getMessage() . '<br />';
			die();
		}
	}

	else {
		App::redirect('index.php?page=home');
	}
?>