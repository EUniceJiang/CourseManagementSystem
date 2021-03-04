<?php
    //Include the file session.php
    include("session.php");

    session_unset();

    //Destroy the sessions saved before.
    session_destroy();

    //Automatically go back to home page
    header('Location: ./Home.php');
?>