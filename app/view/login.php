<?php
	if (isset($_POST['email']) && !empty($_POST['email']))  {
		try {
			$email = $_POST['email'];
			$password = $_POST['password'];

			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "SELECT id, admin FROM member WHERE email = :email && password = :password";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Member');
			$sth->execute(array(
				':email' => $email,
				':password' => $password
			));

			$member = $sth->fetch();

			if ($member->id > 0) {
				$_SESSION['id'] = $member->id;
				$_SESSION['email'] = $email;

				if ($member->admin) {
					$_SESSION['admin'] = true;
				}
			}

			echo '<script>document.location.href="index.php?page=home"</script>';
		}

		catch(PDOException $e) {
			echo 'Erreur de connexion : ' . $e->getMessage() . '<br />';
			die();
		}
	}

	else {
		echo '<script>document.location.href="index.php?page=home"</script>';
	}
?>
