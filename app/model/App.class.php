<?php
	class App {
		public static $siteTitle = 'PhoneDeals';

		public static function isCurrentPage($page) {
			if ($_GET['page'] == $page) {
				echo ' class="active"';
			}
		}

		public static function error($log) {
			echo '
				<div class="erreur">
					<div class="container">
						<i class="fa fa-times-circle"></i>
						' . $log . '
					</div>
				</div>
			';
		}

		public static function success($log) {
			echo '
				<div class="success">
					<div class="container">
						<i class="fa fa-check"></i>
						' . $log . '
					</div>
				</div>
			';
		}

		public static function url($url) {
			$url = strip_tags($url);
			$url = strtolower($url);

			trim($url);
			$url = preg_replace('%[.,:\'"/\\\\[\]{}\%\-_!?]%simx', ' ', $url);
			$url = str_ireplace(' ', '-', $url);
			$url = str_ireplace('---', '-', $url);
			$url = str_ireplace('-|', '', $url);
			$url = str_ireplace('-&', '', $url);
			$url = self::removeAccents($url);

			return $url;
		}

		private static function removeAccents($str, $charset = 'utf-8') {
			$str = htmlentities($str, ENT_NOQUOTES, $charset);

			$str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
			$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
			$str = preg_replace('#&[^;]+;#', '', $str);

			return $str;
		}
	}
?>