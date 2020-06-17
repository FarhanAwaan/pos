<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
{
 
}

else
{

            // print_r($_SESSION); exit;
    // echo "<script>window.open('login.php','_self'); alert('Please log in first to see this page.');</script>";
    header("Location: login.php");
}
?>