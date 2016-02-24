<?php	
	class Capacity {
		private $id;
		private $storage;
		
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

		public static function getCapacityList() {
			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM capacity';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Capacity');
			$sth->execute();
			
			return $sth->fetchAll();
		}
	}
?>
