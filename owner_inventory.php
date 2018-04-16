<?php
    /* Dynamically creating the Inventory, Add Item, and Resolve Request */

    function owner_inventory($username, $password)
    {
		$conn = hsu_con_sess($username, $password);

        ?>
		<!-- Start by creating the inventory List -->

		<form method="post"
			action="<?=htmlentities($_SERVER['PHP_SELF'],
									ENT_QUOTES) ?>">
    <p>
        <ul>
           <li>
           Select an Item. Than select "Remove" or "Edit Quantity" depending
           on what you would like. You may also use "Reset", which will reset
           the check boxes.
         </li>
       </ul>
    </p>
		<fieldset>
		<legend> Inventory </legend>

		<?php

		// query for a list of the inventory

		$inv_query = 'select item_name, item_qty, item_id
					  from inventory
					  order by item_name';

		$inv_stmt = oci_parse($conn, $inv_query);
		oci_execute($inv_stmt, OCI_DEFAULT);
		?>
<div class="container-owner-inventory">
<div class="container">
    <div class ="row justify-content-start">
      <div class = "col-2">
      <table class ="table">
        <tr>
          <th> ID # </th>
          <th> Item Name </th>
          <th> Quantity </th>
        </tr>

        <?php // 1 START: get list one item at a time
        while (oci_fetch($inv_stmt))
        {
            $curr_item = oci_result($inv_stmt, "ITEM_NAME");
            $curr_qty = oci_result($inv_stmt, "ITEM_QTY");
            $curr_id = oci_result($inv_stmt, "ITEM_ID")
		// 1 END:
            ?>

            <tr>
              <td> <?=$curr_id ?> </td>
              <td> <?= $curr_item ?> </td>
              <td> <?= $curr_qty ?> </td>
	      <td> <input type="checkbox" name='checkboxvar[]' value = <?=$curr_id?>
            </tr>
            <?php
        }
// TRYNA PASS ITEM ID TO REMOVE FUNCTION
	//$_COOKIE['remove_id'] = $curr_id;
//	$_SESSION['test']='Good Evening Professor Chaos';
//	$_SESSION['id'] = $_POST['value'];

//	RIGHT NOW these are ALWAYS the last item on the list since you are setting it  ot the
// 	PHP variable and not the selected checked box
//	$_SESSION['remove_id']= $curr_id;
//	$_SESSION['remove_name']= $curr_item;
//	$_SESSION['remove_id'] = 'value';
//	$_SESSION['remove_name'] = 'name';
// Have to got to dumb work rn
// https://stackoverflow.com/questions/25933138/implode-array-for-php-checkbox-in-form
// if you store the output of the list in an array you should be able to store the
// checked boxes in one. Then pass that array (deliminated w/ ',') to the remvoe function
// THEN pass it to the delte string. bamf removed
        ?>
     	</table>
      </div>
    </div>
</div>
</div>
		<?php
		oci_free_statement($inv_stmt);
		oci_close($conn);


		?>

		</select>

				<fieldset>
					<input type="submit" name="edit" value="Edit Quantity" />
					<input type="submit" name="remove" value="Remove" />
					<input type="submit" name="add" value="Add Item" />
					<input type="Reset" value="Reset" />
				</fieldset>
<!--
    <input type="submit" class="btn btn-primary" name="edit" value ="edit"> Edit />
    <input type="submit" class="btn btn-primary" name="modify" value ="modify"> Modify </button>
    <button type="Reset" class="btn btn-primary" value ="reset"> Reset </button>


           <fieldset>
				<p> To add an item, enter the Item Name and the Quantity, then select Add Item. </p>

                <label for="item_name"> Item Name: </label>
                <input type="text" name="itemname" id="item_name"  />

                <label for="item_qty"> Quantity: </label>
                <input type="text" name="qty" id="item_qty" />

            </fieldset>
			            <div class="submit">
							<input type="submit" value="Add Item" />
						</div>
-->
	</fieldset>
	</form>

			<?php
	// IT GOES HERE DINGUS
//	if (isset($_POST['checkboxvar'])){
//		print_r($_POST['checkboxvar']);
//	}
	$_SESSION['trythis'] = $curr_id;
    }
?>
