<?php
    session_start();
?>
<!DOCTYPE html>
<html  xmlns="http://www.w3.org/1999/xhtml">

<!--
    by: Super Troopers
    last modified: 2017-10-18	[:wq
-->

<head>
    <title> Chimpo </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <?php
        /* these are bringing in PHP functions I am calling below */

        require_once("create_login.php");

    ?>

    <link href="http://users.humboldt.edu/smtuttle/styles/normalize.css"
          type="text/css" rel="stylesheet" />
</head>

<body>
    <h1> Inventory Management System </h1>

    <?php
    if (! array_key_exists('next_page', $_SESSION))
    {
        create_login();
        $_SESSION['next_page'] = "workowner";
    }

        ?>
        <p> <strong> YIKES! should NOT have been able to reach
            here! </strong> </p>
        <?php

        session_destroy();
        session_regenerate_id(TRUE);
        session_start();

        request_name();

?>
</body>
</html>
