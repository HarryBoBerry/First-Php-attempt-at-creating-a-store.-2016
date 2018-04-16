<?php

//error_reporting(E_ALL);
/*
	This function takes in the boxes checked in owner_inventory.php
	and edits them in the database.
*/

    function edit()
    {
		$username = strip_tags($_SESSION['username']);
		$password = $_SESSION['password'];
		$conn = hsu_con_sess($username, $password);

		$edit_id = implode(',', ($_POST['checkboxvar']));

		$edit_query = "select item_name, item_qty, item_id
					  from inventory
					where item_id in ($edit_id)";
//					  order by item_name';

//		$edit_query = "delete from inventory where item_id in ($edit_id)";
		$edit_stmt = oci_parse($conn, $edit_query);
		$edited_items = oci_execute($edit_stmt, OCI_DEFAULT);
/*

		$grabbed = 'select item_name, item_qty, item_id
					  from inventory
					  order by item_name';
		$del_id = implode(',', ($_POST['checkboxvar']));
		$del_string = "delete from inventory where item_id in ($del_id)";
		$delete_stmt = oci_parse($conn, $del_string);
		$deleted_items = oci_execute($delete_stmt, OCI_DEFAULT);

*/
?>
<div class="container-edit">
<div class="container">
    <div class ="row justify-content-start">

 	     <div class = "col-3">
      <table class ="table">
        <tr>
          <th> ID # </th>
          <th> Item Name </th>
          <th> Quantity </th>
        </tr>

        <?php	// 1 START: get list one item at a time
        while (oci_fetch($edit_stmt))
        {
            $curr_item = oci_result($edit_stmt, "ITEM_NAME");
            $curr_qty = oci_result($edit_stmt, "ITEM_QTY");
            $curr_id = oci_result($edit_stmt, "ITEM_ID")
		// 1 END:
            ?>

            <tr>
              <td> <?=$curr_id ?> </td>
	      <td> <?= $curr_item ?> </td>
              <td> <?= $curr_qty ?> </td> 
	      <td> <input type="textbox" name='checkboxvaredit[]' value = <?=$curr_qty?> /> </td>
	      <td> <input type="hidden" name='dem_ids[]' value = <?=$curr_id?>/>  </td>
            </tr>
        </div>
      </div>
    </div>
  </div>
	<?php
	}

		if ($edited_items != 1)
		{
			?>
			<p> Nothing edited </p>
			<?php
		}
		else
		{
			?>
			<p> Editing was successful. </p>
			<?php

			// ASK IF USER HAS FINISHED

            $_SESSION['next_page']= "is_user_done";

	// commiting the insert
			oci_commit($conn);
		}
		oci_free_statement($edit_stmt);
        oci_close($conn);

        ?>

		<form method="post"
              action="<?= htmlentities($_SERVER['PHP_SELF'],
                                       ENT_QUOTES) ?>">
            <input type="submit" name="another_edit" value="Another Edit" />
			<input type="submit" name="user_done" value="Done"/>

        </form>
        <?php

		}

?>

<?php


/*
	function: add
    purpose: adds a new item into the inventory table and has a side effect of
	         printing to the screen how many rows it inserted (it should only
			 be one or none!)
	*/
	/*

    function add()
    {

	$username = strip_tags($_SESSION['username']);
	$password = $_SESSION['password'];

	$conn = hsu_con_sess($username, $password);

        ?>
		<form method ="post"
			action ="<?=htmlentities($_SERVER['PHP_SELF'],
											ENT_QUOTES) ?>">

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
		</form>
       <?php
    }
?>
*/
