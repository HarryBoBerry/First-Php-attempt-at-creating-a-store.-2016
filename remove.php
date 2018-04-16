<?php
//error_reporting(E_ALL);
/* 
	This function takes in the boxes checked in owner_inventory.php	
	and deletes them from the database.
*/
    function remove()
    {
		$username = strip_tags($_SESSION['username']);
		$password = $_SESSION['password'];
		$conn = hsu_con_sess($username, $password);

		$del_id = implode(',', ($_POST['checkboxvar']));
		$del_string = "delete from inventory where item_id in ($del_id)";
		$delete_stmt = oci_parse($conn, $del_string);
		$deleted_items = oci_execute($delete_stmt, OCI_DEFAULT);
		
		if ($deleted_items != 1)
		{
			?>
			<p> Nothing deleted </p>
			<?php
		}
		else
		{
			?>
			<p> Deletion was successful. </p>
			<?php
		
			// ASK IF USER HAS FINISHED
            $_SESSION['next_page']= "is_user_done";

            // commiting the insert
			oci_commit($conn);
		}
		oci_free_statement($delete_stmt);
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

