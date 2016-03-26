<?php

		if (isset($_POST['add']) && App::isAdmin()) {

			PDOConnexion::setParameters('phonedeals', 'root', 'root');
			$db = PDOConnexion::getInstance();
			$sql = "
				INSERT INTO orders(member, date, paid_price, paid_price_vat, sent_method)
					VALUES (:member, NOW(), :paid_price, :paid_price_vat, :sent_method)
			";
			$sth = $db->prepare($sql);
			$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Order');
			$sth->execute(array(
				':member' => $_POST['member'],
				':paid_price' => $_POST['paid_price'],
				':paid_price_vat' => $_POST['paid_price_vat'],
				':sent_method' => $_POST['sent_method']
			));
			
			if ($sth) {
				App::success('Cette commande a bien été ajouté');
			}
			
		}
?>
				<div class="col-md-8">
				    <div class="page-header">
				        <h1>Ajouter une commande</h1>
				    </div>

				    <form action="index.php?page=admin/add-order" method="POST">

				    	<div class="form-group">
							<label for="order-member">Client</label>
							<select id="order-member" required="required" name="member" class="form-control">
								<option value="" disabled selected>Client</option>
								<?php
									foreach (Member::getMembersList() as $member) {
										echo '<option value="' . $member->id . '">' . $member->first_name . ' ' . $member->last_name . '</option>';
									}
								?>
							</select>
						</div>       		            
				        <div class="form-group">
				            <label for="order-paid_price">Prix HT</label>
				            <input type="text" class="form-control" id="order-paid_price" name="paid_price" placeholder="Prix HT">
				        </div>
				        <div class="form-group">
				            <label for="order-paid_price_vat">Prix TTC</label>
				            <input type="text" class="form-control" id="order-paid_price_vat" name="paid_price_vat" placeholder="Prix TTC">
				        </div>
				        <div>
				            <label for="order-sent_method">Méthode d'envoi</label>
				            <select name="sent_method" id="order-sent_method" required="required" class="form-control">
				                <option selected="selected" value="Express">Express</option>
				                <option value="Normal">Normal</option>
				            </select>
				        </div>
				        <button type="submit" class="btn btn-lg btn-primary" name="add">Ajouter</button>
				    </form>
				</div>
