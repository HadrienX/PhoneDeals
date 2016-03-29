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
			$this->$n = $v;
		}

		public function __toString(){
			return $this->name;
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
			$sth = $db->prepare('SELECT * FROM phone');
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Phone');
			$sth->execute();
			
			return $sth->fetchAll();
		}

		public static function getPhonesListPaginate($start, $limit, $sort) {
			if($sort['search']){
				$search = 'name LIKE "%' . $sort['search'] . '%"';

				PDOConnexion::setParameters('phonedeals', 'root', 'root');
				$db = PDOConnexion::getInstance();
				$sql = "SELECT * FROM phone WHERE $search LIMIT $start, $limit";
				$sth = $db->prepare($sql);
				$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Phone');
				$sth->execute();

				// App::dd($sth->fetchAll());
				
				return $sth->fetchAll();
			}
			else{
				$brand = "brand != ''";
				$color = "color != ''";
				$capacity = "capacity != ''";

				if($sort['brand']){
					$brand = 'brand = ' . Brand::getBrandIdByName($sort['brand']);
				}

				if($sort['color']){
					$color = 'color LIKE "%' . $sort['color'] . '%"';
				}

				if($sort['capacity']){
					$capacity = 'capacity LIKE "%' . $sort['capacity'] . '%"';
				}

				PDOConnexion::setParameters('phonedeals', 'root', 'root');
				$db = PDOConnexion::getInstance();
				$sql = "SELECT * FROM phone WHERE $brand AND $color AND $capacity LIMIT $start, $limit";
				$sth = $db->prepare($sql);
				$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Phone');
				$sth->execute();

				// App::dd($sth->fetchAll());
				
				return $sth->fetchAll();
			}
		}

		public static function homePhones() {
			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sth = $db->prepare('SELECT * FROM phone LIMIT 6');
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Phone');
			$sth->execute();
			
			return $sth->fetchAll();
		}

		public static function countPhones($sort) {
			$where = '';

			if ($sort['brand'] || $sort['capacity'] || $sort['color']) {
				$where = 'WHERE ';
				
				if ($sort['brand']) {
					$where .= 'brand = ' . Brand::getBrandIdByName($sort['brand']);

					if ($sort['color'] || $sort['capacity']) {
						$where .= ' && ';
					}
				}

				if ($sort['color']) {
					$where .= 'color = 1';

					if ($sort['capacity']) {
						$where .= ' && ';
					}
				}

				if ($sort['capacity']) {
					$where .= 'capacity = 16';
				}
			}

			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sth = $db->prepare('SELECT COUNT(*) as total FROM phone ' . $where);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Phone');
			$sth->execute();
			
			return $sth->fetch()->total;
		}

		public static function getLatestPhones() {
			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM phone ORDER BY id DESC LIMIT 9';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Phone');
			$sth->execute();
			
			return $sth->fetchAll();
		}

		public static function getPhoneThumbnail($id) {
			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT name, color FROM phone WHERE id = :id';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Phone');
			$sth->execute(array(
				':id' => $id
			));
			
			$req = $sth->fetch();
			$colors = explode(',', $req->color);
			$imgUrl = 'uploads/phones/' . $id . '/' . App::url($req->name) . '-' . $colors[0] . '.jpg';

			if (!file_exists($imgUrl)) {
				return 'img/default-thumbnail.jpg';
			}

			return $imgUrl;
		}

		public static function deletePhone($id) {
			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'DELETE FROM phone WHERE id = :id';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Phone');
			$sth->execute(array(
				':id' => $id
			));
		}
	}
?>
