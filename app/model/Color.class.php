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

		public function __toString(){
			return "<p>{$this->id} - {$this->name} - {$this->hex}</p>";
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
	}
?>