<?php
include 'header.php';
include 'connect.php';

// remove all session variables
//session_unset(); 

// destroy the session 
session_destroy(); 
{
echo 'You have been successfully signed out';
echo 'Goodbye ' . $_SESSION['user_name'] . ' its been fun';
}
include 'footer.php';
?>
