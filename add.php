<?php
    /*
	function: add
    purpose: adds a new item into the inventory table and has a side effect of
	         printing to the screen how many rows it inserted (it should only
			 be one or none!)
	*/

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
        <div class="container-add">
                <label for="item_name"> Item Name: </label>
                <input type="text" name="itemname" id="item_name"  />

                <label for="item_qty"> Quantity: </label>
                <input type="text" name="qty" id="item_qty" />

            </fieldset>
			       <div class="submit">
							<input type="submit" value="Add Item" />
						</div>
        </div>
		</form>

       <?php
    }
?>
