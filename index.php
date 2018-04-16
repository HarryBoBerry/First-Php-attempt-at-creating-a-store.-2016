<?php
    session_start();
?>
<!DOCTYPE html>
<html  xmlns="http://www.w3.org/1999/xhtml">

<!--

	http://nrs-projects.humboldt.edu/~SuperTroopers/Chimpo3/index.php
    by: Super Troopers
    last modified: 2017-12-05	[:wq
-->

<head>
    <title> Chimpo </title>
    <meta charset="utf-8" />

    <?php

    /* these are bringing in PHP functions I am calling below */
    require_once("login.php");
    require_once("worker.php");
    require_once("user_done.php");
    require_once("complain_and_exit.php");
    require_once("hsu_con_sess.php");
    require_once("owner_inventory.php");
    require_once("edit.php");
    require_once("remove.php");
    require_once("add.php");
    require_once("add_thing.php");
    require_once("edit_thing.php");

    ?>

    <link href="http://users.humboldt.edu/smtuttle/styles/normalize.css"
          type="text/css" rel="stylesheet" />

	<!-- here we will be introducing our bootstrap	-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

	<!-- here we have the scripts for our bootstrap -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

  <style>
  body{
      background-color:#00ffff;
  }

  div.container-login{
      position: relative;
      margin: auto;
      padding: 10px;
      width: 400px;
      border: 1px solid;
      background: #E0F8EC;
      border-radius:10px;
  }
  div.container-owner-inventory{
      position: relative;
      left:100px;
      margin: auto;
      padding: 10px;
      width: 350px;
      border: 1px solid;
      background: #E0F8EC;
      border-radius:10px;
  }

  div.container-add{
      position: fixed;
      left:0px;
      margin: auto;
      padding: 10px;
      width: 600px;
      border: 1px solid;
      background: #E0F8EC;
      border-radius:10px;
  }

  div.container-edit{
      position: fixed;
      left:0px;
      margin: auto;
      padding: 10px;
      width: 600px;
      border: 1px solid;
      background: #E0F8EC;
      border-radius:10px;
  }
  </style>


</head>

<body>

	<?php
    if (! array_key_exists('next_page', $_SESSION))
    {
        login();
        $_SESSION['next_page'] = "inventory";
    }
    elseif ($_SESSION['next_page'] == "inventory")
    {
		if ( (! array_key_exists('username', $_POST)) or
             (trim($_POST['username']) == "") or
             (! isset($_POST['username'])) )
        {
            complain_and_exit("username");
        }

        if ( (! array_key_exists('password', $_POST)) or
             (trim($_POST['password']) == "") or
             (! isset($_POST['password'])) )
        {
            complain_and_exit("password");
        }

        $username = strip_tags($_POST["username"]);
        $password = $_POST['password'];

		// SAVING USER NAMES AND PASSWORD FOR FUTURE USE
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;

		owner_inventory($username, $password);
		$_SESSION['next_page'] = "editmod";
	}

	// if we reach here we will go to the edit.php page
    elseif(($_SESSION['next_page'] == "editmod")&&
			(array_key_exists("edit", $_POST)))
    {
        edit();
    //    $_SESSION['next_page'] = "is_user_done";
        $_SESSION['next_page'] = "edit_thing";
    }
	elseif($_SESSION['next_page'] == "edit_thing")
	{
		edit_thing();
		$_SESSION['next_page'] = "is_user_done";
	}


	// if we reach here we will use the remove.php function
    elseif(($_SESSION['next_page'] == "editmod")&&
			(array_key_exists("remove", $_POST)))
    {
        remove();
        $_SESSION['next_page'] = "is_user_done";
    }
	/* if we reach here we will go to add.php which will allow us to add value
	to the database
	*/

    elseif(($_SESSION['next_page'] == "editmod")&&
			(array_key_exists("add", $_POST)))
    {
        add();
        $_SESSION['next_page'] = "add_thing";
    }
	elseif ($_SESSION['next_page'] == "add_thing")
	{
		add_thing();
		$_SESSION['next_page'] = "is_user_done";
	}

	// IF THE USER IS NOT DONE REFRESH owner_inventory()
	elseif(($_SESSION['next_page'] == "is_user_done")&&
			(array_key_exists("another_edit", $_POST)))
    {
        // get username and password from session
        $username = $_SESSION["username"];
        $password = $_SESSION["password"];

        // NOW proceed to create publisher dropdown
        owner_inventory($username, $password);
        $_SESSION["next_screen"] = "editmod";
    }

	// IF THEY ARE DONE PREPARE TO DESTORY SESSION AND GIVE THEM PROMPT TO RELOGIN
	elseif(($_SESSION['next_page'] == "is_user_done")&&
			(array_key_exists("user_done", $_POST)))
    {
        session_destroy();
        session_regenerate_id(TRUE);
        session_start();

        login();
        $_SESSION['next_screen'] = 'inventory';
    }

	// IF, WE SOMEHOW REACH THIS DESTROY THE SESSIONn AND RESTART IT!
    else
    {
        ?>
        <p> <strong> An Error Has Ocurred, Please Try Again </strong> </p>
        <?php

        session_destroy();
        session_regenerate_id(TRUE);
        session_start();

        login();
    }
?>
</body>
</html>
