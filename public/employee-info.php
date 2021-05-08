<?php
session_start();

require_once("../inc/Users.class.php");

$users = new Users();

$userDataArray = array();

// load the user if we have it
if (isset($_REQUEST['userID']) && $_REQUEST['userID'] > 0)
{
    $users->load($_REQUEST['userID']);
    $userDataArray = $users->userData;
}

require_once('../tpl/employee-info.tpl.php');
?>
