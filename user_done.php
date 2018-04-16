<?php
    /* stub version to start */

    function user_done()
    {
        ?> 
        <h2> User done? </h2>
		<form method="post"
              action="<?= htmlentities($_SERVER['PHP_SELF'], 
                                       ENT_QUOTES) ?>">
            <input type="submit" name="another_edit" value="Change Something Else?" />
            <input type="submit" name="user_done" value="Done" />
        </form>   
        <?php
    }
?>
