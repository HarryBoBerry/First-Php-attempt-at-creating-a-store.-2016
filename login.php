<?php
    //--------
    // function: login
    // purpose: expects nothing, and makes a form to
    //     request username and password
    //
    // by: Sharon Tuttle
    // last modified: 2015-03-18
    //--------

    function login()
    {
    ?>
        <div class="container-login">
        <form method="post"
              action="<?= htmlentities($_SERVER['PHP_SELF'],
                                       ENT_QUOTES) ?>">

        <fieldset>
            <legend> Please Enter Username/Password:
            </legend>
			</br>
            <label for="username"> Username: </label>
            <input type="text" name="username"
                               id="username" />
			</br>
            <label for="password"> Password: </label>
            <input type="password" name="password"
                   id="password" />




            <div class="submit">
                <input type="submit" value="log in" />
            </div>
        </fieldset>
        </form>
      </div>
    <?php
    }
?>
