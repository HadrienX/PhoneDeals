<?php
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$id = htmlentities($_GET['id']);
		$capacity = Capacity::getCapacityById($id);

		if (isset($_POST['edit'])) {
			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				UPDATE capacity
				SET storage = :storage
				WHERE id = :id
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Capacity');
			$sth->execute(array(
				':id' => $id,
				':storage' => $_POST['storage']
			));
			
			if ($sth) {
				App::success('Cette capacité a bien été modifiée');
			}
		}

		if ($capacity) :
?>
				<div class="col-md-8">
					<div class="page-header">
						<h1>Éditer une capacité</h1>
					</div>

					<form action="index.php?page=admin/capacity-edit&amp;id=<?php echo $id; ?>" method="POST">
						<div class="form-group">
							<label for="capacity-name">Nom</label>
							<input type="text" class="form-control" id="capacity-name" value="<?php echo $capacity->storage; ?>" name="storage" placeholder="Capacité">
						</div>

						<button type="submit" class="btn btn-lg btn-primary" name="edit">Éditer</button>
					</form>
				</div>
<?php
		else:
			App::redirect('index.php?page=admin/colors-list');
		endif;
	}

	else {
		App::redirect('index.php?page=admin/colors-list');
	}
?>