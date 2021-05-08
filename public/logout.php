<?php
//use current session
session_start();



//remove session variables
session_unset();

//remove current session
session_destroy();

//user is no longer a valid user
$_SESSION['validUser'] = 'no';
$_SESSION['validEmployee'] = 'no';
$_SESSION['userID'] = 'no';

//redirect to login page
header('location: index.php');
?>
