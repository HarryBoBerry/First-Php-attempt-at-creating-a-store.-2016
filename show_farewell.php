<?php
    /* stub version to start */

    function show_farewell()
    {
        ?> 
        <h2> User done? </h2>
		<form method="post"
              action="<?= htmlentities($_SERVER['PHP_SELF'], 
                                       ENT_QUOTES) ?>">
            <input type="submit" value="Yes" />
            <input type="submit" value="No" />
        </form>   
        <?php
    }
?>


