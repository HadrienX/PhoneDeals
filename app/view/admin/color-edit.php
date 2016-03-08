<?php
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$id = htmlentities($_GET['id']);
		$color = Color::getColorById($id);

		if (isset($_POST['edit'])) {
			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				UPDATE color
				SET name = :name,
					hex = :hex
				WHERE id = :id
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Color');
			$sth->execute(array(
				':id' => $id,
				':name' => $_POST['name'],
				':hex' => $_POST['hex']
			));
			
			if ($sth) {
				App::success('Cette couleur a bien été modifiée');
			}
		}

		if ($color) :
?>
				<div class="col-md-8">
					<div class="page-header">
						<h1>Éditer une couleur</h1>
					</div>

					<form action="index.php?page=admin/color-edit&amp;id=<?php echo $id; ?>" method="POST">
						<div class="form-group">
							<label for="color-name">Nom</label>
							<input type="text" class="form-control" id="color-name" value="<?php echo $color->name; ?>" name="name" placeholder="Désignation de la couleur">
						</div>

						<div class="form-group">
							<label for="color-code">Code hexadécimal</label>
							<input type="text" class="form-control" id="color-code" value="<?php echo $color->hex; ?>" name="hex" placeholder="Code héxadécimal commençant par #">
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