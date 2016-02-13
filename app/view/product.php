<div class="container">
	<?php
		if (!isset($_GET['id'])) {
			echo "Vous n'avez pas entré d'ID";
		}

		else {
			$id = $_GET['id'];
			$p = Phone::getPhoneById($id);
			
			echo "<h1>{$p->name}</h1>";
			
			foreach($p as $e) {
				echo "$e<br/>";
			}
		}
	?>
</div>