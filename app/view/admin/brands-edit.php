<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlentities($_GET['id']);
    $brands = Brand::getBrandById($id);

    if (isset($_POST['edit'])) {
        if(preg_match("#^[a-zA-Z0-9._-]{2,30}#", $_POST['name'])){
            PDOConnexion::setParameters('phonedeals', 'root', 'root');
            $db = PDOConnexion::getInstance();
            $sql = "
				UPDATE brand
				SET name = :name
				WHERE id = :id
			";
            $sth = $db->prepare($sql);
            $sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Brand');
            $sth->execute(array(
                ':id' => $id,
                ':name' => $_POST['name']
            ));

            if ($sth) {
                App::success('Cette marque a bien été modifiée');
            }
        }
        else{App::error("Le nom de cette marque n'est pas valide");}
    }

    if ($brands) :
?>
<div class="col-md-8">
    <div class="page-header">
        <h1>Éditer une marque</h1>
    </div>

    <form action="index.php?page=admin/brands-edit&amp;id=<?php echo $id; ?>" method="POST">
        <div class="form-group">
            <label for="brands-name">Nom de la marque</label>
            <input type="text" class="form-control" id="brands-name" value="<?php echo $brands->name; ?>" name="name" placeholder="Nom de la marque">
        </div>

        <button type="submit" class="btn btn-lg btn-primary" name="edit">Éditer</button>
    </form>
</div>
<?php
    else:
    App::redirect('index.php?page=admin/brands-list');
    endif;
}

else {
    App::redirect('index.php?page=admin/brands-list');
}
?>