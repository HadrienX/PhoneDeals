<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlentities($_GET['id']);
    $member = Member::getMemberById($id);

    if (isset($_POST['edit'])) {
        if(preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['first_name']) && 
           preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['last_name']) &&
           preg_match("#^[0-9]{1,}$#", $_POST['way_num']) &&
           preg_match("#^[a-zA-Z0-9._-]{2,30}#", $_POST['way_name']) &&
           preg_match("#^[a-zA-Z0-9._-]{2,30}#", $_POST['city']) &&
           preg_match("#^[0-9]{5}$#", $_POST['zip_code'])
          ){
            PDOConnexion::setParameters('phonedeals', 'root', 'root');
            $db = PDOConnexion::getInstance();
            $sql = "
				UPDATE member
				SET first_name = :first_name,
                last_name = :last_name,
                way_num = :way_num,
                way_type = :way_type,
                way_name = :way_name,
                city = :city,
                zip_code = :zip_code
				WHERE id = :id
			";
            $sth = $db->prepare($sql);
            $sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Member');
            $sth->execute(array(
                ':id' => $id,
                ':first_name' => $_POST['first_name'],
                ':last_name' => $_POST['last_name'],
                ':way_num' => $_POST['way_num'],
                ':way_type' => $_POST['way_type'],
                ':way_name' => $_POST['way_name'],
                ':city' => $_POST['city'],
                ':zip_code' => $_POST['zip_code']

            ));

            if ($sth) {
                App::success('Le profil de ce membre a bien été modifiée');
            }
        }
        else{App::error("Les champs ne sont pas valides");}
    }

    if ($member) :
?>
<div class="col-md-8">
    <div class="page-header">
        <h1>Éditer une membre</h1>
    </div>

    <form action="index.php?page=admin/member-edit&amp;id=<?php echo $id; ?>" method="POST">
        <div class="form-group">
            <label for="member-first_name">Prenom</label>
            <input type="text" class="form-control" id="brands-first_name" value="<?php echo $member->first_name; ?>" name="first_name" placeholder="Prenom">
        </div>
        <div class="form-group">
            <label for="member-last_name">Nom</label>
            <input type="text" class="form-control" id="brands-last_name" value="<?php echo $member->last_name; ?>" name="last_name" placeholder="Nom">
        </div>
        <div class="form-group">
            <label for="member-way_num">Numéro de voie</label>
            <input type="text" class="form-control" id="brands-way_num" value="<?php echo $member->way_num; ?>" name="way_num" placeholder="Numéro de voie">
        </div>
        <div>
            <label for="signup-waytype">Type de voie</label>
            <select name="way_type" id="signup-waytype" required="required" class="form-control">
                <option value=""></option>
                <?php
    foreach (Member::getWayTypes() as $way) {
        $selected = ($way == 'Rue') ? $selected = 'selected' : $selected = '';

        echo '<option value="' . strtolower($way) . '"' . $selected . '>' . $way . '</option>';
    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="member-way_name">Nom de la voie</label>
            <input type="text" class="form-control" id="brands-way_name" value="<?php echo $member->way_name; ?>" name="way_name" placeholder="Nom de la voie">
        </div>
        <div class="form-group">
            <label for="member-city">Ville</label>
            <input type="text" class="form-control" id="brands-city" value="<?php echo $member->city; ?>" name="city" placeholder="Ville">
        </div>
        <div class="form-group">
            <label for="member-zip_code">Code postal</label>
            <input type="text" class="form-control" id="brands-zip_code" value="<?php echo $member->zip_code; ?>" name="zip_code" placeholder="Code Postal">
        </div>

        <button type="submit" class="btn btn-lg btn-primary" name="edit">Éditer</button>
    </form>
</div>
<?php
    else:
    App::redirect('index.php?page=admin/members-list');
    endif;
}

else {
    App::redirect('index.php?page=admin/members-list');
}
?>