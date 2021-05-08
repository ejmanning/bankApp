<?php
session_start();
if($_SESSION['validUser'] == 'yes' && $_REQUEST['userID'] == $_SESSION['userID'] || $_SESSION['validEmployee'] == 'yes') {
  require_once('../inc/Users.class.php');

  $user = new Users();

  if($user->delete($_GET['userID'])) {
      $deleteMsg = "The user associated with ID #". $_GET['userID'] ." has been deleted.";
    } else {
      $deleteMsg = "Uh-oh, we weren't able to delete the user associated with ID #".$userID." Please try again.";
    }

  require_once('../tpl/delete-user.tpl.php');

} else {
  header("location: access-denied.php");
  exit;
}

?>
