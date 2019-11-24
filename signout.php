<?php
//signin.php
include 'connect.php';
include 'header.php';



//set the $_SESSION['signed_in'] variable to FALSE
$_SESSION['signed_in'] = FALSE;


//also remove the user details from the session so the user level should not be maintained
  
// unset($_SESSION['user_name']);  
// unset($_SESSION['user_level']); 
// unset($_SESSION['user_id'] );

$_SESSION['user_name'] = '';
$_SESSION['user_level'] = '';
$_SESSION['user_id'] = '';


Header("Location: index.php");

?>