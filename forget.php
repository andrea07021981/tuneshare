<?php
    //check for an existing session
    session_start();
    // destroy the session
    session_destroy();
    // really get rid of the information
    $_SESSION['first_name'] = null;
    header('location:index.php');
?>