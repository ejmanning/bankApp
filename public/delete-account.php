<?php
session_start();
if($_SESSION['validUser'] == 'yes' && $_REQUEST['userID'] == $_SESSION['userID'] || $_SESSION['validEmployee'] == 'yes') {
  require_once('../inc/Accounts.class.php');

  $account = new Accounts();

  if($account->delete($_GET['accountID'])) {
      $deleteMsg = "The account associated with ID #". $_GET['accountID'] ." has been deleted.";
    } else {
      $deleteMsg = "Uh-oh, we weren't able to delete the account associated with ID #".$accountID." Please try again.";
    }

  require_once('../tpl/delete-account.tpl.php');

} else {
  header("location: access-denied.php");
  exit;
}

?>
