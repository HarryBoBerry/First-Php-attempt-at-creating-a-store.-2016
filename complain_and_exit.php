<?php
    /*======
        function: complain_and_exit : string -> void

        purpose: expects a string saying what should have been
            entered that wasn't, and responds with a complaint
            screen making that complaint, and destroying 
            the current session and giving a form so the
            user can try again

        requires: 328footer.html
    =====*/

    function complain_and_exit($missing_info_type)
    {
        ?>
        <h2> A <?= $missing_info_type ?> Is Required To Continue Please Try Again </h2>

        <form method="post"
              action="<?= htmlentities($_SERVER['PHP_SELF'], 
                                       ENT_QUOTES) ?>">
            <input type="submit" value="Try again!" />
        </form>

        <?php
        session_destroy();

        ?>
</body>
</html>
        <?php
        exit;
    }
?>


