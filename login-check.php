<?php
    
    //Authorization - Access Control
    //Check whether the user is logged in or not


    if(!isset($_SESSION['login'])) //If user session is  set
    {
        //User is no logged in
        //Redirect to login page with message
        $_SESSION['no-login-message'] ="<div class='error' text-center>Please login to access.</div>";
        //Redirect to login Page 
        header('location:'.SITEURL.'login.php');
        
    }
    ?>