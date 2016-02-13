<?php	
	class Phone {
		private $id;
		private $name;
		private $brand;
		private $capacity;
		private $price;
		private $color;
		private $desc;
		
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
			$this->$n=$v;
		}

		public function __toString(){
			return "<p>{$this->id} - {$this->name} - {$this->brand} - {$this->capacity} - {$this->price} - {$this->color} - {$this->desc}</p>";
		}

		public static function getPhoneById($id) {
			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM phone WHERE id = :id';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Phone');
			$sth->execute(array(
				':id' => $id
			));
			
			return $sth->fetch();
		}

		public static function getPhonesList() {
			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM phone';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Phone');
			$sth->execute();
			
			return $sth->fetchAll();
		}
	}
?>