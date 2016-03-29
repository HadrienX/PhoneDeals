<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlentities($_GET['id']);
    $order = Order::getOrderById($id);

    if (isset($_POST['edit'])) {
        if(preg_match("#^[0-9]$#", $_POST['paid_price']) && 
           preg_match("#^[0-9]$#", $_POST['paid_price_atv']) && 
           preg_match("#^[a-zA-Z._-]{2,32}#", $_POST['sent_method'])
          ){
            PDOConnexion::setParameters('phonedeals', 'root', 'root');
            $db = PDOConnexion::getInstance();
            $sql = "
				UPDATE orders
				SET paid_price = :paid_price,
                paid_price_vat = :paid_price_vat,
                sent_method = :sent_method
				WHERE id = :id
			";
            $sth = $db->prepare($sql);
            $sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Member');
            $sth->execute(array(
                ':id' => $id,
                ':paid_price' => $_POST['paid_price'],
                ':paid_price_vat' => $_POST['paid_price_vat'],
                ':sent_method' => $_POST['sent_method'],
                ':phones' => $_POST['phones']

            ));

            if ($sth) {
                App::success('La commande a bien été modifiée');
            }
        }
        else{App::error("Les champs ne sont pas valides");}
    }

    if ($member) :
?>
<div class="col-md-8">
    <div class="page-header">
        <h1>Éditer une commande</h1>
    </div>

    <form action="index.php?page=admin/member-edit&amp;id=<?php echo $id; ?>" method="POST">
        <div class="form-group">
            <label for="member">Membre</label>
            <p><?php echo $member->first_name;
                     echo " ";
                     echo $member->last_name; ?></p>
            
            
        </div>
        <div class="form-group">
            <label for="order-paid_price">Prix HT</label>
            <input type="text" class="form-control" id="order-paid_price" value="<?php echo $order->paid_price; ?>" name="paid_price" placeholder="Prix HT">
        </div>
        <div class="form-group">
            <label for="order-paid_price_vat">Prix TTC</label>
            <input type="text" class="form-control" id="order-paid_price_vat" value="<?php echo $order->paid_price_vat; ?>" name="paid_price_vat" placeholder="Prix TTC">
        </div>
        <div>
            <label for="order-sent_method">Méthode d'envoi</label>
            <select name="sent_method" id="order-sent_method" required="required" class="form-control">
                <option selected="selected" value="Express">Express</option>
                <option value="Normal">Normal</option>
            </select>
        </div>
        <button type="submit" class="btn btn-lg btn-primary" name="edit">Éditer</button>
    </form>
</div>
<?php
    else:
    App::redirect('index.php?page=admin/orders-list');
    endif;
}

else {
    App::redirect('index.php?page=admin/orders-list');
}
?>