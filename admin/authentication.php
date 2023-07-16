<?php 
    session_start();
    include('config/dbcon.php');


    if(!isset($_SESSION['auth']))
    {
        $_SESSION['message'] = "Login to acces the Dashboard";
        header("Location: ../landing.php");
        exit(0);
    }
    else
    {
        if($_SESSION['auth_role'] != "1")
        {
            $_SESSION['message'] = "You are not an Admin";
            header("Location: ../landing.php");
            exit(0);
        }
    }

?>