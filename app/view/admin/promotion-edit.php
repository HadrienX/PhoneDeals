<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlentities($_GET['id']);
    $promotion = Promotion::getPromotionById($id);

    if (isset($_POST['edit'])) {
        if(preg_match("#^([0-9]{1,2}|100)$#", $_POST['percent'])
          ){
            PDOConnexion::setParameters('phonedeals', 'root', 'root');
            $db = PDOConnexion::getInstance();
            $sql = "
				UPDATE promotion
				SET percent = :percent
				WHERE id = :id
			";
            $sth = $db->prepare($sql);
            $sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Promotion');
            $sth->execute(array(
                ':id' => $id,
                ':percent' => $_POST['percent']
            ));

            if ($sth) {
                App::success('La promotion a bien été modifiée');
            }
        }
        else{App::error("Les champs ne sont pas valides");}
    }

    if ($member) :
?>
<div class="col-md-8">
    <div class="page-header">
        <h1>Éditer une promotion</h1>
    </div>

    <form action="index.php?page=admin/promotion-edit&amp;id=<?php echo $id; ?>" method="POST">
        <div class="form-group">
            <label for="phone">Téléphone</label>
            <p><?php echo Phone::getPhoneById($promotion->phone)->name; ?></p>
        </div>
        <div class="form-group">
            <label for="promotion-percent">Pourcentage</label>
            <input type="text" class="form-control" id="promotion-percent" value="<?php echo $promotion->percent; ?>" name="percent" placeholder="Pourcentage">
        </div>
        
        <button type="submit" class="btn btn-lg btn-primary" name="edit">Éditer</button>
    </form>
</div>

<?php
    else:
    App::redirect('index.php?page=admin/promotions-list');
    endif;
}

else {
    App::redirect('index.php?page=admin/promotions-list');
}
?>