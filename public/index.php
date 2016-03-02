<?php
    // On définit les constantes pour simplifier les écritures des chemins de notre site
    define('PUBLIC_ROOT', dirname($_SERVER['SCRIPT_FILENAME']));
    define('ROOT', dirname(PUBLIC_ROOT));
    define('DS', DIRECTORY_SEPARATOR);
    define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
    define('DOMAIN', $_SERVER['HTTP_HOST']);
    define('PROTOCOLE', (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') ? 'https' : 'http');
	define('SYSTEM', ROOT . DS . 'system');
	define('APP', ROOT . DS . 'app');

	require_once(APP . '/model/PDOConnexion.php');
	require_once (APP . '/model/Autoloader.php');
	Autoloader::register(); // Pour ne plus avoir à inclure manuellement chaque fichier de classe

	session_start();
	ob_start();

	if (empty($_GET['page'])) {
		$_GET['page'] = 'home';
	}

	if ($_GET['page'] == 'admin') {
		if (App::isAdmin()) {
			require_once(APP . '/view/admin/header.php');
			require_once(APP . '/view/admin/home.php');
			require_once(APP . '/view/admin/footer.php');
		}

		else {
			App::getHeader(404);
		}
	}

	else {
		if (!file_exists(APP . '/view/' . $_GET['page'] . '.php')) {
			App::getHeader(404);
		}

		else {
			require_once(APP . '/view/header.php');
			require_once(APP . '/view/' . $_GET['page'] . '.php');
			require_once(APP . '/view/footer.php');
		}
	}

	ob_end_flush();
?>