<?php
    /*
	function: add
    purpose: adds a new item into the inventory table and has a side effect of
	         printing to the screen how many rows it inserted (it should only
			 be one or none!)
	*/

    function edit_thing()
    {
		$username = strip_tags($_SESSION['username']);
		$password = $_SESSION['password'];
		$conn = hsu_con_sess($username, $password);


	// checkboxvar has the itemqty in it
		$edit_item_id = implode(',', ($_POST['dem_ids']));
		$edit_item_qty = implode(',', ($_POST['checkboxvar']));
		
		echo "$edit_item_id";
		echo "$edit_item_qty";

		//$new_item_name = strip_tags($_POST['itemname']);
//		$new_item_qty = strip_tags($_POST['item_qty']);
//		$edit_item_id = strip_tags($POST['item_id']);

		// Using bind variables to build the the SQL insert
        $edit_string = 'update inventory
                          set item_qty = :new_item_qty
				where item_id = :edit_item_id';

//USE A LOOP. UPDATE ONE AT A TIME!!
        $edit_stmt = oci_parse($conn, $edit_string);

        // then bind values to the bind variables
        oci_bind_by_name($edit_stmt, ":edit_item_id", $edit_item_id);
        oci_bind_by_name($edit_stmt, ":new_item_qty", $new_item_qty);

		/* 
		now the rows can be inserted -- it should return the number of
		rows that were inserted
		*/
		
        $num_edited = oci_execute($edit_stmt, OCI_DEFAULT);

        if ($num_edited != 1)
        {
            ?>
            <p> No row inserted </p>
            <?php
        }
        else
        {
            ?>
            <p> One item has been added. </p>

            <?php
		
		// ASK IF USER HAS FINISHED
            $_SESSION['next_page']= "is_user_done";

            // commiting the insert
             oci_commit($conn);
        }

        // free statement, close connection
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
