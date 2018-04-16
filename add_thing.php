<?php
    /*
	function: add
    purpose: adds a new item into the inventory table and has a side effect of
	         printing to the screen how many rows it inserted (it should only
			 be one or none!)
	*/

    function add_thing()
    {
		$username = strip_tags($_SESSION['username']);
		$password = $_SESSION['password'];

		$conn = hsu_con_sess($username, $password);

		$new_item_name = strip_tags($_POST['itemname']);
		$new_item_qty = strip_tags($_POST['qty']);

		// Using bind variables to build the the SQL insert
        $insert_string = 'insert into inventory
                          values
                          (inv_seq.nextval, :new_item_name, :new_item_qty)';

        $insert_stmt = oci_parse($conn, $insert_string);

        // then bind values to the bind variables
        oci_bind_by_name($insert_stmt, ":new_item_name", $new_item_name);
        oci_bind_by_name($insert_stmt, ":new_item_qty", $new_item_qty);

		/* 
		now the rows can be inserted -- it should return the number of
		rows that were inserted
		*/
		
        $num_inserted = oci_execute($insert_stmt, OCI_DEFAULT);

        if ($num_inserted != 1)
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
        oci_free_statement($insert_stmt);
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
