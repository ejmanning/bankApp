<?php
session_start();
if($_SESSION['validEmployee'] == 'yes') {
require_once('../inc/Accounts.class.php');

$account = new Accounts();
$accountList = $account->getList(
    (isset($_GET['sortColumn']) ? $_GET['sortColumn'] : null),
    (isset($_GET['sortDirection']) ? $_GET['sortDirection'] : null),
    (isset($_GET['filterColumn']) ? $_GET['filterColumn'] : null),
    (isset($_GET['filterText']) ? $_GET['filterText'] : null)
);




//var_dump($userList);
require_once('../tpl/account-list.tpl.php');
} else {
  header("location: access-denied.php");
  exit;
}
?>
