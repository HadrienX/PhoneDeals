<?php	
	class Member {
		private $id;
		private $first_name;
		private $last_name;
		private $email;
		private $password;
		private $way_num;
		private $way_type;
		private $way_name;
		private $city;
		private $zip_code;
		private $admin;
		private $register_date;
		
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
		}

		public static function getMemberById($id) {
			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM member WHERE id = :id';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Member');
			$sth->execute(array(
				':id' => $id
			));
			
			return $sth->fetch();
		}

		public static function getMembersList() {
			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'SELECT * FROM member';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Member');
			$sth->execute();
			
			return $sth->fetchAll();
		}

		public static function getWayTypes() {
			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			
			$sql = "SHOW COLUMNS FROM member WHERE Field = 'way_type'";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Member');
			$sth->execute();

			$results = $sth->fetch()->Type;
			$enumList = explode(",", str_replace("'", "", substr($results, 5, (strlen($results) - 6))));
			
			return $enumList;
		}

		public static function deleteMember($id) {
			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = 'DELETE FROM member WHERE id = :id';
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Member');
			$sth->execute(array(
				':id' => $id
			));
		}

		public static function changePassword($password, $id) {
			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				UPDATE member
				SET password = :password
				WHERE id = :id
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Member');
			$sth->execute(array(
				':password' => $password,
				':id' => $id
			));
			
			return $sth;
		}
	}
?>