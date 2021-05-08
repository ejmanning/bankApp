<?php
session_start();
if($_SESSION['validUser'] == 'yes' && $_REQUEST['userID'] == $_SESSION['userID'] || $_SESSION['validEmployee'] == 'yes') {

require_once("../inc/Users.class.php");

$users = new Users();

$userDataArray = array();

// load the user if we have it
if (isset($_REQUEST['userID']) && $_REQUEST['userID'] > 0)
{
    $users->load($_REQUEST['userID']);
    $userDataArray = $users->userData;
}

require_once('../tpl/user-info.tpl.php');
} else {
  header("location: access-denied.php");
  exit;
}
?>
