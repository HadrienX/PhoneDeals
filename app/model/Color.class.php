<?php	
	class Color {
		private $id;
		private $name;
		private $hex;
		
		public function __construct(array $args = array()) {
			if (!empty($args)) {
				foreach($args as $p => $v) {
					$this->$p = $v;
				}
			}
		}

		public function __get($nom){
			return $this->$nom;
		}

		public function __set($n, $v){
			$this->$n = $v;
		}

		public static function getColorById($id) {
			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM color WHERE id = :id';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Color');
			$sth->execute(array(
				':id' => $id
			));
			
			return $sth->fetch();
		}

		public static function getColorList() {
			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM color';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Color');
			$sth->execute();
			
			return $sth->fetchAll();
		}

		public static function getColorsNames($colorsList, $badge = false) {
			$colors = explode(',', $colorsList);
			$colorsNames = '';

			if ($badge) {
				$color = '';

				foreach ($colors as $color) {
					$colorWhite = (self::getColorById($color)->name == 'Blanc') ? ' color: #000; border: 1px solid #000' : '';
					$colorsNames .= '<span class="badge" style="background-color: ' . self::getColorById($color)->hex . ';' . $colorWhite . '">' . self::getColorById($color)->name . '</span><br />';
				}

				return $colorsNames;
			}

			foreach ($colors as $color) {
				$colorsNames .= self::getColorById($color)->name . ', ';
			}

			return trim(trim($colorsNames), ',');
		}
	}
?>
