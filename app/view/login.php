<?php
	if (isset($_POST['email']) && !empty($_POST['email']))  {
		try {
			$email = $_POST['email'];
			$password = $_POST['password'];

			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "SELECT COUNT(*) FROM member WHERE email = :email && password = :password";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Phone');
			$sth->execute(array(
				':email' => $email,
				':password' => $password
			));

			if ($sth->fetchColumn() > 0) {
				$_SESSION['email'] = $email;
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